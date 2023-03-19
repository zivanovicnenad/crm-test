<?php

namespace App\Http\Controllers;

use App\Models\CashLoanProduct;
use App\Models\HomeLoanProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReportsController extends Controller
{
    /**
     * Show the reports screen.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $adviserId = Auth::user()->id;
        $cashLoans = CashLoanProduct::where('adviser_id', $adviserId)->get();
        $homeLoans = HomeLoanProduct::where('adviser_id', $adviserId)->get();
        $cashLoansData = $this->prepareLoansData($cashLoans, 'Cash loan');
        $homeLoansData = $this->prepareLoansData($homeLoans, 'Home loan');
        $loans = array_merge($cashLoansData, $homeLoansData);
        usort($loans, fn($a, $b) => $a['creation_date'] <= $b['creation_date']);

        return view('reports.list', compact('loans'));
    }

    private function prepareLoansData($loans, $productType)
    {
        $returnData = [];
        if ($loans->count() > 0) {
            foreach ($loans as $loan) {
                $returnData[] = [
                    'product_type' => $productType,
                    'product_value' => $productType == 'Cash loan' ? $loan->loan_amount : $loan->property_value . ' - ' . $loan->down_payment_amount,
                    'creation_date' =>  Carbon::createFromFormat('Y-m-d H:i:s', $loan->created_at)->format('Y-m-d')
                ];
            }
        }
        return $returnData;
    }

}
