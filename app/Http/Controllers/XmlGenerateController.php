<?php

namespace App\Http\Controllers;

use App\Models\LogRecordGenerateXml;
use App\Models\MasterOpd;
use App\Services\ToolsXmlGenerateService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class XmlGenerateController extends Controller
{
    protected $toolsXmlGenerateService;

    public function __construct(ToolsXmlGenerateService $toolsXmlGenerateService)
    {
        $this->toolsXmlGenerateService = $toolsXmlGenerateService;
        // $this->middleware('auth');
    }

    public function generate(Request $request)
    {
        $validated = $request->validate([
            'master_opd_id' => ['required', 'exists:master_of_opd,id'],
            'nama_data_spasial' => ['required', 'string', 'max:100'],
            'deskripsi_data_spasial' => ['required', 'string'],
            'abstract_data_spasial' => ['required', 'string'],
            'tanggal_rilis' => ['required', 'date', 'before_or_equal:today'],
            'captcha_answer' => ['required', 'integer'],
        ], [
            'master_opd_id.required' => 'Pilih Nama Dinas wajib diisi.',
            'master_opd_id.exists' => 'Nama Dinas yang dipilih tidak valid.',
            'nama_data_spasial.required' => 'Nama Data Spasial wajib diisi.',
            'nama_data_spasial.max' => 'Nama Data Spasial tidak boleh lebih dari 100 karakter.',
            'deskripsi_data_spasial.required' => 'Deskripsi Data Spasial wajib diisi.',
            'abstract_data_spasial.required' => 'Abstract wajib diisi.',
            'tanggal_rilis.required' => 'Tanggal Rilis wajib diisi.',
            'tanggal_rilis.date' => 'Tanggal Rilis harus berupa tanggal yang valid.',
            'tanggal_rilis.before_or_equal' => 'Tanggal Rilis tidak boleh lebih dari hari ini.',
            'captcha_answer.required' => 'Captcha wajib diisi.',
            'captcha_answer.integer' => 'Captcha harus berupa angka.',
        ]);

        if (! hash_equals((string) session('simantap_spasial_captcha_answer', ''), (string) $validated['captcha_answer'])) {
            return back()
                ->withErrors(['captcha_answer' => 'Jawaban captcha tidak sesuai.'])
                ->withInput($request->except('captcha_answer'));
        }

        session()->forget('simantap_spasial_captcha_answer');

        $ipAddress = $request->ip() ?? 'unknown';

        if ($this->remainingGenerateXml($ipAddress) < 1) {
            return back()
                ->withErrors(['generate_limit' => 'Kuota generate XML untuk IP Anda hari ini sudah habis.'])
                ->withInput($request->except('captcha_answer'));
        }

        $walidata = $this->toolsXmlGenerateService->getWalidata();
        $opd = MasterOpd::query()->findOrFail($validated['master_opd_id']);
        $templatePath = public_path('acuan/metadata_acuan.xml');
        $templateXml = file_get_contents($templatePath);

        if ($templateXml === false) {
            return back()
                ->withErrors(['xml_template' => 'Template XML acuan tidak ditemukan.'])
                ->withInput();
        }

        $xmlValues = [
            '[NAMA_LENGKAP_PENANGGUNG_JAWAB_WALIDATA]' => htmlspecialchars($walidata->name ?? '-', ENT_XML1 | ENT_COMPAT, 'UTF-8'),
            '[NAMA_INSTANSI_WALIDATA]' => htmlspecialchars($walidata->agency ?? '-', ENT_XML1 | ENT_COMPAT, 'UTF-8'),
            '[JABATAN_PENANGGUNG_JAWAB_WALIDATA]' => htmlspecialchars($walidata->position ?? '-', ENT_XML1 | ENT_COMPAT, 'UTF-8'),
            '[NOMOR_TELEPON_WALIDATA]' => htmlspecialchars($walidata->number_phone ?? '-', ENT_XML1 | ENT_COMPAT, 'UTF-8'),
            '[NOMOR_FAX_WALIDATA]' => htmlspecialchars($walidata->number_phone ?? '-', ENT_XML1 | ENT_COMPAT, 'UTF-8'),
            '[ALAMAT_INSTANSI_WALIDATA]' => htmlspecialchars($walidata->address ?? '-', ENT_XML1 | ENT_COMPAT, 'UTF-8'),
            '[NAMA_KABUPATEN/KOTA_WALIDATA]' => htmlspecialchars($walidata->name_of_district ?? '-', ENT_XML1 | ENT_COMPAT, 'UTF-8'),
            '[NAMA_PROVINSI_WALIDATA]' => htmlspecialchars($walidata->province_name ?? '-', ENT_XML1 | ENT_COMPAT, 'UTF-8'),
            '[KODEPOS_WALIDATA]' => htmlspecialchars($walidata->pos_code ?? '-', ENT_XML1 | ENT_COMPAT, 'UTF-8'),
            '[EMAIL_RESMI_WALIDATA]' => htmlspecialchars($walidata->mail_agency ?? '-', ENT_XML1 | ENT_COMPAT, 'UTF-8'),

            '[NAMA_LENGKAP_PENANGGUNG_JAWAB_PRODUSENDATA]' => htmlspecialchars($opd->name_of_head ?? '-', ENT_XML1 | ENT_COMPAT, 'UTF-8'),
            '[NAMA_INSTANSI_PRODUSENDATA]' => htmlspecialchars($opd->name ?? '-', ENT_XML1 | ENT_COMPAT, 'UTF-8'),
            '[JABATAN_PENANGGUNG_JAWAB_PRODUSENDATA]' => htmlspecialchars($opd->position_head ?? '-', ENT_XML1 | ENT_COMPAT, 'UTF-8'),
            '[NOMOR_TELEPON_PRODUSENDATA]' => htmlspecialchars($opd->number_phone ?? '-', ENT_XML1 | ENT_COMPAT, 'UTF-8'),
            '[ALAMAT_INSTANSI_PRODUSENDATA]' => htmlspecialchars($opd->address ?? '-', ENT_XML1 | ENT_COMPAT, 'UTF-8'),
            '[NAMA_KABUPATEN/KOTA_PRODUSENDATA]' => htmlspecialchars($walidata->name_of_district ?? '-', ENT_XML1 | ENT_COMPAT, 'UTF-8'),
            '[NAMA_PROVINSI_PRODUSENDATA]' => htmlspecialchars($walidata->province_name ?? '-', ENT_XML1 | ENT_COMPAT, 'UTF-8'),
            '[KODEPOS_PRODUSENDATA]' => htmlspecialchars($opd->poscode ?? '-', ENT_XML1 | ENT_COMPAT, 'UTF-8'),
            '[EMAIL_RESMI_PRODUSENDATA]' => htmlspecialchars($opd->mail_opd ?? '-', ENT_XML1 | ENT_COMPAT, 'UTF-8'),

            '[NAMA_PROVINSI/KABUPATEN/KOTA]' => htmlspecialchars('HULU SUNGAI SELATAN', ENT_XML1 | ENT_COMPAT, 'UTF-8'),
            '[NAMA_LENGKAP_PIC_WALIDATA]' => htmlspecialchars('NAMA PIC WALIDATA KOMINFO', ENT_XML1 | ENT_COMPAT, 'UTF-8'),

            '[KEYWORD_DATA]' => htmlspecialchars('MASIH BELUM ADA', ENT_XML1 | ENT_COMPAT, 'UTF-8'),
            '[KEYWORD_DATA_DESCRIPTION]' => htmlspecialchars($request->deskripsi_data_spasial, ENT_XML1 | ENT_COMPAT, 'UTF-8'),
            '[ABSTRACT_DATA_SPASIAL]' => htmlspecialchars($validated['abstract_data_spasial'], ENT_XML1 | ENT_COMPAT, 'UTF-8'),

            '[URL_NAMA_DOMAIN]' => htmlspecialchars('https://geoportal.hulusungaiselatankab.go.id', ENT_XML1 | ENT_COMPAT, 'UTF-8'),

            '[IDENTIFIER_UNIK_DATASET]' => htmlspecialchars($this->toolsXmlGenerateService->getIdentifikasi($validated['nama_data_spasial'], $validated['tanggal_rilis']), ENT_XML1 | ENT_COMPAT, 'UTF-8'),
            '[TANGGAL_RILIS]' => htmlspecialchars($validated['tanggal_rilis'], ENT_XML1 | ENT_COMPAT, 'UTF-8'),
            // 'Data spasial yang di produksi oleh [NAMA_INSTANSI_PRODUSENDATA]' => htmlspecialchars($validated['deskripsi_data_spasial'], ENT_XML1 | ENT_COMPAT, 'UTF-8'),

        ];
        $xmlContent = str_replace(array_keys($xmlValues), array_values($xmlValues), $templateXml);
        $fileBaseName = Str::slug($validated['nama_data_spasial']) ?: 'metadata-spasial';
        $fileName = $fileBaseName.'-'.now()->format('YmdHis').'-metadata.xml';
        $filePath = 'generated-xml/'.$fileName;

        Storage::disk('local')->put($filePath, $xmlContent);

        $record = LogRecordGenerateXml::query()->create([
            'file_name' => $fileName,
            'file_path' => $filePath,
        ]);

        $this->hitGenerateLimit($ipAddress);

        return to_route('simantap-spasial')
            ->with('success', 'Berhasil mengenerate data XML.')
            ->with('download_url', route('simantap-spasial.download', $record));
    }

    private function remainingGenerateXml(string $ipAddress): int
    {
        return max($this->dailyGenerateLimit() - (int) Cache::get($this->generateLimitCacheKey($ipAddress), 0), 0);
    }

    private function hitGenerateLimit(string $ipAddress): void
    {
        $cacheKey = $this->generateLimitCacheKey($ipAddress);

        Cache::add($cacheKey, 0, now()->endOfDay());
        Cache::increment($cacheKey);
    }

    private function generateLimitCacheKey(string $ipAddress): string
    {
        return 'simantap_spasial_generate_count:'.now()->toDateString().':'.sha1($ipAddress);
    }

    private function dailyGenerateLimit(): int
    {
        return 10;
    }
}
