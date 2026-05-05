<?php

namespace Tests\Feature;

use App\Models\MasterOpd;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SimantapSpasialPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_simantap_spasial_page_can_be_opened(): void
    {
        MasterOpd::query()->create([
            'name' => 'Badan Perencanaan Pembangunan, Riset dan Inovasi Daerah',
            'name_akronim' => 'Bapperida',
            'name_of_head' => 'Kepala Bapperida',
            'position_head' => 'Kepala Badan',
            'number_phone' => '081234567890',
            'address' => 'Jl. Contoh No. 1',
            'poscode' => '76111',
            'mail_opd' => 'bapperida@example.test',
        ]);

        $response = $this->get('/simantapSpasial');

        $response
            ->assertOk()
            ->assertSee('SiMantap Spasial')
            ->assertSee('Generate XML')
            ->assertSee('Nama Dinas')
            ->assertSee('Nama Data Spasial')
            ->assertSee('Badan Perencanaan Pembangunan, Riset dan Inovasi Daerah')
            ->assertSee('Bapperida')
            ->assertSee('Remaining Generate XML')
            ->assertSee('10/10');

        $response->assertSessionHas('simantap_spasial_captcha_answer');
    }
}
