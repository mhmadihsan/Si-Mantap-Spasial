@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
    <section class="content-header bg-white px-3 px-lg-4 py-3">
        <div class="d-flex flex-column flex-md-row justify-content-between gap-2">
            <div>
                <h1 class="h3 mb-1">Dashboard</h1>
                <div class="text-secondary">Ringkasan penggunaan generate XML berdasarkan OPD.</div>
            </div>
            <ol class="breadcrumb mb-0 align-items-center">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Admin</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </div>
    </section>

    <section class="px-3 px-lg-4 py-4">
        <div class="row g-3 mb-4">
            <div class="col-12 col-md-4">
                <div class="info-box d-flex align-items-center gap-3 p-3 shadow-sm">
                    <span class="info-box-icon bg-info"><i class="bi bi-filetype-xml"></i></span>
                    <div>
                        <div class="text-secondary small text-uppercase fw-semibold">Total Generate</div>
                        <div class="fs-3 fw-semibold">{{ number_format($totalGeneratedXml) }}</div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="info-box d-flex align-items-center gap-3 p-3 shadow-sm">
                    <span class="info-box-icon bg-success"><i class="bi bi-calendar2-check"></i></span>
                    <div>
                        <div class="text-secondary small text-uppercase fw-semibold">Generate Hari Ini</div>
                        <div class="fs-3 fw-semibold">{{ number_format($todayGeneratedXml) }}</div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="info-box d-flex align-items-center gap-3 p-3 shadow-sm">
                    <span class="info-box-icon bg-warning"><i class="bi bi-building-check"></i></span>
                    <div>
                        <div class="text-secondary small text-uppercase fw-semibold">OPD Aktif Generate</div>
                        <div class="fs-3 fw-semibold">{{ number_format($totalOpdGeneratingXml) }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-12 col-xl-7">
                <div class="card shadow-sm h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h2 class="h5 mb-0">Penggunaan per OPD</h2>
                        <span class="badge text-bg-light">Bar Chart</span>
                    </div>
                    <div class="card-body">
                        @if ($chartLabels->isNotEmpty())
                            <div class="chart-wrap">
                                <canvas id="xmlUsageChart"></canvas>
                            </div>
                        @else
                            <div class="d-flex align-items-center justify-content-center text-center text-secondary border rounded bg-light" style="height: 360px;">
                                Belum ada data generate XML.
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-12 col-xl-5">
                <div class="card shadow-sm h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h2 class="h5 mb-0">10 Generate XML Terbaru</h2>
                        <span class="badge text-bg-info">{{ $recentGeneratedXml->count() }} data</span>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Waktu</th>
                                        <th>OPD</th>
                                        <th>File</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($recentGeneratedXml as $record)
                                        <tr>
                                            <td class="text-nowrap">
                                                <div class="fw-semibold">{{ $record->created_at?->format('d M Y') }}</div>
                                                <div class="text-secondary small">{{ $record->created_at?->format('H:i') }} WITA</div>
                                            </td>
                                            <td>
                                                <div class="fw-semibold">{{ $record->opd?->name_akronim ?: 'Tanpa OPD' }}</div>
                                                <div class="text-secondary small text-truncate" style="max-width: 180px;">{{ $record->opd?->name }}</div>
                                            </td>
                                            <td>
                                                <span class="d-inline-block text-truncate" style="max-width: 180px;" title="{{ $record->file_name }}">
                                                    {{ $record->file_name }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center text-secondary py-4">Belum ada data generate XML.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    @if ($chartLabels->isNotEmpty())
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
        <script>
            const xmlUsageChart = document.getElementById('xmlUsageChart');

            new Chart(xmlUsageChart, {
                type: 'bar',
                data: {
                    labels: @json($chartLabels),
                    datasets: [{
                        label: 'Jumlah Generate XML',
                        data: @json($chartValues),
                        backgroundColor: 'rgba(14, 165, 233, .78)',
                        borderColor: 'rgba(2, 132, 199, 1)',
                        borderWidth: 1,
                        borderRadius: 5,
                        maxBarThickness: 46
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            }
                        },
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    }
                }
            });
        </script>
    @endif
@endpush
