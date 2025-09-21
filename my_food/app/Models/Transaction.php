<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'name',
        'phone',
        'external_id',
        'checkout_link',
        'barcode_id',
        'payment_method',
        'payment_status',
        'subtotal',
        'ppn',
        'total',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'subtotal' => 'interger',
        'ppn' => 'interger',
        'total' => 'interger'
    ];

    public function barcode(): BelongsTo
    {
        return $this->belongsTo(Barcode::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(TransactionItems::class, 'transaction_id');
    }

    //Helper method
    public function getTotalFormatAttribute(): string
    {
        return 'Rp' .number_format($this->total, 0, ',', '.');
    }

    public function isPaid(): bool
    {
        return $this->payment_status === 'paid';
    }
}
