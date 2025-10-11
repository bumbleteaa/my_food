<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction;

class Barcode extends Model
{
   use HasFactory;

   protected $fillable = [
    'table_numbers',
    'images',
    'qr_value',
    'user_id'
   ];

   //relation with user
   public function user()
   {
       return $this->belongsTo(User::class);
   }

   // relation with transactions
   public function transactions()
   {
       return $this->hasMany(Transaction::class);
   }
}