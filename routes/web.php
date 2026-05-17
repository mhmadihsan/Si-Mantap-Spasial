<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\XmlGenerateController;
use App\Models\LogRecordGenerateXml;
use App\Models\MasterOpd;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

$makeSimantapSpasialCaptcha = function (): array {
    $firstNumber = random_int(2, 9);
    $secondNumber = random_int(2, 9);

    session(['simantap_spasial_captcha_answer' => $firstNumber + $secondNumber]);

    return [
        'question' => "{$firstNumber} + {$secondNumber}",
    ];
};

$getRemainingGenerateXml = function (string $ipAddress, int $dailyGenerateLimit): int {
    $cacheKey = 'simantap_spasial_generate_count:'.now()->toDateString().':'.sha1($ipAddress);
    $generatedToday = (int) Cache::get($cacheKey, 0);

    return max($dailyGenerateLimit - $generatedToday, 0);
};

Route::get('/', function () {
    return view('welcome');
});

Route::get('/simantapSpasial', function () use ($makeSimantapSpasialCaptcha, $getRemainingGenerateXml) {
    $opds = MasterOpd::query()
        ->orderBy('name')
        ->get(['id', 'name', 'name_akronim']);
    $dailyGenerateLimit = 10;
    $remainingGenerateXml = $getRemainingGenerateXml(request()->ip() ?? 'unknown', $dailyGenerateLimit);
    $captcha = $makeSimantapSpasialCaptcha();

    return view('simantap-spasial', compact('opds', 'dailyGenerateLimit', 'remainingGenerateXml', 'captcha'));
})->name('simantap-spasial');

Route::get('/simantapSpasial/captcha', function () use ($makeSimantapSpasialCaptcha) {
    return response()->json($makeSimantapSpasialCaptcha());
})
    ->middleware('throttle:30,1')
    ->name('simantap-spasial.captcha');

Route::post('/simantapSpasial', [XmlGenerateController::class, 'generate'])
    ->middleware('throttle:5,1')
    ->name('simantap-spasial.generate');

Route::get('/simantapSpasial/download/{record}', function (LogRecordGenerateXml $record) {
    abort_unless(Storage::disk('local')->exists($record->file_path), 404);

    return Storage::disk('local')->download($record->file_path, $record->file_name, [
        'Content-Type' => 'application/xml; charset=UTF-8',
    ]);
})->name('simantap-spasial.download');

Route::get('/dashboard', function () {
    $usageByOpd = LogRecordGenerateXml::query()
        ->select('master_opd_id', DB::raw('COUNT(*) as total'))
        ->with('opd:id,name,name_akronim')
        ->groupBy('master_opd_id')
        ->orderByDesc('total')
        ->get();

    $recentGeneratedXml = LogRecordGenerateXml::query()
        ->with('opd:id,name,name_akronim')
        ->latest()
        ->limit(10)
        ->get();

    $chartLabels = $usageByOpd
        ->map(fn (LogRecordGenerateXml $record): string => $record->opd?->name_akronim ?: $record->opd?->name ?: 'Tanpa OPD')
        ->values();

    $chartValues = $usageByOpd
        ->pluck('total')
        ->map(fn ($total): int => (int) $total)
        ->values();

    return view('dashboard', [
        'chartLabels' => $chartLabels,
        'chartValues' => $chartValues,
        'recentGeneratedXml' => $recentGeneratedXml,
        'totalGeneratedXml' => LogRecordGenerateXml::query()->count(),
        'todayGeneratedXml' => LogRecordGenerateXml::query()->whereDate('created_at', today())->count(),
        'totalOpdGeneratingXml' => $usageByOpd->whereNotNull('master_opd_id')->count(),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
