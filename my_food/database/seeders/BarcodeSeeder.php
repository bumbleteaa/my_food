<?php

namespace Database\Seeders;

use App\Models\Barcode;
use App\Helpers\QrCodeHelper;
use Illuminate\Database\Seeder;

class BarcodeSeeder extends Seeder
{
    public function run(): void
    {
        $barcodes = [
          [
            'table_numbers' => 'TABLE-01',
            'qr_value' => 'https://yourapp.com/order/table-001',
            'user_id' => 1,
          ],
          [
            'table_numbers' => 'TABLE-02',
            'qr_value' => 'https://yourapp.com/order/table-002',
            'user_id' => 1,
          ],
          [
            'table_numbers' => 'TABLE-03',
            'qr_value' => 'https://yourapp.com/order/table-003',
            'user_id' => 1,
          ],
          [
            'table_numbers' => 'TABLE-04',
            'qr_value' => 'https://yourapp.com/order/table-004',
            'user_id' => 1,
          ],
          [
            'table_numbers' => 'TABLE-05',
            'qr_value' => 'https://yourapp.com/order/table-005',
            'user_id' => 1,
          ]
        ];

        //Ceating directory
        $directory = storage_path('app/public/qrcodes');
        if (!file_exists($directory)) {
            mkdir($directory, 0775, true);
        }


        foreach ($barcodes as $barcodeData) {
            //Crete barcode record
            $barcode = Barcode::create($barcodeData);

            //Generate QR code image
            $filename = "{$barcode->table_numbers}.png";
            $qrCodePath = "{$directory}/{$filename}";

            try {
                QrCodeHelper::saveToFile($barcode->qr_value, $qrCodePath, 400);

                $barcode->update([
                    'images' => "qrcodes/{$filename}"
                ]);

                $this->command->info("Barcode for {$barcode->table_numbers} created with QR code.");
            }

            catch (\Exception $e) {
                $this->command->error("Failed to generate QR code for {$barcode->table_numbers}");
            }
        }
    }
}
