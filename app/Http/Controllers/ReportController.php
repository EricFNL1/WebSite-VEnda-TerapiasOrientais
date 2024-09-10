<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class ReportController extends Controller
{
    public function generateExcelReport()
    {
        // Caminho do Python e do script
        $pythonPath = 'C:\Users\ericf\AppData\Local\Programs\Python\Python312\python.exe';
        $scriptPath = base_path('resources/views/generate_excel.py'); 

        // Executa o script Python usando Symfony Process
        $process = new Process([$pythonPath, $scriptPath]);
        $process->run();

        // Verifica se houve erro na execução
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        // Retorna o arquivo gerado para o download
        return response()->download(public_path('relatorio_financeiro.xlsx'));
    }

    public function generatePDFReport()
    {
        $pythonPath = 'C:\Users\ericf\AppData\Local\Programs\Python\Python312\python.exe';
        $scriptPath = base_path('resources/views/generate_pdf.py'); 

        $process = new Process([$pythonPath, $scriptPath]);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        return response()->download(public_path('relatorio_financeiro.pdf'));
    }
}
