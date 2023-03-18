<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'email', 'phone'];

    /**
     * Get the cach loans for the adviser.
     */
    public function cashLoans(): HasMany
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
