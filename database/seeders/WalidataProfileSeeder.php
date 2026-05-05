<?php

namespace Database\Seeders;

use App\Models\Walidata;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WalidataProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Walidata::create(
            [
                'is_active' => true,
                'name' => 'Drs. Hendro Martono, MT',
                'position' => 'Kepala Dinas Komunikasi, Informatika, Persandian, dan Statistik',
                'agency' => 'Dinas Komunikasi, Informatika, Persandian, dan Statistik',
                'number_phone' => '051721230',
                'fax_mail' => 'diskominfosp@hulusungaiselatankab.go.id',
                'address' => 'Jl. Aluh Idut No : 66 A',
                'name_of_district' => 'Hulu Sungai Selatan',
                'pos_code' => '71211',
                'province_name' => 'Kalimantan Selatan',
                'mail_agency' => 'diskominfosp@hulusungaiselatankab.go.id',
            ]
        );
    }
}
