<?php

namespace App\Services;

use App\Models\Walidata;
use Carbon\Carbon;

class ToolsXmlGenerateService
{
    public function __construct()
    {
        //
    }

    public function getWalidata()
    {
        return Walidata::where('is_active', true)->first() ?? null;
    }

    public function getIdentifikasi($nameSpasial, $Tanggal)
    {
        $getYear = Carbon::parse($Tanggal)->format('Y');
        $replaceSpace = str_replace(' ', '-', $nameSpasial);
        return '6306HSS' . $replaceSpace . '_' . $getYear;
    }
}
