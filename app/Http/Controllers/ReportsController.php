<?php

namespace App\Http\Controllers;

use App\Exports\ReportExport;
use App\Helpers\ReportHelper;
use Maatwebsite\Excel\Facades\Excel;

class ReportsController extends Controller
{
    /**
     * Show the reports screen.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(ReportHelper $reportHelper)
    {
        $loans = $reportHelper->getLoans();

        return view('reports.list', compact('loans'));
    }

    /**
     * Export Excel file.
     *
     */
    public function export()
    {
        return Excel::download(new ReportExport(), 'export.xlsx');
    }

}
