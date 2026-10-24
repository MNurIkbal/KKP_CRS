@extends('layouts.Admin.adm')

@section('content')
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
                            <div class="card border-0 text-white overflow-hidden shadow-sm" style="background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%); border-radius: 18px; position: relative;">
                                <div style="position: absolute; right: -20px; bottom: -40px; width: 220px; height: 220px; border-radius: 50%; background: radial-gradient(circle, rgba(255,255,255,0.18) 0%, rgba(255,255,255,0) 70%);"></div>
                                <div style="position: absolute; left: 30%; top: -30px; width: 140px; height: 140px; border-radius: 50%; background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);"></div>
                                <div class="card-body p-4 p-md-5 position-relative">
                                    <div class="row align-items-center">
                                        <div class="col-lg-8">
                                            <span class="badge bg-white text-primary px-3 py-2 rounded-pill fw-semibold mb-3" style="font-size: 12px; letter-spacing: 0.5px;">
                                                <i class="fas fa-shield-halved me-1"></i> Dashboard Pelapor CRS
                                            </span>
                                            <h2 class="fw-bold text-white mb-2">Selamat Datang, {{ Auth::user()->name }}! 👋</h2>
                                            <p class="text-white-50 mb-4" style="max-width: 620px; font-size: 15px; line-height: 1.6;">
                                                Pantau perkembangan investigasi laporan pengaduan Anda secara aman, transparan, dan terenkripsi AES-256.
                                            </p>
                                            <div class="d-flex flex-wrap gap-2">
                                                <a href="{{ url('laporan/form') }}" class="btn btn-light fw-bold px-4 py-2" style="border-radius: 12px; color: #4f46e5;">
                                                    <i class="fas fa-plus me-1"></i> Buat Laporan Baru
                                                </a>
                                                <a href="{{ route('laporan.index') }}" class="btn btn-outline-light fw-medium px-4 py-2" style="border-radius: 12px;">
                                                    <i class="fas fa-list-check me-1"></i> Lihat Semua Laporan
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 text-center text-lg-end d-none d-lg-block">
                                            <div style="display: inline-flex; width: 110px; height: 110px; border-radius: 28px; background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); align-items: center; justify-content: center; box-shadow: 0 12px 30px rgba(0,0,0,0.15);">
                                                <i class="fas fa-chart-pie text-white" style="font-size: 48px;"></i>
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
                @else
                    <!-- Admin / Superadmin View -->
                    <div class="row g-4 mb-4">
                        <div class="col-xl-4 col-md-4">
                            <div class="card h-100" style="background: linear-gradient(135deg, #eef2ff 0%, #ffffff 100%); border-left: 4px solid #4f46e5 !important;">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <p class="text-uppercase fw-semibold text-secondary mb-1" style="font-size: 12px; letter-spacing: 0.5px;">Laporan Masuk</p>
                                            <h2 class="fw-bold mb-0 text-dark">{{ $laporanmasuk }}</h2>
                                        </div>
                                        <div style="width: 54px; height: 54px; border-radius: 16px; background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%); display: flex; align-items: center; justify-content: center; box-shadow: 0 8px 16px -4px rgba(79, 70, 229, 0.4);">
                                            <i class="fas fa-inbox text-white" style="font-size: 22px;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-4">
                            <div class="card h-100" style="background: linear-gradient(135deg, #ecfdf5 0%, #ffffff 100%); border-left: 4px solid #10b981 !important;">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <p class="text-uppercase fw-semibold text-secondary mb-1" style="font-size: 12px; letter-spacing: 0.5px;">Laporan Selesai</p>
                                            <h2 class="fw-bold mb-0 text-dark">{{ $laporanselesai }}</h2>
                                        </div>
                                        <div style="width: 54px; height: 54px; border-radius: 16px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); display: flex; align-items: center; justify-content: center; box-shadow: 0 8px 16px -4px rgba(16, 185, 129, 0.4);">
                                            <i class="fas fa-circle-check text-white" style="font-size: 22px;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-4">
                            <div class="card h-100" style="background: linear-gradient(135deg, #fff7ed 0%, #ffffff 100%); border-left: 4px solid #f59e0b !important;">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <p class="text-uppercase fw-semibold text-secondary mb-1" style="font-size: 12px; letter-spacing: 0.5px;">Laporan Ditolak / Tdk Sesuai</p>
                                            <h2 class="fw-bold mb-0 text-dark">{{ $laporanbelumselesai }}</h2>
                                        </div>
                                        <div style="width: 54px; height: 54px; border-radius: 16px; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); display: flex; align-items: center; justify-content: center; box-shadow: 0 8px 16px -4px rgba(245, 158, 11, 0.4);">
                                            <i class="fas fa-triangle-exclamation text-white" style="font-size: 22px;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body p-4">
                            <h5 class="fw-bold text-dark mb-3">Statistik Tren Laporan</h5>
                            <div id="grafik" style="width: 100%; min-height: 400px;"></div>
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
                    labels: {
                        style: { colors: '#64748b', fontSize: '12px' }
                    },
                    axisBorder: { show: false },
                    axisTicks: { show: false }
                },
                yaxis: {
                    min: 0,
                    forceNiceScale: true,
                    labels: {
                        style: { colors: '#64748b', fontSize: '12px' }
                    }
                },
                grid: {
                    borderColor: '#f1f5f9',
                    strokeDashArray: 4
                },
                tooltip: {
                    theme: 'dark',
                    y: {
                        formatter: function(val) {
                            return val + " Laporan";
                        }
                    }
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
                chart: {
                    type: 'donut',
                    height: 250
                },
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
                                    formatter: function(w) {
                                        return w.globals.seriesTotals.reduce((a, b) => a + b, 0);
                                    }
                                }
                            }
                        }
                    }
                },
                tooltip: {
                    theme: 'dark',
                    y: {
                        formatter: function(val) {
                            return val + " Laporan";
                        }
                    }
                }
            };

            var donutChart = new ApexCharts(document.querySelector("#pelaporDonutChart"), donutOptions);
            donutChart.render();

        @else
            // Superadmin / Admin PT Line Chart
            const grafikData = @json($grafik);
            const labels = grafikData.map(item => {
                const date = new Date(item.bulan + '-01'); 
                return date.toLocaleString('default', { month: 'short', year: 'numeric' });
            });

            const data = grafikData.map(item => item.views);

            var options = {
                series: [{
                    name: "Grafik Laporan Perbulan",
                    data: data
                }],
                chart: {
                    height: 420,
                    type: 'line',
                    toolbar: { show: false },
                    zoom: { enabled: false }
                },
                colors: ['#4f46e5'],
                dataLabels: { enabled: false },
                stroke: {
                    curve: 'smooth',
                    width: 3
                },
                grid: {
                    row: {
                        colors: ['#f8fafc', 'transparent'],
                        opacity: 0.5
                    },
                    borderColor: '#f1f5f9'
                },
                xaxis: {
                    categories: labels
                }
            };

            var chart = new ApexCharts(document.querySelector("#grafik"), options);
            chart.render();
        @endif
    </script>

    @push('js')
        <script src="{{ asset('admin/js/pages/dashboard.init.js') }}"></script>
    @endpush
@endsection
