<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->string('phone');
            $table->string('external_id')->nullabe();
            $table->string('checkout_link')->nullable();
            $table->foreignId('barcode_id')->constrained('barcodes')->cascadeOnDelete();
            $table->string('payment_method')->nullable();
            $table->string('payment_status')->nullable();
            $table->decimal('subtotal', 10, 2);
            $table->decimal('ppn', 10, 2);
            $table->decimal('total', 10, 2);
            $table->timestamps();
        });
    }

   
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
