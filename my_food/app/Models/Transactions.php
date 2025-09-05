<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

use function PHPUnit\Framework\returnSelf;

class Transactions extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function barcodes(){
        return $this->belongsTo(Barcode::class);
    }

    public function items(){
        return $this->hasMany(TransactionItems::class, 'transaction_id');
    }
}
