<?php

namespace App\Jobs;

use App\Models\Report;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;

class ReporteExcel implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $reporte;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($reporte)
    {
        $this->reporte = $reporte;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $report = Report::create([
            'title' => $this->reporte['description'],
            'start_date' => $this->reporte['start_date'],
            'end_date' => $this->reporte['end_date'],
            'report_link' => ''
        ]);
        Excel::store(new UsersExport($this->reporte), "report{$report->id}.xlsx");
    }
}
