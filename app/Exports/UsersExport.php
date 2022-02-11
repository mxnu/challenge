<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    private $reporte;
    public function __construct($reporte) {
        $this->reporte = $reporte;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $start = $this->reporte['start_date'];
        $end = $this->reporte['end_date'];
        return User::whereBetween('birth_date', [$start, $end])
            ->select('name', 'email', 'birth_date')
            ->get();
    }

    public function headings(): array
    {
        return ["Name", "Email", "Birth Date"];
    }
}
