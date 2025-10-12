<?php

namespace App\Filament\Resources\Barcodes\Pages;

use App\Filament\Resources\Barcodes\BarcodeResource;
use App\Helpers\QrCodeHelper;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBarcode extends EditRecord
{
    protected static string $resource = BarcodeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),

            Action::make('regenerate_qr')
                ->label('Generate QR Code')
                ->icon('heroicon-o-arrow-path')
                ->color('warning')
                ->requiresConfirmation()
                ->action(function(){
                    $barcode = $this->record;
                    $qrCodePath = storage_path("app/public/qrcodes/{$barcode->table_numbers}.png");

                    QrCodeHelper::saveToFile($barcode->qr_value, $qrCodePath,400);

                    $barcode->update([
                        'images' => "qrcodes/{$barcode->table_numbers}.png"
                    ]);

                    $this->notify('success', 'QR Code generated successfully');
                })
            ];
    }

    protected function getRedirectURL(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function afterSave(): void
    {
        $barcode = $this->record;

        if ($this->data['qr_value'] !== $barcode->getOriginal('qr_value')) {
            $qrCodePath = storage_path("app/public/qrcodes/{$barcode->table_numbers}.png");

            QrCodeHelper::saveToFile($barcode->qr_value, $qrCodePath,400);

            $barcode->update([
                'images' => "qrcodes/{$barcode->table_numbers}.png"
            ]);
        }
    }
}
