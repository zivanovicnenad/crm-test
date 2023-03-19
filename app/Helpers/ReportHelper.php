<?php

namespace App\Helpers;

use App\Models\CashLoanProduct;
use App\Models\HomeLoanProduct;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class ReportHelper
{

    /**
     * Fetch loans from database and map it in proper format.
     *
     * @return array
     */
    public function getLoans(): array
    {
        $adviserId = Auth::user()->id;
        $cashLoans = CashLoanProduct::where('adviser_id', $adviserId)->get();
        $homeLoans = HomeLoanProduct::where('adviser_id', $adviserId)->get();
        $cashLoansData = $this->prepareLoansData($cashLoans, 'Cash loan');
        $homeLoansData = $this->prepareLoansData($homeLoans, 'Home loan');
        $loans = array_merge($cashLoansData, $homeLoansData);
        usort($loans, fn($a, $b) => $a['creation_date'] <= $b['creation_date']);
        return $loans;
    }


    /**
     * Prepare loan data in accepted format that will be used in view.
     *
     * @return array
     */
    private function prepareLoansData(Collection $loans, string $productType): array
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
