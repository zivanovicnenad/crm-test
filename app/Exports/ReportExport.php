<?php

namespace App\Exports;

use App\Helpers\ReportHelper;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReportExport implements FromCollection, WithHeadings
{
    use Exportable;

    public function collection()
    {
        $reportHelper = new ReportHelper;
        return collect($reportHelper->getLoans());
    }

    public function headings(): array
    {
        return [
            'Product type',
            'Product_value',
            'Creation date',
        ];
    }

}
