<?php

namespace App\Http\Controllers;

use App\Models\FinancialProjection;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;

class FinancialController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Acesso negado');
        }
        // Obtém os parâmetros de filtro de mês e ano
        $month = $request->input('month');
        $year = $request->input('year');

        // Monta a query com filtro condicional
        $projectionsQuery = FinancialProjection::select(
                DB::raw('DATE_FORMAT(projection_date, "%Y-%m") as month'),
                DB::raw('SUM(projected_revenue) as total_revenue')
            )
            ->groupBy('month')
            ->orderBy('month', 'asc');

        if ($month && $year) {
            $projectionsQuery->whereYear('projection_date', $year)
                             ->whereMonth('projection_date', $month);
        }

        $projections = $projectionsQuery->get();

        // Extrai os meses e receitas para o gráfico
        $months = $projections->pluck('month')->toArray();
        $revenues = $projections->pluck('total_revenue')->toArray();
        

        return view('financial.index', compact('months', 'revenues', 'projections', 'month', 'year'));
    }

    
}
