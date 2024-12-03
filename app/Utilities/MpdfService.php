<?php

namespace App\Utilities;

use Mpdf\Mpdf;

class MpdfService
{
    public static function create(): Mpdf
    {
        $config = config('mpdf');
        return new Mpdf([
            'mode' => $config['mode'],
            'format' => $config['format'],
            'autoLangToFont' => $config['autoLangToFont'],
        ]);
    }
}
