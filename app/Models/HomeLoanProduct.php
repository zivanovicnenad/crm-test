<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HomeLoanProduct extends Model
{
    use HasFactory;

    protected $fillable = ['client_id', 'adviser_id', 'property_value', 'down_payment_amount'];
    /**
     * Get the client of the home loan product.
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Get the adviser of the home loan product.
     */
    public function adviser(): BelongsTo
    {
        return $this->belongsTo(Adviser::class);
    }
}
