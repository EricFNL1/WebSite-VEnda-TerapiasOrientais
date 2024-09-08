<?php

namespace App\Http\Controllers;

use App\Models\FinancialProjection;
use Illuminate\Support\Facades\DB;

class FinancialController extends Controller
{
    public function index()
    {
        // Agrupa as previsões por mês e ano, somando as receitas previstas
        $projections = FinancialProjection::select(
                DB::raw('DATE_FORMAT(projection_date, "%Y-%m") as month'),
                DB::raw('SUM(projected_revenue) as total_revenue')
            )
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();

        return view('financial.index', compact('projections'));
    }
}
