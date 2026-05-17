<?php

namespace Database\Seeders;

use App\Models\MasterOpd;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OpdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MasterOpd::create(
            [
                'name' => 'Dinas Komunikasi, Informatika, Persandian, dan Statistik',
                'name_akronim' => 'Diskominfosp',
                'name_of_head' => 'Drs. Hendro Martono, MT',
                'position_head' => 'Kepala Dinas Komunikasi, Informatika, Persandian, dan Statistik',
                'number_phone' => '051721230',
                'address' => 'Jl. Aluh Idut No : 66 A',
                'poscode' => '70111',
                'mail_opd' => 'diskominfosp@hulusungaiselatankab.go.id',
            ]
        );

        MasterOpd::create(
            [
                'name' => 'Badan Perencanaan Pembangunan Riset dan Inovasi Daerah',
                'name_akronim' => 'Bapperida',
                'name_of_head' => 'M. Arliyan Syahrial, M.Pd',
                'position_head' => 'Kepala Badan Perencanaan Pembangunan Riset dan Inovasi Daerah',
                'number_phone' => '051721230',
                'address' => 'Jl. A Yani No : 14',
                'poscode' => '70111',
                'mail_opd' => 'bapperida@hulusungaiselatankab.go.id',
            ]
        );

        MasterOpd::create(
            [
                'name' => 'Dinas Perumahan Rakyat, dan Kawasan Permukiman, Lingkungan Hidup dan Pertanahan',
                'name_akronim' => 'DisperaKPLHP',
                'name_of_head' => 'Susilo Adianto, S.STP, M.Si',
                'position_head' => 'Kepala Dinas Perumahan Rakyat, dan Kawasan Permukiman, Lingkungan Hidup dan Pertanahan',
                'number_phone' => '051721230',
                'address' => 'Jl. Jend. A. Yani No.Km.3, Gambah Luar Muka, Kec. Kandangan, Kabupaten Hulu Sungai Selatan',
                'poscode' => '71216',
                'mail_opd' => 'disperakplhp@hulusungaiselatankab.go.id',
            ]
        );

        MasterOpd::create(
            [
                'name' => 'Dinas Pekerjaan Umum dan Penataan Ruang',
                'name_akronim' => 'DPUPR',
                'name_of_head' => 'Hj. Rahmawaty, ST.MT',
                'position_head' => 'Kepala Dinas Pekerjaan Umum dan Penataan Ruang',
                'number_phone' => '051721230',
                'address' => 'Jl. Singakarsa, Kandangan, Kabupaten Hulu Sungai Selatan',
                'poscode' => '71217',
                'mail_opd' => 'dpupr@hulusungaiselatankab.go.id',
            ]
        );

        // MasterOpd::create(
        //     [
        //         'name' => 'Dinas Pemberdayaan Masyarakat dan Desa, Pemberdayaan Perempuan dan Perlindungan Anak',
        //         'name_akronim' => 'DPMPDPPPA',
        //         'name_of_head' => 'Hj. Rahmawaty, ST.MT',
        //         'position_head' => 'Kepala Dinas Pemberdayaan Masyarakat dan Desa, Pemberdayaan Perempuan dan Perlindungan Anak',
        //         'number_phone' => '051721230',
        //         'address' => 'Jl. Aluh Idut No. 1, Kandangan, Kabupaten Hulu Sungai Selatan',
        //         'poscode' => '71212',
        //         'mail_opd' => 'dpmpdpppa@hulusungaiselatankab.go.id',
        //     ]
        // );


        MasterOpd::create(
            [
                'name' => 'Dinas Pemberdayaan Masyarakat dan Desa, Pemberdayaan Perempuan dan Perlindungan Anak',
                'name_akronim' => 'DPMPDPPPA',
                'name_of_head' => 'M. Taufiqurrahman, S.STP, M.Si ',
                'position_head' => 'Kepala Dinas Pemberdayaan Masyarakat dan Desa, Pemberdayaan Perempuan dan Perlindungan Anak',
                'number_phone' => '051721230',
                'address' => 'Jl. Aluh Idut No. 1, Kandangan, Kabupaten Hulu Sungai Selatan',
                'poscode' => '71212',
                'mail_opd' => 'dpmpdpppa@hulusungaiselatankab.go.id',
            ]
        );

        MasterOpd::create(
            [
                'name' => 'Bagian Pemerintahan Sekretariat Daerah',
                'name_akronim' => 'Bag. Pem',
                'name_of_head' => 'Lothvie Rahmanie, S.STP, M.Si',
                'position_head' => 'Kepala Bagian Pemerintahan Sekretariat Daerah',
                'number_phone' => '051721230',
                'address' => 'Jl. P Antasari No. 1, Kandangan, Kabupaten Hulu Sungai Selatan',
                'poscode' => '71211',
                'mail_opd' => 'bag.pem@hulusungaiselatankab.go.id',
            ]
        );


        MasterOpd::create(
            [
                'name' => 'Badan Penanggulangan Bencana Daerah',
                'name_akronim' => 'BPBD',
                'name_of_head' => 'Ika Aguspiannor Hidayatullah, S.Sos., M.IP',
                'position_head' => 'Kepala Badan Penanggulangan Bencana Daerah',
                'number_phone' => '051721230',
                'address' => 'Jalan Musyawarah No. 77, Kandangan, Kabupaten Hulu Sungai Selatan',
                'poscode' => '71211',
                'mail_opd' => 'bpbd@hulusungaiselatankab.go.id',
            ]
        );

        MasterOpd::create(
            [
                'name' => 'Dinas Pertanian, Perikanan dan Pangan',
                'name_akronim' => 'Distanpp',
                'name_of_head' => 'Hj. Lutfiana, SP, MP',
                'position_head' => 'Kepala Dinas Pertanian, Perikanan dan Pangan',
                'number_phone' => '051721230',
                'address' => 'Jl. Kamboja No.15, Kandangan Utara, Kec. Kandangan, Kabupaten Hulu Sungai Selatan',
                'poscode' => '71213',
                'mail_opd' => 'distanpp@hulusungaiselatankab.go.id',
            ]
        );

        MasterOpd::create(
            [
                'name' => 'Badan Pengelolaan Keuangan dan Pendapatan Daerah',
                'name_akronim' => 'BPKPD',
                'name_of_head' => 'Drs. H. NANANG.F.M.N, M.Si ',
                'position_head' => 'Kepala Badan Pengelolaan Keuangan dan Pendapatan Daerah',
                'number_phone' => '051721230',
                'address' => 'Jl. Panglima Batur No.51, Kandangan Kota, Kec. Kandangan, Kabupaten Hulu Sungai Selatan',
                'poscode' => '71217',
                'mail_opd' => 'bpkpd@hulusungaiselatankab.go.id',
            ]
        );

        MasterOpd::create(
            [
                'name' => 'Dinas Kependudukan dan Pencatatan Sipil',
                'name_akronim' => 'disdukcapil',
                'name_of_head' => 'KUSAIRI, S.Sos,M.IP',
                'position_head' => 'Kepala Dinas Kependudukan dan Pencatatan Sipil',
                'number_phone' => '051721230',
                'address' => 'Jalan Jenderal A. Yani Km. 2,5 No. 80, Desa Gambah Luar Muka, Kecamatan Kandangan, Kabupaten Hulu Sungai Selatan',
                'poscode' => '71211',
                'mail_opd' => 'disdukcapil@hulusungaiselatankab.go.id',
            ]
        );

        MasterOpd::create(
            [
                'name' => 'Dinas Kesehatan, Pengendalian Penduduk dan Keluarga Berencana',
                'name_akronim' => 'dinkesppkb',
                'name_of_head' => 'HANTI WAHYUNINGSIH, SKM., MPH',
                'position_head' => 'Kepala Dinas Kesehatan, Pengendalian Penduduk dan Keluarga Berencana',
                'number_phone' => '051721230',
                'address' => 'Jl. Jendral Sudirman No. 29, Kandangan, Kalimantan Selatan',
                'poscode' => '71211',
                'mail_opd' => 'dinkesppkb@hulusungaiselatankab.go.id',
            ]
        );


        MasterOpd::create(
            [
                'name' => 'Dinas Pemuda, Olahraga, dan Pariwisata',
                'name_akronim' => 'disporapar',
                'name_of_head' => 'DODY PURIYANDHANI, SE, MM',
                'position_head' => 'Kepala Dinas Pemuda, Olahraga, dan Pariwisata',
                'number_phone' => '051721230',
                'address' => 'Jalan Stadion Ganda, Kompleks Stadion 2 Desember, Kandangan',
                'poscode' => '71211',
                'mail_opd' => 'disporapar@hulusungaiselatankab.go.id',
            ]
        );


        MasterOpd::create(
            [
                'name' => 'Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu',
                'name_akronim' => 'dpmptsp',
                'name_of_head' => 'Ir. Hj. ELYANI YUSTIKA ',
                'position_head' => 'Kepala Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu',
                'number_phone' => '051721230',
                'address' => 'Jalan Pangeran Antasari No. 1, Kandangan Kota, Kec. Kandangan, Kabupaten Hulu Sungai Selatan',
                'poscode' => '71211',
                'mail_opd' => 'dpmptsp@hulusungaiselatankab.go.id',
            ]
        );


        MasterOpd::create(
            [
                'name' => 'Dinas Pendidikan dan Kebudayaan',
                'name_akronim' => 'disdikbud',
                'name_of_head' => 'RONALDY PRANA PUTRA, S.STP, M.Si',
                'position_head' => 'Kepala Dinas Pendidikan dan Kebudayaan',
                'number_phone' => '051721230',
                'address' => 'Jalan Melati Nomor 17, Kandangan Utara, Kecamatan Kandangan, Kabupaten Hulu Sungai Selatan',
                'poscode' => '71211',
                'mail_opd' => 'disdikbud@hulusungaiselatankab.go.id',
            ]
        );

        MasterOpd::create(
            [
                'name' => 'Dinas Perindustrian dan Perdagangan',
                'name_akronim' => 'disperindag',
                'name_of_head' => 'SUDIONO, ST., M.Si',
                'position_head' => 'Kepala Dinas Perindustrian dan Perdagangan',
                'number_phone' => '051721230',
                'address' => 'Jalan Anggrek No. 65, Kandangan Utara, Kecamatan Kandangan, Kabupaten Hulu Sungai Selatan',
                'poscode' => '71212',
                'mail_opd' => 'disperindag@hulusungaiselatankab.go.id',
            ]
        );

        MasterOpd::create(
            [
                'name' => 'Dinas Perhubungan',
                'name_akronim' => 'dishub',
                'name_of_head' => 'TAJIDDIN NOOR S.Sos, M.IP',
                'position_head' => 'Kepala Dinas Perhubungan',
                'number_phone' => '051721037',
                'address' => 'Jl. Aluh Idut No. 58, Kandangan Utara, Kec. Kandangan, Kabupaten Hulu Sungai Selatan',
                'poscode' => '71212',
                'mail_opd' => 'dishub@hulusungaiselatankab.go.id',
            ]
        );

        MasterOpd::create(
            [
                'name' => 'Dinas Sosial',
                'name_akronim' => 'dinsos',
                'name_of_head' => 'NORDIANSYAH, S.Sos, M.Si',
                'position_head' => 'Kepala Dinas Sosial',
                'number_phone' => '051721037',
                'address' => 'Jalan Kamboja No. 3, Kelurahan Kandangan Utara, Kecamatan Kandangan',
                'poscode' => '71211',
                'mail_opd' => 'dinsos@hulusungaiselatankab.go.id',
            ]
        );

        MasterOpd::create(
            [
                'name' => 'Dinas Tenaga Kerja, Koperasi dan Usaha Mikro Kecil Menengah',
                'name_akronim' => 'disnakerkopumkm',
                'name_of_head' => 'NAFARIN, S.STP, M.Si',
                'position_head' => 'Kepala Dinas Tenaga Kerja, Koperasi dan Usaha Mikro Kecil Menengah',
                'number_phone' => '051721037',
                'address' => 'Jalan Mawar No. 66, Kandangan Utara, Kecamatan Kandangan, Kabupaten Hulu Sungai Selatan',
                'poscode' => '71215',
                'mail_opd' => 'disnakerkopumkm@hulusungaiselatankab.go.id',
            ]
        );
    }
}
