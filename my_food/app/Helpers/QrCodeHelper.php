<?php 

namespace App\Helpers;

use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

class QrCodeHelper{
    public static function generate(string $data, int $size = 400): string
        {
        $renderer = new ImageRenderer(
            new RendererStyle($size),
            new SvgImageBackEnd()
        );
        $writer = new Writer($renderer);
        return $writer->writeString($data);
    }

    public static function generatePng(string $data, int $size = 400): string
    {
        $renderer = new ImageRenderer(
            new RendererStyle($size),
            new \BaconQrCode\Renderer\Image\ImagickImageBackEnd()
        );
        $writer = new Writer($renderer);
        return $writer->writeString($data);
    }

    public static function saveToFile(string $data, string $path, int $size = 400) : void {
        $qrCode = self::generatePng($data, $size);
        file_put_contents($path, $qrCode);
    }
}