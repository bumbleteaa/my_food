<?php

namespace App\Filament\Resources\Barcodes\Pages;

use App\Filament\Resources\Barcodes\BarcodeResource;
use App\Helpers\QrCodeHelper;
use BaconQrCode\Encoder\QrCode;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\CreateRecord;

class CreateBarcode extends CreateRecord
{
    protected static string $resource = BarcodeResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    //Auto Generate QR code when creating new record
    protected function afterCreate(): void
    {
        $barcode = $this->record;

        if (!$barcode->images && $barcode->qr_value){
            $qrCodePath = storage_path('app/public/qrcodes/{$barcode->table_numbers}.png');

            //Creating directoiry if not exists
            if (!file_exists(dirname($qrCodePath))) {
                mkdir(dirname($qrCodePath), 0775, true);
            }
        }
        
        QrCodeHelper::saveToFile($barcode->qr_value, $qrCodePath, 300);

        $barcode->update([
            'images' => "qrcodes/{$barcode->table_numbers}.png"
        ]);
    }
}
