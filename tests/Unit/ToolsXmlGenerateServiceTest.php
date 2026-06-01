<?php

namespace Tests\Unit;

use App\Services\ToolsXmlGenerateService;
use PHPUnit\Framework\TestCase;

class ToolsXmlGenerateServiceTest extends TestCase
{
    public function test_get_identifikasi_replaces_spaces_and_uses_year_from_date(): void
    {
        $service = new ToolsXmlGenerateService();

        $result = $service->getIdentifikasi('Jalan Kabupaten Hulu Sungai Selatan', '2026-05-31');

        $this->assertSame('6306HSSJalan-Kabupaten-Hulu-Sungai-Selatan_2026', $result);
    }
}
