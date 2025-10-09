<?php

namespace Database\Seeders;

use App\Models\Barcode;
use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use SebastianBergmann\CodeCoverage\Report\Xml\Totals;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        $barcode = Barcode::all();
        $paymentStatuses = ['pending', 'paid', 'failed'];
        $paymentMethods = ['cash', 'qris', 'bank_transfer'];

        for ($i = 1; $i <=20; $i++) {

            $subtotal = fake()->randomFloat(2, 10, 400);
            $ppn = round($subtotal * 0.12, 2);
            $total = $subtotal + $ppn;

            Transaction::create([
                'code' => 'TXN' . str_pad($i, 6, '0', STR_PAD_LEFT),
                'name' => fake()->name(),
                'phone' => fake()->phoneNumber(),
                'external_id' => 'EXT' . str_pad($i, 6, '0', STR_PAD_LEFT),
                'checkout_link' => fake()->url(),
                'barcode_id' => $barcode->random()->id,
                'payment_status' => fake()->randomElement($paymentStatuses),
                'payment_method' => fake()->randomElement($paymentMethods),
                'subtotal' => $subtotal,
                'ppn' => $ppn,
                'total' => $total,
            ]);
        }
    }
}
