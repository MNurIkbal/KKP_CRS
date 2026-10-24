
@extends('layouts.Admin.adm')

@section('content')
@php
use Carbon\Carbon;
@endphp
    <!-- Start right Content here -->

    <!-- ============================================================== -->

    <div class="main-content">

        <div class="page-content">

            <div class="container-fluid">

                <!-- start page title -->
                @if (session()->get('success'))
                    <div class="alert alert-success">{{ session()->get('success') }}</div>
                @endif

                <div class="row">

                    <div class="col-12">

                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">

                            <h4 class="mb-sm-0">Dashboard</h4>

                            <div class="page-title-right">

                                <ol class="breadcrumb m-0">

                                    <li class="breadcrumb-item active">Dashboard</li>

                                </ol>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- end page title -->

                @if (Auth::user()->level == 'pelapor')
                    <!-- Pelapor Welcome Banner -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card card-welcome-pelapor border-0 text-white overflow-hidden shadow-sm" style="background: linear-gradient(135deg, #3730a3 0%, #4f46e5 45%, #7c3aed 100%) !important; border-radius: 20px !important; position: relative; box-shadow: 0 10px 30px -5px rgba(79, 70, 229, 0.4) !important;">
                                <div style="position: absolute; right: -20px; bottom: -40px; width: 240px; height: 240px; border-radius: 50%; background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0) 70%); pointer-events: none;"></div>
                                <div style="position: absolute; left: 35%; top: -40px; width: 160px; height: 160px; border-radius: 50%; background: radial-gradient(circle, rgba(255,255,255,0.12) 0%, rgba(255,255,255,0) 70%); pointer-events: none;"></div>
                                <div class="card-body p-4 p-md-5 position-relative" style="background: transparent !important;">
                                    <div class="row align-items-center">
                                        <div class="col-lg-8">
                                            <span class="badge bg-white text-primary px-3 py-2 rounded-pill fw-bold mb-3 shadow-sm" style="font-size: 12px; letter-spacing: 0.5px; color: #4338ca !important;">
                                                <i class="fas fa-shield-halved me-1"></i> Dashboard Pelapor CRS
                                            </span>
                                            <h2 class="fw-bold text-white mb-2" style="font-size: 26px; text-shadow: 0 2px 8px rgba(0,0,0,0.15);">Selamat Datang, {{ Auth::user()->name }}! 👋</h2>
                                            <p class="mb-4" style="max-width: 620px; font-size: 14.5px; line-height: 1.6; color: rgba(255, 255, 255, 0.9) !important;">
                                                Pantau perkembangan investigasi laporan pengaduan Anda secara aman, transparan, dan terenkripsi AES-256.
                                            </p>
                                            <div class="d-flex flex-wrap gap-2">
                                                <a href="{{ url('laporan/form') }}" class="btn btn-light fw-bold px-4 py-2" style="border-radius: 12px; color: #4338ca !important; box-shadow: 0 4px 14px rgba(0,0,0,0.12);">
                                                    <i class="fas fa-plus me-1"></i> Buat Laporan Baru
                                                </a>
                                                <a href="{{ route('laporan.index') }}" class="btn btn-outline-light fw-medium px-4 py-2" style="border-radius: 12px; border: 1.5px solid rgba(255,255,255,0.85); color: #ffffff !important;">
                                                    <i class="fas fa-list-check me-1"></i> Lihat Semua Laporan
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 text-center text-lg-end d-none d-lg-block">
                                            <div style="display: inline-flex; width: 110px; height: 110px; border-radius: 28px; background: rgba(255,255,255,0.2); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); align-items: center; justify-content: center; box-shadow: 0 12px 30px rgba(0,0,0,0.15); border: 1px solid rgba(255,255,255,0.3);">
                                                <i class="fas fa-chart-pie text-white" style="font-size: 48px; color: #ffffff !important;"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 4 Pelapor Stat Cards -->
                    <div class="row g-3 mb-4">
                        <div class="col-xl-3 col-md-6">
                            <div class="card h-100 border-0 shadow-sm" style="border-radius: 16px; background: #ffffff; border-left: 4px solid #4f46e5 !important;">
                                <div class="card-body p-3 p-xl-4">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <span class="text-muted fw-semibold text-uppercase" style="font-size: 11px; letter-spacing: 0.5px;">Total Laporan</span>
                                            <h3 class="fw-bold mb-0 text-dark mt-1">{{ $laporanmasuk }}</h3>
                                            <span class="text-xs text-muted">Seluruh pengaduan Anda</span>
                                        </div>
                                        <div style="width: 50px; height: 50px; border-radius: 14px; background: #eef2ff; color: #4f46e5; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-folder-open" style="font-size: 20px;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card h-100 border-0 shadow-sm" style="border-radius: 16px; background: #ffffff; border-left: 4px solid #0284c7 !important;">
                                <div class="card-body p-3 p-xl-4">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <span class="text-muted fw-semibold text-uppercase" style="font-size: 11px; letter-spacing: 0.5px;">Sedang Diproses</span>
                                            <h3 class="fw-bold mb-0 text-dark mt-1">{{ $laporandiproses }}</h3>
                                            <span class="text-xs text-muted">Dalam tahap tindak lanjut</span>
                                        </div>
                                        <div style="width: 50px; height: 50px; border-radius: 14px; background: #e0f2fe; color: #0284c7; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-spinner fa-spin" style="font-size: 20px;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card h-100 border-0 shadow-sm" style="border-radius: 16px; background: #ffffff; border-left: 4px solid #10b981 !important;">
                                <div class="card-body p-3 p-xl-4">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <span class="text-muted fw-semibold text-uppercase" style="font-size: 11px; letter-spacing: 0.5px;">Laporan Selesai</span>
                                            <h3 class="fw-bold mb-0 text-dark mt-1">{{ $laporanselesai }}</h3>
                                            <span class="text-xs text-muted">Kasus selesai ditangani</span>
                                        </div>
                                        <div style="width: 50px; height: 50px; border-radius: 14px; background: #ecfdf5; color: #10b981; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-circle-check" style="font-size: 20px;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card h-100 border-0 shadow-sm" style="border-radius: 16px; background: #ffffff; border-left: 4px solid #f59e0b !important;">
                                <div class="card-body p-3 p-xl-4">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <span class="text-muted fw-semibold text-uppercase" style="font-size: 11px; letter-spacing: 0.5px;">Ditolak / Sesuai</span>
                                            <h3 class="fw-bold mb-0 text-dark mt-1">{{ $laporanbelumselesai }}</h3>
                                            <span class="text-xs text-muted">Tidak memenuhi kriteria</span>
                                        </div>
                                        <div style="width: 50px; height: 50px; border-radius: 14px; background: #fffbeb; color: #f59e0b; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-triangle-exclamation" style="font-size: 20px;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pelapor Visual Charts (ApexCharts) -->
                    <div class="row g-4 mb-4">
                        <div class="col-xl-8 col-lg-7">
                            <div class="card border-0 shadow-sm h-100" style="border-radius: 18px;">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <div>
                                            <h5 class="fw-bold text-dark mb-1">Aktivitas Laporan Bulanan</h5>
                                            <p class="text-muted mb-0 text-sm">Tren pengajuan laporan Anda dalam 6 bulan terakhir</p>
                                        </div>
                                        <span class="badge bg-light text-primary px-3 py-2 rounded-pill fw-semibold">
                                            <i class="fas fa-chart-line me-1"></i> Real-time
                                        </span>
                                    </div>
                                    <div id="pelaporAreaChart" style="min-height: 310px;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-5">
                            <div class="card border-0 shadow-sm h-100" style="border-radius: 18px;">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <div>
                                            <h5 class="fw-bold text-dark mb-1">Sebaran Status</h5>
                                            <p class="text-muted mb-0 text-sm">Distribusi status seluruh laporan Anda</p>
                                        </div>
                                    </div>
                                    <div id="pelaporDonutChart" style="min-height: 250px;" class="d-flex align-items-center justify-content-center"></div>
                                    <div class="mt-3 pt-3 border-top">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="text-sm text-muted"><span style="display:inline-block;width:10px;height:10px;border-radius:50%;background:#0284c7;margin-right:6px;"></span>Diproses</span>
                                            <span class="fw-bold text-dark">{{ $laporandiproses }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="text-sm text-muted"><span style="display:inline-block;width:10px;height:10px;border-radius:50%;background:#10b981;margin-right:6px;"></span>Selesai</span>
                                            <span class="fw-bold text-dark">{{ $laporanselesai }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="text-sm text-muted"><span style="display:inline-block;width:10px;height:10px;border-radius:50%;background:#f59e0b;margin-right:6px;"></span>Ditolak</span>
                                            <span class="fw-bold text-dark">{{ $laporanbelumselesai }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Laporan Table for Pelapor -->
                    <div class="card border-0 shadow-sm mb-4" style="border-radius: 18px;">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div>
                                    <h5 class="fw-bold text-dark mb-1">Laporan Terkini Anda</h5>
                                    <p class="text-muted mb-0 text-sm">Daftar laporan yang baru-baru ini Anda ajukan</p>
                                </div>
                                <a href="{{ route('laporan.index') }}" class="btn btn-sm btn-outline-primary px-3 rounded-pill">Lihat Semua</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Kode Laporan</th>
                                            <th>Jenis Kekerasan</th>
                                            <th>Perguruan Tinggi</th>
                                            <th>Tanggal Diajukan</th>
                                            <th>Status</th>
                                            <th class="text-end">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($recentLaporan as $item)
                                            @php
                                                try {
                                                    $st = Crypt::decryptString($item->status_laporan);
                                                } catch (\Exception $e) {
                                                    $st = 'Diterima';
                                                }
                                            @endphp
                                            <tr>
                                                <td class="fw-bold text-primary">{{ $item->kode_laporan }}</td>
                                                <td>{{ $item->kekerasan->tipe_kekerasan ?? '-' }}</td>
                                                <td>{{ $item->universitasRel->nama ?? ($item->mitra ?? '-') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y, H:i') }}</td>
                                                <td>
                                                    @if ($st == 'Selesai')
                                                        <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill fw-semibold"><i class="fas fa-check-circle me-1"></i> {{ $st }}</span>
                                                    @elseif ($st == 'Laporan tidak sesuai dengan tindak kekerasan')
                                                        <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill fw-semibold"><i class="fas fa-circle-xmark me-1"></i> Ditolak</span>
                                                    @else
                                                        <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill fw-semibold"><i class="fas fa-clock me-1"></i> {{ $st }}</span>
                                                    @endif
                                                </td>
                                                <td class="text-end">
                                                    <a href="{{ route('laporan.show', ['laporan' => $item->kode_laporan]) }}" class="btn btn-sm btn-light rounded-pill px-3 fw-medium">
                                                        <i class="fas fa-eye me-1"></i> Detail
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center py-4 text-muted">
                                                    <i class="fas fa-inbox fa-2x mb-2 d-block text-secondary"></i>
                                                    Belum ada laporan yang diajukan.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @elseif (Auth::user()->level == 'pt')
                    <!-- PT (Perguruan Tinggi) Welcome Banner -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card card-welcome-pt border-0 text-white overflow-hidden shadow-sm" style="background: linear-gradient(135deg, #065f46 0%, #059669 45%, #0d9488 100%) !important; border-radius: 20px !important; position: relative; box-shadow: 0 10px 30px -5px rgba(5, 150, 105, 0.4) !important;">
                                <div style="position: absolute; right: -20px; bottom: -40px; width: 240px; height: 240px; border-radius: 50%; background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0) 70%); pointer-events: none;"></div>
                                <div style="position: absolute; left: 35%; top: -40px; width: 160px; height: 160px; border-radius: 50%; background: radial-gradient(circle, rgba(255,255,255,0.12) 0%, rgba(255,255,255,0) 70%); pointer-events: none;"></div>
                                <div class="card-body p-4 p-md-5 position-relative" style="background: transparent !important;">
                                    <div class="row align-items-center">
                                        <div class="col-lg-8">
                                            <span class="badge bg-white text-success px-3 py-2 rounded-pill fw-bold mb-3 shadow-sm" style="font-size: 12px; letter-spacing: 0.5px; color: #065f46 !important;">
                                                <i class="fas fa-building-columns me-1"></i> Satgas PPKPT Kampus
                                            </span>
                                            <h2 class="fw-bold text-white mb-2" style="font-size: 26px; text-shadow: 0 2px 8px rgba(0,0,0,0.15);">
                                                Panel Admin {{ $namaUniv }}
                                            </h2>
                                            <p class="mb-4" style="max-width: 640px; font-size: 14.5px; line-height: 1.6; color: rgba(255, 255, 255, 0.9) !important;">
                                                Kelola, tindak lanjuti, dan pantau seluruh laporan pengaduan tindak kekerasan di lingkungan kampus Anda secara cepat, transparan, dan terenkripsi AES-256.
                                            </p>
                                            <div class="d-flex flex-wrap gap-2">
                                                <a href="{{ route('laporan.index') }}" class="btn btn-light fw-bold px-4 py-2" style="border-radius: 12px; color: #065f46 !important; box-shadow: 0 4px 14px rgba(0,0,0,0.12);">
                                                    <i class="fas fa-table-list me-1"></i> Buka Manajemen Laporan
                                                </a>
                                                <a href="{{ url('adm/laporan_gabungan') }}" class="btn btn-outline-light fw-medium px-4 py-2" style="border-radius: 12px; border: 1.5px solid rgba(255,255,255,0.85); color: #ffffff !important;">
                                                    <i class="fas fa-inbox me-1"></i> Laporan Gabungan
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 text-center text-lg-end d-none d-lg-block">
                                            <div style="display: inline-flex; width: 110px; height: 110px; border-radius: 28px; background: rgba(255,255,255,0.2); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); align-items: center; justify-content: center; box-shadow: 0 12px 30px rgba(0,0,0,0.15); border: 1px solid rgba(255,255,255,0.3);">
                                                <i class="fas fa-graduation-cap text-white" style="font-size: 48px; color: #ffffff !important;"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 4 PT Metric Cards -->
                    <div class="row g-3 mb-4">
                        <div class="col-xl-3 col-md-6">
                            <div class="card h-100 border-0 shadow-sm" style="border-radius: 16px; background: #ffffff; border-left: 4px solid #4f46e5 !important;">
                                <div class="card-body p-3 p-xl-4">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <span class="text-muted fw-semibold text-uppercase" style="font-size: 11px; letter-spacing: 0.5px;">Total Laporan Kampus</span>
                                            <h3 class="fw-bold mb-0 text-dark mt-1">{{ $laporanmasuk }}</h3>
                                            <span class="text-xs text-muted">Seluruh laporan di kampus ini</span>
                                        </div>
                                        <div style="width: 50px; height: 50px; border-radius: 14px; background: #eef2ff; color: #4f46e5; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-inbox" style="font-size: 20px;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card h-100 border-0 shadow-sm" style="border-radius: 16px; background: #ffffff; border-left: 4px solid #0284c7 !important;">
                                <div class="card-body p-3 p-xl-4">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <span class="text-muted fw-semibold text-uppercase" style="font-size: 11px; letter-spacing: 0.5px;">Sedang Ditangani</span>
                                            <h3 class="fw-bold mb-0 text-dark mt-1">{{ $laporandiproses }}</h3>
                                            <span class="text-xs text-muted">Proses telaah & pemeriksaan</span>
                                        </div>
                                        <div style="width: 50px; height: 50px; border-radius: 14px; background: #e0f2fe; color: #0284c7; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-user-shield" style="font-size: 20px;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card h-100 border-0 shadow-sm" style="border-radius: 16px; background: #ffffff; border-left: 4px solid #10b981 !important;">
                                <div class="card-body p-3 p-xl-4">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <span class="text-muted fw-semibold text-uppercase" style="font-size: 11px; letter-spacing: 0.5px;">Laporan Selesai</span>
                                            <h3 class="fw-bold mb-0 text-dark mt-1">{{ $laporanselesai }}</h3>
                                            <span class="text-xs text-muted">Rekomendasi & tuntas</span>
                                        </div>
                                        <div style="width: 50px; height: 50px; border-radius: 14px; background: #ecfdf5; color: #10b981; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-circle-check" style="font-size: 20px;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card h-100 border-0 shadow-sm" style="border-radius: 16px; background: #ffffff; border-left: 4px solid #f59e0b !important;">
                                <div class="card-body p-3 p-xl-4">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <span class="text-muted fw-semibold text-uppercase" style="font-size: 11px; letter-spacing: 0.5px;">Ditolak / Tidak Sesuai</span>
                                            <h3 class="fw-bold mb-0 text-dark mt-1">{{ $laporanbelumselesai }}</h3>
                                            <span class="text-xs text-muted">Tidak memenuhi kriteria</span>
                                        </div>
                                        <div style="width: 50px; height: 50px; border-radius: 14px; background: #fffbeb; color: #f59e0b; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-triangle-exclamation" style="font-size: 20px;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- PT Visual Charts (ApexCharts) -->
                    <div class="row g-4 mb-4">
                        <div class="col-xl-8 col-lg-7">
                            <div class="card border-0 shadow-sm h-100" style="border-radius: 18px;">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <div>
                                            <h5 class="fw-bold text-dark mb-1">Tren Laporan Masuk Kampus</h5>
                                            <p class="text-muted mb-0 text-sm">Grafik perkembangan volume laporan 6 bulan terakhir</p>
                                        </div>
                                        <span class="badge bg-light text-success px-3 py-2 rounded-pill fw-semibold">
                                            <i class="fas fa-chart-line me-1"></i> Data Kampus
                                        </span>
                                    </div>
                                    <div id="ptAreaChart" style="min-height: 310px;"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-5">
                            <div class="card border-0 shadow-sm h-100" style="border-radius: 18px;">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <div>
                                            <h5 class="fw-bold text-dark mb-1">Status Penanganan</h5>
                                            <p class="text-muted mb-0 text-sm">Proporsi status penanganan laporan kampus</p>
                                        </div>
                                    </div>
                                    <div id="ptDonutChart" style="min-height: 250px;" class="d-flex align-items-center justify-content-center"></div>
                                    <div class="mt-3 pt-3 border-top">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="text-sm text-muted"><span style="display:inline-block;width:10px;height:10px;border-radius:50%;background:#0284c7;margin-right:6px;"></span>Sedang Ditangani</span>
                                            <span class="fw-bold text-dark">{{ $laporandiproses }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="text-sm text-muted"><span style="display:inline-block;width:10px;height:10px;border-radius:50%;background:#10b981;margin-right:6px;"></span>Selesai</span>
                                            <span class="fw-bold text-dark">{{ $laporanselesai }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="text-sm text-muted"><span style="display:inline-block;width:10px;height:10px;border-radius:50%;background:#f59e0b;margin-right:6px;"></span>Ditolak</span>
                                            <span class="fw-bold text-dark">{{ $laporanbelumselesai }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Laporan Table for PT -->
                    <div class="card border-0 shadow-sm mb-4" style="border-radius: 18px;">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div>
                                    <h5 class="fw-bold text-dark mb-1">Laporan Masuk Terkini</h5>
                                    <p class="text-muted mb-0 text-sm">Daftar kasus kekerasan terbaru yang dilaporkan di {{ $namaUniv }}</p>
                                </div>
                                <a href="{{ route('laporan.index') }}" class="btn btn-sm btn-outline-success px-3 rounded-pill fw-medium">Kelola Semua Laporan</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Kode Laporan</th>
                                            <th>Nama Pelapor</th>
                                            <th>Jenis Kekerasan</th>
                                            <th>Waktu Pengaduan</th>
                                            <th>Status</th>
                                            <th class="text-end">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($recentLaporan as $item)
                                            @php
                                                try {
                                                    $nama = Crypt::decryptString($item->nama);
                                                } catch (\Exception $e) { $nama = 'Anonim'; }
                                                try {
                                                    $st = Crypt::decryptString($item->status_laporan);
                                                } catch (\Exception $e) { $st = 'Diterima'; }
                                            @endphp
                                            <tr>
                                                <td class="fw-bold text-success">{{ $item->kode_laporan }}</td>
                                                <td class="fw-medium text-dark">{{ $nama }}</td>
                                                <td>{{ $item->kekerasan->tipe_kekerasan ?? '-' }}</td>
                                                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y, H:i') }}</td>
                                                <td>
                                                    @if ($st == 'Selesai')
                                                        <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill fw-semibold"><i class="fas fa-check-circle me-1"></i> {{ $st }}</span>
                                                    @elseif ($st == 'Laporan tidak sesuai dengan tindak kekerasan')
                                                        <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill fw-semibold"><i class="fas fa-circle-xmark me-1"></i> Ditolak</span>
                                                    @else
                                                        <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill fw-semibold"><i class="fas fa-clock me-1"></i> {{ $st }}</span>
                                                    @endif
                                                </td>
                                                <td class="text-end">
                                                    <a href="{{ route('laporan.show', ['laporan' => $item->kode_laporan]) }}" class="btn btn-sm btn-light rounded-pill px-3 fw-medium">
                                                        <i class="fas fa-eye me-1 text-primary"></i> Detail
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center py-4 text-muted">
                                                    <i class="fas fa-folder-open fa-2x mb-2 d-block text-secondary"></i>
                                                    Belum ada data laporan masuk untuk kampus ini.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                @else
                    <!-- ========================================== -->
                    <!-- SUPERADMIN MODERN EXECUTIVE DASHBOARD VIEW -->
                    <!-- ========================================== -->

                    <!-- 1. Superadmin Executive Welcome Banner -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card border-0 text-white overflow-hidden shadow-sm" style="background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 40%, #312e81 80%, #4338ca 100%) !important; border-radius: 22px !important; position: relative; box-shadow: 0 16px 36px -10px rgba(15, 23, 42, 0.45) !important;">
                                <!-- Subtle glowing background orbs -->
                                <div style="position: absolute; right: -40px; top: -50px; width: 320px; height: 320px; border-radius: 50%; background: radial-gradient(circle, rgba(99, 102, 241, 0.28) 0%, rgba(99, 102, 241, 0) 70%); pointer-events: none;"></div>
                                <div style="position: absolute; left: 30%; bottom: -60px; width: 240px; height: 240px; border-radius: 50%; background: radial-gradient(circle, rgba(16, 185, 129, 0.15) 0%, rgba(16, 185, 129, 0) 70%); pointer-events: none;"></div>
                                
                                <div class="card-body p-4 p-md-5 position-relative" style="background: transparent !important; z-index: 2;">
                                    <div class="row align-items-center">
                                        <div class="col-lg-8">
                                            <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill mb-3 shadow-sm" style="background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.2); backdrop-filter: blur(8px);">
                                                <span class="badge bg-primary px-2 py-1 rounded-pill fw-bold" style="font-size: 10px; letter-spacing: 0.5px;">LLDIKTI WILAYAH III</span>
                                                <span class="text-white text-xs fw-medium">Pusat Kendali Eksekutif Penanganan Kekerasan</span>
                                            </div>
                                            <h2 class="fw-bold text-white mb-2" style="font-size: 28px; text-shadow: 0 2px 10px rgba(0,0,0,0.3);">
                                                Selamat Datang, Superadmin {{ Auth::user()->name }}! 🛡️
                                            </h2>
                                            <p class="mb-4" style="max-width: 660px; font-size: 14.5px; line-height: 1.6; color: #cbd5e1 !important;">
                                                Pantau seluruh lalu lintas aduan kekerasan di lingkungan perguruan tinggi, evaluasi progres penanganan kampus mitra, serta pastikan integritas data tersimpan aman dengan proteksi <strong>AES-256 CBC</strong>.
                                            </p>
                                            <div class="d-flex flex-wrap gap-2">
                                                <a href="{{ route('laporan.index') }}" class="btn btn-primary fw-semibold px-4 py-2" style="border-radius: 12px; background: #4f46e5; border-color: #4f46e5; box-shadow: 0 6px 20px rgba(79, 70, 229, 0.45);">
                                                    <i class="fas fa-folder-tree me-1"></i> Seluruh Laporan ({{ $laporanmasuk }})
                                                </a>
                                                <a href="{{ route('adm.dekripsi_berkas') }}" class="btn btn-outline-light fw-medium px-4 py-2" style="border-radius: 12px; border: 1.5px solid rgba(255,255,255,0.4); color: #ffffff !important; backdrop-filter: blur(6px);">
                                                    <i class="fas fa-key me-1 text-warning"></i> Enkripsi & Dekripsi Berkas
                                                </a>
                                                <a href="{{ url('admin/universitas') }}" class="btn btn-dark fw-medium px-4 py-2" style="border-radius: 12px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15); color: #ffffff !important;">
                                                    <i class="fas fa-building-columns me-1 text-info"></i> Kampus Mitra ({{ $totalUniv }})
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 text-center text-lg-end mt-4 mt-lg-0 d-none d-lg-block">
                                            <div class="p-3" style="display: inline-block; border-radius: 24px; background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.12); backdrop-filter: blur(14px); box-shadow: 0 20px 40px rgba(0,0,0,0.25);">
                                                <div class="d-flex align-items-center gap-3 text-start">
                                                    <div style="width: 58px; height: 58px; border-radius: 16px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); display: flex; align-items: center; justify-content: center; box-shadow: 0 8px 18px rgba(16, 185, 129, 0.4);">
                                                        <i class="fas fa-shield-halved text-white" style="font-size: 26px;"></i>
                                                    </div>
                                                    <div>
                                                        <div class="text-xs text-uppercase fw-bold text-success" style="letter-spacing: 0.5px;">Sistem Keamanan Aktif</div>
                                                        <div class="text-white fw-bold" style="font-size: 15px;">AES-256 + HMAC SHA-256</div>
                                                        <div class="text-muted" style="font-size: 11.5px; color: #94a3b8 !important;">{{ $totalBerkasTerenkripsi }} Berkas Tersandi Aman</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 2. Superadmin 5 KPI Stat Cards -->
                    <div class="row g-3 mb-4">
                        <!-- Total Laporan -->
                        <div class="col-xl col-md-6 col-12">
                            <div class="card h-100 border-0 shadow-sm" style="border-radius: 18px; background: #ffffff; border-top: 4px solid #4f46e5 !important; transition: transform 0.2s ease, box-shadow 0.2s ease;">
                                <div class="card-body p-3 p-xl-4">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <span class="text-muted fw-bold text-uppercase" style="font-size: 11px; letter-spacing: 0.6px;">Total Laporan</span>
                                        <div style="width: 42px; height: 42px; border-radius: 12px; background: #eef2ff; color: #4f46e5; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-inbox" style="font-size: 18px;"></i>
                                        </div>
                                    </div>
                                    <h3 class="fw-bold mb-1 text-dark" style="font-size: 28px;">{{ $laporanmasuk }}</h3>
                                    <div class="d-flex align-items-center text-muted" style="font-size: 12px;">
                                        <span class="badge bg-primary-subtle text-primary rounded-pill me-1 fw-bold">Global</span>
                                        <span>Seluruh laporan masuk</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sedang Diproses -->
                        <div class="col-xl col-md-6 col-12">
                            <div class="card h-100 border-0 shadow-sm" style="border-radius: 18px; background: #ffffff; border-top: 4px solid #0284c7 !important; transition: transform 0.2s ease, box-shadow 0.2s ease;">
                                <div class="card-body p-3 p-xl-4">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <span class="text-muted fw-bold text-uppercase" style="font-size: 11px; letter-spacing: 0.6px;">Sedang Diproses</span>
                                        <div style="width: 42px; height: 42px; border-radius: 12px; background: #e0f2fe; color: #0284c7; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-spinner fa-spin" style="font-size: 18px;"></i>
                                        </div>
                                    </div>
                                    <h3 class="fw-bold mb-1 text-dark" style="font-size: 28px;">{{ $laporandiproses }}</h3>
                                    <div class="d-flex align-items-center text-muted" style="font-size: 12px;">
                                        <span class="badge bg-info-subtle text-info rounded-pill me-1 fw-bold">Aktif</span>
                                        <span>Dalam investigasi/tindak</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Laporan Selesai -->
                        <div class="col-xl col-md-6 col-12">
                            <div class="card h-100 border-0 shadow-sm" style="border-radius: 18px; background: #ffffff; border-top: 4px solid #10b981 !important; transition: transform 0.2s ease, box-shadow 0.2s ease;">
                                <div class="card-body p-3 p-xl-4">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <span class="text-muted fw-bold text-uppercase" style="font-size: 11px; letter-spacing: 0.6px;">Kasus Selesai</span>
                                        <div style="width: 42px; height: 42px; border-radius: 12px; background: #ecfdf5; color: #10b981; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-circle-check" style="font-size: 18px;"></i>
                                        </div>
                                    </div>
                                    <h3 class="fw-bold mb-1 text-dark" style="font-size: 28px;">{{ $laporanselesai }}</h3>
                                    <div class="d-flex align-items-center text-muted" style="font-size: 12px;">
                                        <span class="badge bg-success-subtle text-success rounded-pill me-1 fw-bold">Tuntas</span>
                                        <span>Penanganan telah selesai</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Laporan Ditolak -->
                        <div class="col-xl col-md-6 col-12">
                            <div class="card h-100 border-0 shadow-sm" style="border-radius: 18px; background: #ffffff; border-top: 4px solid #f59e0b !important; transition: transform 0.2s ease, box-shadow 0.2s ease;">
                                <div class="card-body p-3 p-xl-4">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <span class="text-muted fw-bold text-uppercase" style="font-size: 11px; letter-spacing: 0.6px;">Ditolak / Non-Kekerasan</span>
                                        <div style="width: 42px; height: 42px; border-radius: 12px; background: #fffbeb; color: #f59e0b; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-triangle-exclamation" style="font-size: 18px;"></i>
                                        </div>
                                    </div>
                                    <h3 class="fw-bold mb-1 text-dark" style="font-size: 28px;">{{ $laporanbelumselesai }}</h3>
                                    <div class="d-flex align-items-center text-muted" style="font-size: 12px;">
                                        <span class="badge bg-warning-subtle text-warning rounded-pill me-1 fw-bold">Ditolak</span>
                                        <span>Tidak penuhi kriteria</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Perguruan Tinggi Terdaftar -->
                        <div class="col-xl col-md-6 col-12">
                            <div class="card h-100 border-0 shadow-sm" style="border-radius: 18px; background: #ffffff; border-top: 4px solid #8b5cf6 !important; transition: transform 0.2s ease, box-shadow 0.2s ease;">
                                <div class="card-body p-3 p-xl-4">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <span class="text-muted fw-bold text-uppercase" style="font-size: 11px; letter-spacing: 0.6px;">Kampus Mitra (PT)</span>
                                        <div style="width: 42px; height: 42px; border-radius: 12px; background: #f5f3ff; color: #8b5cf6; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-building-columns" style="font-size: 18px;"></i>
                                        </div>
                                    </div>
                                    <h3 class="fw-bold mb-1 text-dark" style="font-size: 28px;">{{ $totalUniv }}</h3>
                                    <div class="d-flex align-items-center text-muted" style="font-size: 12px;">
                                        <span class="badge bg-secondary-subtle text-secondary rounded-pill me-1 fw-bold">Wilayah III</span>
                                        <span>Tergabung di CRS</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 3. Visual Charts Row (Trend + Status Donut) -->
                    <div class="row g-4 mb-4">
                        <!-- Area Chart Tren 6 Bulan -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card border-0 shadow-sm h-100" style="border-radius: 20px;">
                                <div class="card-body p-4">
                                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3">
                                        <div>
                                            <h5 class="fw-bold text-dark mb-1">
                                                <i class="fas fa-chart-line text-primary me-2"></i>Tren Laporan Masuk & Selesai (6 Bulan Terakhir)
                                            </h5>
                                            <p class="text-muted mb-0 text-sm">Visualisasi perbandingan laju laporan masuk vs penyelesaian kasus</p>
                                        </div>
                                        <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill fw-semibold">
                                            <i class="fas fa-clock me-1"></i> Data Historis
                                        </span>
                                    </div>
                                    <div id="superadminAreaChart" style="min-height: 330px;"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Donut Chart Status Penanganan -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card border-0 shadow-sm h-100" style="border-radius: 20px;">
                                <div class="card-body p-4 d-flex flex-column justify-content-between">
                                    <div>
                                        <div class="d-flex align-items-center justify-content-between mb-3">
                                            <div>
                                                <h5 class="fw-bold text-dark mb-1">
                                                    <i class="fas fa-chart-pie text-success me-2"></i>Distribusi Kasus
                                                </h5>
                                                <p class="text-muted mb-0 text-sm">Rasio status penanganan laporan</p>
                                            </div>
                                        </div>
                                        <div id="superadminDonutChart" style="min-height: 240px;" class="d-flex align-items-center justify-content-center"></div>
                                    </div>
                                    
                                    <div class="mt-3 pt-3 border-top">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="text-sm text-muted">
                                                <span style="display:inline-block;width:10px;height:10px;border-radius:50%;background:#0284c7;margin-right:6px;"></span>Sedang Diproses
                                            </span>
                                            <span class="fw-bold text-dark">{{ $laporandiproses }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="text-sm text-muted">
                                                <span style="display:inline-block;width:10px;height:10px;border-radius:50%;background:#10b981;margin-right:6px;"></span>Selesai Ditangani
                                            </span>
                                            <span class="fw-bold text-dark">{{ $laporanselesai }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="text-sm text-muted">
                                                <span style="display:inline-block;width:10px;height:10px;border-radius:50%;background:#f59e0b;margin-right:6px;"></span>Ditolak
                                            </span>
                                            <span class="fw-bold text-dark">{{ $laporanbelumselesai }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 4. Category Distribution & Cryptography Overview -->
                    <div class="row g-4 mb-4">
                        <!-- Distribusi Jenis Kekerasan -->
                        <div class="col-xl-6">
                            <div class="card border-0 shadow-sm h-100" style="border-radius: 20px;">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <div>
                                            <h5 class="fw-bold text-dark mb-1">
                                                <i class="fas fa-layer-group text-danger me-2"></i>Sebaran Kategori Kekerasan
                                            </h5>
                                            <p class="text-muted mb-0 text-sm">Frekuensi jenis kekerasan yang diadukan ke CRS</p>
                                        </div>
                                    </div>
                                    <div id="superadminBarChart" style="min-height: 290px;"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Widget Keamanan Kriptografi AES-256 -->
                        <div class="col-xl-6">
                            <div class="card border-0 shadow-sm h-100" style="border-radius: 20px; background: #ffffff;">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <div>
                                            <h5 class="fw-bold text-dark mb-1">
                                                <i class="fas fa-shield-virus text-indigo me-2" style="color: #4f46e5;"></i>Integritas Enkripsi AES-256
                                            </h5>
                                            <p class="text-muted mb-0 text-sm">Status proteksi cipher dan privasi data pelapor</p>
                                        </div>
                                        <a href="{{ route('adm.dekripsi_berkas') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-semibold">
                                            Buka Berkas Enkripsi <i class="fas fa-arrow-right ms-1"></i>
                                        </a>
                                    </div>

                                    <div class="p-3 mb-3 rounded-4" style="background: #f8fafc; border: 1px solid #e2e8f0;">
                                        <div class="row g-3 text-center">
                                            <div class="col-4 border-end">
                                                <div class="text-muted text-xs text-uppercase fw-bold">Algoritma</div>
                                                <div class="fw-bold text-dark mt-1" style="font-size: 15px;">AES-256-CBC</div>
                                                <span class="badge bg-success-subtle text-success text-xs rounded-pill">Standar Militer</span>
                                            </div>
                                            <div class="col-4 border-end">
                                                <div class="text-muted text-xs text-uppercase fw-bold">Total File Tersandi</div>
                                                <div class="fw-bold text-indigo mt-1" style="font-size: 17px; color: #4f46e5;">{{ $totalBerkasTerenkripsi }}</div>
                                                <span class="text-xs text-muted">Identitas & Bukti</span>
                                            </div>
                                            <div class="col-4">
                                                <div class="text-muted text-xs text-uppercase fw-bold">Format File Hasil</div>
                                                <div class="fw-bold text-dark mt-1" style="font-size: 15px;">.RDA</div>
                                                <span class="badge bg-primary-subtle text-primary text-xs rounded-pill">Ciphertext</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="list-group list-group-flush">
                                        <div class="list-group-item px-0 py-2 border-0 d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center gap-2">
                                                <i class="fas fa-circle-check text-success"></i>
                                                <span class="text-sm fw-medium text-dark">Enkripsi Database Dinamis (Data Pelapor)</span>
                                            </div>
                                            <span class="badge bg-light text-muted">Aktif</span>
                                        </div>
                                        <div class="list-group-item px-0 py-2 border-0 d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center gap-2">
                                                <i class="fas fa-circle-check text-success"></i>
                                                <span class="text-sm fw-medium text-dark">Audit Durasi Enkripsi & Ukuran Berkas Realtime</span>
                                            </div>
                                            <span class="badge bg-light text-muted">Tersimpan di DB</span>
                                        </div>
                                        <div class="list-group-item px-0 py-2 border-0 d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center gap-2">
                                                <i class="fas fa-circle-check text-success"></i>
                                                <span class="text-sm fw-medium text-dark">Simulasi Deep-Dive Tracing Byte Cipher</span>
                                            </div>
                                            <span class="badge bg-light text-muted">10 Putaran Lengkap</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 5. Recent Reports Table -->
                    <div class="card border-0 shadow-sm mb-4" style="border-radius: 20px;">
                        <div class="card-body p-4">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3">
                                <div>
                                    <h5 class="fw-bold text-dark mb-1">
                                        <i class="fas fa-clock-rotate-left text-primary me-2"></i>Laporan Masuk Terkini
                                    </h5>
                                    <p class="text-muted mb-0 text-sm">Daftar laporan pengaduan terbaru dari seluruh kampus LLDIKTI Wilayah III</p>
                                </div>
                                <a href="{{ route('laporan.index') }}" class="btn btn-sm btn-outline-primary px-3 rounded-pill fw-semibold">
                                    Lihat Seluruh Laporan ({{ $laporanmasuk }}) <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th style="border-top-left-radius: 12px; border-bottom-left-radius: 12px;">Kode Aduan</th>
                                            <th>Pelapor</th>
                                            <th>Perguruan Tinggi</th>
                                            <th>Kategori Kekerasan</th>
                                            <th>Tanggal Masuk</th>
                                            <th>Status</th>
                                            <th class="text-end" style="border-top-right-radius: 12px; border-bottom-right-radius: 12px;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($recentLaporan as $item)
                                            @php
                                                try {
                                                    $nama = Crypt::decryptString($item->nama);
                                                } catch (\Exception $e) { $nama = 'Anonim'; }
                                                try {
                                                    $st = Crypt::decryptString($item->status_laporan);
                                                } catch (\Exception $e) { $st = 'Diterima'; }
                                                $univName = $item->universitasRel->nama ?? 'Perguruan Tinggi';
                                                $tipeKekerasan = $item->kekerasan->tipe_kekerasan ?? 'Lainnya';
                                            @endphp
                                            <tr>
                                                <td>
                                                    <span class="badge bg-light text-dark font-monospace px-2 py-1 border" style="font-size: 12px;">
                                                        #{{ $item->kode_laporan }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div style="width: 32px; height: 32px; border-radius: 50%; background: #eef2ff; color: #4f46e5; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 13px;">
                                                            {{ strtoupper(substr($nama, 0, 1)) }}
                                                        </div>
                                                        <div>
                                                            <div class="fw-semibold text-dark" style="font-size: 13.5px;">{{ $nama }}</div>
                                                            <div class="text-muted" style="font-size: 11px;">Pelapor</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="text-dark fw-medium" style="font-size: 13px;">{{ \Illuminate\Support\Str::limit($univName, 26) }}</span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-secondary-subtle text-secondary px-2 py-1 rounded-pill" style="font-size: 11.5px;">
                                                        {{ $tipeKekerasan }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="text-muted" style="font-size: 12.5px;">
                                                        <i class="far fa-calendar me-1"></i>{{ Carbon::parse($item->created_at)->translatedFormat('d M Y') }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if ($st == 'Selesai')
                                                        <span class="badge bg-success-subtle text-success px-3 py-1 rounded-pill fw-semibold" style="font-size: 11.5px;">
                                                            <i class="fas fa-check-circle me-1"></i> Selesai
                                                        </span>
                                                    @elseif ($st == 'Laporan tidak sesuai dengan tindak kekerasan')
                                                        <span class="badge bg-warning-subtle text-warning px-3 py-1 rounded-pill fw-semibold" style="font-size: 11.5px;">
                                                            <i class="fas fa-circle-xmark me-1"></i> Ditolak
                                                        </span>
                                                    @else
                                                        <span class="badge bg-info-subtle text-info px-3 py-1 rounded-pill fw-semibold" style="font-size: 11.5px;">
                                                            <i class="fas fa-clock me-1"></i> {{ $st }}
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="text-end">
                                                    <a href="{{ route('laporan.show', ['laporan' => $item->kode_laporan]) }}" class="btn btn-sm btn-light rounded-pill px-3 fw-medium" title="Lihat detail laporan">
                                                        <i class="fas fa-eye me-1 text-primary"></i> Detail
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center py-4 text-muted">
                                                    <i class="fas fa-folder-open fa-2x mb-2 d-block text-secondary"></i>
                                                    Belum ada data laporan pengaduan yang masuk.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

        </div>

        <!-- End Page-content -->

<br>
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="text-center">
                        <script>
                            document.write(new Date().getFullYear())
                        </script> © Aplikasi CRS LLDIKTI Wilayah III
                    </div>
                </div>
            </div>
        </footer>

    </div>
    <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->

    <div class="rightbar-overlay"></div>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        @if (Auth::user()->level == 'pelapor')
            // Pelapor Area Chart (Monthly Trends)
            const monthlyData = @json($pelaporMonthly);
            const areaCategories = monthlyData.map(item => item.bulan);
            const areaSeriesData = monthlyData.map(item => item.total);

            var areaOptions = {
                series: [{
                    name: 'Jumlah Laporan Diajukan',
                    data: areaSeriesData
                }],
                chart: {
                    type: 'area',
                    height: 310,
                    toolbar: { show: false },
                    zoom: { enabled: false }
                },
                colors: ['#4f46e5'],
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.45,
                        opacityTo: 0.05,
                        stops: [0, 95, 100]
                    }
                },
                dataLabels: { enabled: false },
                stroke: {
                    curve: 'smooth',
                    width: 3
                },
                xaxis: {
                    categories: areaCategories,
                    labels: { style: { colors: '#64748b', fontSize: '12px' } },
                    axisBorder: { show: false },
                    axisTicks: { show: false }
                },
                yaxis: {
                    min: 0,
                    forceNiceScale: true,
                    labels: { style: { colors: '#64748b', fontSize: '12px' } }
                },
                grid: {
                    borderColor: '#f1f5f9',
                    strokeDashArray: 4
                },
                tooltip: {
                    theme: 'dark',
                    y: { formatter: function(val) { return val + " Laporan"; } }
                }
            };

            var areaChart = new ApexCharts(document.querySelector("#pelaporAreaChart"), areaOptions);
            areaChart.render();

            // Pelapor Donut Chart (Status Distribution)
            const statusData = @json($statusCounts);
            const donutSeries = [
                statusData.Diproses || 0,
                statusData.Selesai || 0,
                statusData.Ditolak || 0
            ];

            var donutOptions = {
                series: donutSeries,
                labels: ['Diproses', 'Selesai', 'Ditolak'],
                chart: { type: 'donut', height: 250 },
                colors: ['#0284c7', '#10b981', '#f59e0b'],
                dataLabels: { enabled: false },
                legend: { show: false },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '72%',
                            labels: {
                                show: true,
                                name: { fontSize: '14px', color: '#64748b' },
                                value: { fontSize: '22px', fontWeight: 700, color: '#1e293b' },
                                total: {
                                    show: true,
                                    label: 'Total',
                                    color: '#64748b',
                                    formatter: function(w) { return w.globals.seriesTotals.reduce((a, b) => a + b, 0); }
                                }
                            }
                        }
                    }
                },
                tooltip: {
                    theme: 'dark',
                    y: { formatter: function(val) { return val + " Laporan"; } }
                }
            };

            var donutChart = new ApexCharts(document.querySelector("#pelaporDonutChart"), donutOptions);
            donutChart.render();

        @elseif (Auth::user()->level == 'pt')
            // PT Area Chart (Monthly Trends)
            const ptData = @json($ptMonthly);
            const ptCategories = ptData.map(item => item.bulan);
            const ptSeriesData = ptData.map(item => item.total);

            var ptAreaOptions = {
                series: [{
                    name: 'Jumlah Laporan Kampus',
                    data: ptSeriesData
                }],
                chart: {
                    type: 'area',
                    height: 310,
                    toolbar: { show: false },
                    zoom: { enabled: false }
                },
                colors: ['#059669'],
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.45,
                        opacityTo: 0.05,
                        stops: [0, 95, 100]
                    }
                },
                dataLabels: { enabled: false },
                stroke: {
                    curve: 'smooth',
                    width: 3
                },
                xaxis: {
                    categories: ptCategories,
                    labels: { style: { colors: '#64748b', fontSize: '12px' } },
                    axisBorder: { show: false },
                    axisTicks: { show: false }
                },
                yaxis: {
                    min: 0,
                    forceNiceScale: true,
                    labels: { style: { colors: '#64748b', fontSize: '12px' } }
                },
                grid: {
                    borderColor: '#f1f5f9',
                    strokeDashArray: 4
                },
                tooltip: {
                    theme: 'dark',
                    y: { formatter: function(val) { return val + " Laporan"; } }
                }
            };

            var ptAreaChart = new ApexCharts(document.querySelector("#ptAreaChart"), ptAreaOptions);
            ptAreaChart.render();

            // PT Donut Chart (Status Distribution)
            const ptStatusData = @json($statusCounts);
            const ptDonutSeries = [
                ptStatusData.Diproses || 0,
                ptStatusData.Selesai || 0,
                ptStatusData.Ditolak || 0
            ];

            var ptDonutOptions = {
                series: ptDonutSeries,
                labels: ['Diproses', 'Selesai', 'Ditolak'],
                chart: { type: 'donut', height: 250 },
                colors: ['#0284c7', '#10b981', '#f59e0b'],
                dataLabels: { enabled: false },
                legend: { show: false },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '72%',
                            labels: {
                                show: true,
                                name: { fontSize: '14px', color: '#64748b' },
                                value: { fontSize: '22px', fontWeight: 700, color: '#1e293b' },
                                total: {
                                    show: true,
                                    label: 'Total',
                                    color: '#64748b',
                                    formatter: function(w) { return w.globals.seriesTotals.reduce((a, b) => a + b, 0); }
                                }
                            }
                        }
                    }
                },
                tooltip: {
                    theme: 'dark',
                    y: { formatter: function(val) { return val + " Laporan"; } }
                }
            };

            var ptDonutChart = new ApexCharts(document.querySelector("#ptDonutChart"), ptDonutOptions);
            ptDonutChart.render();

        @else
            // ===================================
            // SUPERADMIN APEXCHARTS INITIALIZATION
            // ===================================

            // 1. Superadmin Area Chart (6-Month Trends: Masuk vs Selesai)
            const superMonthlyData = @json($superadminMonthly);
            const superAreaCategories = superMonthlyData.map(item => item.bulan);
            const superTotalSeries = superMonthlyData.map(item => item.total);
            const superSelesaiSeries = superMonthlyData.map(item => item.selesai);

            var superAreaOptions = {
                series: [
                    {
                        name: 'Laporan Masuk',
                        data: superTotalSeries
                    },
                    {
                        name: 'Laporan Selesai',
                        data: superSelesaiSeries
                    }
                ],
                chart: {
                    type: 'area',
                    height: 330,
                    toolbar: { show: false },
                    zoom: { enabled: false }
                },
                colors: ['#4f46e5', '#10b981'],
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.45,
                        opacityTo: 0.05,
                        stops: [0, 95, 100]
                    }
                },
                dataLabels: { enabled: false },
                stroke: {
                    curve: 'smooth',
                    width: [3, 3]
                },
                xaxis: {
                    categories: superAreaCategories,
                    labels: { style: { colors: '#64748b', fontSize: '12px' } },
                    axisBorder: { show: false },
                    axisTicks: { show: false }
                },
                yaxis: {
                    min: 0,
                    forceNiceScale: true,
                    labels: { style: { colors: '#64748b', fontSize: '12px' } }
                },
                grid: {
                    borderColor: '#f1f5f9',
                    strokeDashArray: 4
                },
                legend: {
                    position: 'top',
                    horizontalAlign: 'right',
                    fontSize: '13px',
                    markers: { radius: 12 }
                },
                tooltip: {
                    theme: 'dark',
                    y: { formatter: function(val) { return val + " Kasus"; } }
                }
            };

            var superAreaChart = new ApexCharts(document.querySelector("#superadminAreaChart"), superAreaOptions);
            superAreaChart.render();

            // 2. Superadmin Donut Chart (Status Penanganan)
            const superStatusData = @json($statusCounts);
            const superDonutSeries = [
                superStatusData.Diproses || 0,
                superStatusData.Selesai || 0,
                superStatusData.Ditolak || 0
            ];

            var superDonutOptions = {
                series: superDonutSeries,
                labels: ['Diproses', 'Selesai', 'Ditolak'],
                chart: { type: 'donut', height: 240 },
                colors: ['#0284c7', '#10b981', '#f59e0b'],
                dataLabels: { enabled: false },
                legend: { show: false },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '72%',
                            labels: {
                                show: true,
                                name: { fontSize: '14px', color: '#64748b' },
                                value: { fontSize: '22px', fontWeight: 700, color: '#1e293b' },
                                total: {
                                    show: true,
                                    label: 'Total',
                                    color: '#64748b',
                                    formatter: function(w) { return w.globals.seriesTotals.reduce((a, b) => a + b, 0); }
                                }
                            }
                        }
                    }
                },
                tooltip: {
                    theme: 'dark',
                    y: { formatter: function(val) { return val + " Laporan"; } }
                }
            };

            var superDonutChart = new ApexCharts(document.querySelector("#superadminDonutChart"), superDonutOptions);
            superDonutChart.render();

            // 3. Superadmin Horizontal Bar Chart (Kategori Kekerasan)
            const superKekerasanData = @json($kekerasanCounts);
            const barCategories = Object.keys(superKekerasanData);
            const barValues = Object.values(superKekerasanData);

            var superBarOptions = {
                series: [{
                    name: 'Jumlah Kasus',
                    data: barValues.length > 0 ? barValues : [0]
                }],
                chart: {
                    type: 'bar',
                    height: 290,
                    toolbar: { show: false }
                },
                plotOptions: {
                    bar: {
                        borderRadius: 6,
                        horizontal: true,
                        distributed: true,
                        barHeight: '55%'
                    }
                },
                colors: ['#ef4444', '#f59e0b', '#3b82f6', '#8b5cf6', '#10b981', '#06b6d4'],
                dataLabels: {
                    enabled: true,
                    style: { fontSize: '12px', fontWeight: 600, colors: ['#ffffff'] },
                    formatter: function(val) { return val; }
                },
                xaxis: {
                    categories: barCategories.length > 0 ? barCategories : ['Belum Ada Data'],
                    labels: { style: { colors: '#64748b', fontSize: '12px' } }
                },
                yaxis: {
                    labels: { style: { colors: '#334155', fontSize: '12px', fontWeight: 500 } }
                },
                grid: {
                    borderColor: '#f1f5f9',
                    strokeDashArray: 4
                },
                legend: { show: false },
                tooltip: {
                    theme: 'dark',
                    y: { formatter: function(val) { return val + " Kasus"; } }
                }
            };

            var superBarChart = new ApexCharts(document.querySelector("#superadminBarChart"), superBarOptions);
            superBarChart.render();
        @endif
    </script>

    @push('js')
        <script src="{{ asset('admin/js/pages/dashboard.init.js') }}"></script>
    @endpush
@endsection
