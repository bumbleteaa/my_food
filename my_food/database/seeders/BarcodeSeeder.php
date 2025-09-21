<?php

namespace Database\Seeders;

use App\Models\Barcode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarcodeSeeder extends Seeder
{
    public function run(): void
    {
        $barcodes = [
          [
            'table_numbers' => 'Table 1',
            'images' => 'https://example.com/barcode1.png',
            'qr_value' => 'QR123456'. now()->timestamp,
            'user_id' => 1,
          ],
          [
            'table_numbers' => 'Table 2',
            'images' => 'https://example.com/barcode2.png',
            'qr_value' => 'QR654321' . now()->timestamp,
            'user_id' => 1,
          ],
          [
            'table_numbers' => 'Table 3',
            'images' => 'https://example.com/barcode3.png',
            'qr_value' => 'QR112233' . now()->timestamp,
            'user_id' => 2,
          ]
        ];

        foreach ($barcodes as $barcode) {
            Barcode::create($barcode);
        }
    }
}
