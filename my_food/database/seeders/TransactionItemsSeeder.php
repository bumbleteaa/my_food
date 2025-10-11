<?php

namespace Database\Seeders;

use App\Models\Foods;
use App\Models\Transaction;
use App\Models\TransactionItems;
use Illuminate\Database\Seeder;

class TransactionItemsSeeder extends Seeder
{
    public function run(): void
    {
        $transactions = Transaction::all();
        $foods = Foods::all();

        if ($foods->isEmpty()){
            $this->command->info('No foods found, skipping TransactionItems seeder.');
            return;
        }

        foreach ($transactions as $transaction) {
            // Randomly select 1 to 3 food items for each transaction
            $selectedFoods = $foods->random(rand(2, 4));
                for ($i = 0; $i < $selectedFoods->count(); $i++) {
                    $food = $foods->random();
                    $quantity = rand(1, 3);
                    
                    //When the food discount, apply the discount price
                    $price = $food->is_promo ? $food->price_afterdiscount : $food->price;
                    $subtotal = $price * $quantity;

                    // Create TransactionItems record
                    TransactionItems::create([
                        'transaction_id' => $transaction->id,
                        'foods_id' => $food->id,
                        'quantity' => $quantity,
                        'price' => $price,
                        'subtotal' => $subtotal,
                    ]);
                }
                $this->command->info("TransactionItems created for Transaction ID: {$transaction->code}");
        }
        $this->command->info('TransactionItems seeding completed.');
    }
}
