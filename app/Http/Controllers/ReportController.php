<?php

namespace App\Http\Controllers;

use App\Jobs\ReporteExcel;
use Illuminate\Http\Request;
use App\Models\Report;

class ReportController extends Controller {
    public function index() {
        return view('reports');
    }

    public function generateReport(Request $request) {
        // Validar datos recibidos
        $reporte = request()->all();
        if (!isset($reporte['description']) || !isset($reporte['start_date']) || !isset($reporte['end_date'])) {
            return response()->json([
                'success' => false,
                'message' => 'Faltan datos para generar el reporte'
            ]);
        }
        if ($reporte['start_date'] > $reporte['end_date']) {
            return response()->json([
                'message' => 'La fecha de inicio no puede ser mayor a la fecha de fin.'
            ]);
        }
        // Generar job
        ReporteExcel::dispatch($reporte);
        return response()->json(['success' => true]);
    }

    public function getReport($id) {
        // Verificar que archivo exista
        if (!file_exists(storage_path("app/report{$id}.xlsx"))) {
            abort(404);
        }
        return response()->download(storage_path("app/report{$id}.xlsx"));
    }

    public function listReports() {
        $reports = Report::all();
        return response()->json($reports);
    }
}
