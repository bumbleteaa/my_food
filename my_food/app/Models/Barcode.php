<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
   public function users(){
    return $this->belongsTo(User::class);
   }

   public functtion transactions(){
    return $this->hasMany(Transaction::class);
   }
}
