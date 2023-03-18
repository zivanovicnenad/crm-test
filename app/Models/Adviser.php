<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Adviser extends User
{
    protected $table = 'users';

    /**
     * Get the cach loans for the adviser.
     */
    public function cachLoans(): HasMany
    {
        return $this->hasMany(CashLoanProduct::class);
    }

    /**
     * Get the home loans for the adviser.
     */
    public function homeLoans(): HasMany
    {
        return $this->hasMany(HomeLoanProduct::class);
    }
}
