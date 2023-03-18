<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CashLoanProduct extends Model
{
    use HasFactory;

    /**
     * Get the client of the cash loan product.
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Get the adviser of the cash loan product.
     */
    public function adviser(): BelongsTo
    {
        return $this->belongsTo(Adviser::class);
    }
}
