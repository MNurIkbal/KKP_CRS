@extends('layouts.Admin.adm')
@section('content')
    <div id="content" class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                @include('layouts.Admin.breadcrumbs')
                
                <!-- Welcome Banner Enkripsi & Dekripsi -->
                <div class="card border-0 shadow-sm rounded-4 mb-4" style="background: linear-gradient(135deg, #1e1b4b 0%, #312e81 50%, #4338ca 100%); color: #ffffff;">
                    <div class="card-body p-4 p-md-5 position-relative overflow-hidden">
                        <div class="row align-items-center">
                            <div class="col-lg-8">
                                <div class="badge px-3 py-1 mb-3 rounded-pill bg-white text-primary fw-bold" style="font-size: 11.5px; letter-spacing: 0.5px;">
                                    <i class="fas fa-shield-halved me-1 text-primary"></i> ADVANCED ENCRYPTION STANDARD (AES-256)
                                </div>
                                <h3 class="fw-bold mb-2 text-white">Pusat Enkripsi & Dekripsi Berkas CRS</h3>
                                <p class="text-white-50 mb-0" style="font-size: 14.5px; line-height: 1.6;">
                                    Seluruh berkas dokumen identitas (KTP/KTM) dan dokumen bukti kekerasan yang diunggah oleh pelapor secara otomatis diamankan dengan algoritma kriptografi <strong>AES-256</strong>. Anda dapat melihat status enkripsi dan melakukan pengunduhan serta dekripsi langsung melalui menu ini.
                                </p>
                            </div>
                            <div class="col-lg-4 text-center text-lg-end mt-4 mt-lg-0">
                                <div class="d-inline-flex p-3 rounded-4" style="background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(8px); border: 1px solid rgba(255, 255, 255, 0.15);">
                                    <div class="text-center px-3">
                                        <h2 class="fw-bold text-white mb-0">{{ $laporans->count() }}</h2>
                                        <small class="text-white-50">Laporan Berkas Terenkripsi</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @include('components.alert')

@push('css')
<style>
    .card-table-dekripsi {
        border-radius: 20px !important;
        border: 1px solid #eef2f6 !important;
        background: #ffffff;
        box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.05);
    }
    .table-responsive {
        overflow-x: auto;
        overflow-y: visible !important;
        padding-bottom: 70px;
    }
    .dropdown {
        position: relative !important;
    }
    .dropdown-menu {
        z-index: 1060 !important;
        margin-top: 4px !important;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.12), 0 8px 10px -6px rgba(0, 0, 0, 0.08) !important;
        border: 1px solid #e2e8f0 !important;
    }
    .btn-action-gray {
        background: #f1f5f9 !important;
        color: #475569 !important;
        border: 1px solid #cbd5e1 !important;
        font-weight: 600 !important;
        font-size: 12px !important;
        padding: 5px 14px !important;
        border-radius: 20px !important;
        transition: all 0.2s ease !important;
    }
    .btn-action-gray:hover, 
    .btn-action-gray:focus, 
    .btn-action-gray[aria-expanded="true"] {
        background: #e2e8f0 !important;
        color: #1e293b !important;
        border-color: #94a3b8 !important;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08) !important;
    }
    .table-dekripsi thead th {
        background: #f8fafc !important;
        color: #475569 !important;
        font-weight: 700 !important;
        font-size: 11.5px !important;
        text-transform: uppercase !important;
        letter-spacing: 0.8px !important;
        border-bottom: 2px solid #edf2f7 !important;
        padding: 16px 18px !important;
        white-space: nowrap;
    }
    .table-dekripsi tbody td {
        padding: 16px 18px !important;
        vertical-align: middle !important;
        border-bottom: 1px solid #f1f5f9 !important;
        font-size: 13.5px !important;
        color: #1e293b;
    }
    .table-dekripsi tbody tr {
        transition: background-color 0.15s ease;
    }
    .table-dekripsi tbody tr:hover {
        background-color: #f8faff !important;
    }
    .btn-decrypt-identity {
        background: #ecfdf5 !important;
        color: #059669 !important;
        border: 1px solid #a7f3d0 !important;
        font-weight: 600 !important;
        font-size: 12px !important;
        padding: 6px 14px !important;
        border-radius: 10px !important;
        transition: all 0.2s ease !important;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .btn-decrypt-identity:hover {
        background: #059669 !important;
        color: #ffffff !important;
        box-shadow: 0 4px 12px rgba(5, 150, 105, 0.25) !important;
    }
    .btn-decrypt-evidence {
        background: #eff6ff !important;
        color: #2563eb !important;
        border: 1px solid #bfdbfe !important;
        font-weight: 600 !important;
        font-size: 12px !important;
        padding: 6px 14px !important;
        border-radius: 10px !important;
        transition: all 0.2s ease !important;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .btn-decrypt-evidence:hover {
        background: #2563eb !important;
        color: #ffffff !important;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25) !important;
    }
    .badge-code {
        background: #f1f5f9;
        color: #4338ca;
        border: 1px solid #e0e7ff;
        font-family: monospace;
        font-size: 12px;
        padding: 4px 10px;
        border-radius: 8px;
        font-weight: 700;
    }
    .badge-aes-tag {
        font-size: 10px;
        font-weight: 800;
        padding: 3px 8px;
        border-radius: 6px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .badge-aes-green {
        background: #d1fae5;
        color: #047857;
        border: 1px solid #a7f3d0;
    }
    .badge-aes-blue {
        background: #dbeafe;
        color: #1d4ed8;
        border: 1px solid #bfdbfe;
    }
    .metric-pill {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 4px 10px;
        border-radius: 8px;
        font-size: 11.5px;
        font-weight: 600;
        letter-spacing: 0.2px;
    }
    .metric-pill-size {
        background: #f1f5f9;
        color: #334155;
        border: 1px solid #e2e8f0;
    }
    .metric-pill-time {
        background: #fef3c7;
        color: #92400e;
        border: 1px solid #fde68a;
    }
    .metric-pill-decrypt {
        background: #ecfdf5;
        color: #065f46;
        border: 1px solid #a7f3d0;
    }
    .btn-action-detail {
        background: #ffffff;
        color: #64748b;
        border: 1px solid #cbd5e1;
        font-weight: 600;
        font-size: 12px;
        padding: 6px 14px;
        border-radius: 10px;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .btn-action-detail:hover {
        background: #4f46e5;
        color: #ffffff;
        border-color: #4f46e5;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.25);
    }
    /* DataTables Controls Redesign */
    .dataTables_wrapper {
        padding: 20px 24px;
    }
    .dataTables_wrapper .dataTables_filter input {
        border: 1px solid #cbd5e1 !important;
        border-radius: 10px !important;
        padding: 8px 14px !important;
        font-size: 13px !important;
        min-width: 240px;
        outline: none !important;
        box-shadow: none !important;
    }
    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: #6366f1 !important;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15) !important;
    }
    .dataTables_wrapper .dataTables_length select {
        border: 1px solid #cbd5e1 !important;
        border-radius: 8px !important;
        padding: 6px 30px 6px 12px !important;
        font-size: 13px !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: #4f46e5 !important;
        color: #ffffff !important;
        border: none !important;
        border-radius: 8px !important;
        font-weight: 700 !important;
        box-shadow: 0 4px 10px rgba(79, 70, 229, 0.3) !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: #e0e7ff !important;
        color: #4338ca !important;
        border-color: transparent !important;
        border-radius: 8px !important;
    }
</style>
@endpush

<div class="card card-table-dekripsi">
    <div class="p-4 bg-white border-bottom d-flex align-items-center justify-content-between flex-wrap gap-3">
        <div class="d-flex align-items-center gap-3">
            <div class="rounded-3 p-3 d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%); width: 48px; height: 48px; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);">
                <i class="fas fa-file-shield text-white fs-5"></i>
            </div>
            <div>
                <h5 class="fw-bold text-dark mb-0">Daftar Berkas Terenkripsi</h5>
                <p class="text-muted mb-0" style="font-size: 12.5px;">Buka berkas ciphertext asli secara aman menggunakan kunci enkripsi AES-256</p>
            </div>
        </div>
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('adm.pengujian_kriptografi') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-bold">
                <i class="fas fa-flask-vial me-1"></i> Uji Benchmark AES
            </a>
            <span class="badge bg-light text-secondary border px-3 py-2 fw-semibold">
                <i class="fas fa-database me-1 text-primary"></i> Total: <strong>{{ $laporans->count() }}</strong> Dokumen
            </span>
        </div>
    </div>

    <div class="p-0">
        <div class="table-responsive">
            <table id="datatabel" class="table table-dekripsi align-middle mb-0" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 50px;">NO</th>
                        <th>KODE LAPORAN</th>
                        <th>NAMA PELAPOR</th>
                        <th>KAMPUS / ASAL</th>
                        <th>UKURAN BERKAS</th>
                        <th>WAKTU ENKRIPSI</th>
                        <th>TANGGAL UNGGAH</th>
                        <th class="text-center" style="width: 100px;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($laporans as $item)
                        @php
                            $pelaporNama = '-';
                            try {
                                $pelaporNama = Illuminate\Support\Facades\Crypt::decryptString($item->nama);
                            } catch (\Exception $e) {
                                $pelaporNama = $item->nama;
                            }

                            // Kalkulasi ukuran berkas riil jika belum tersimpan di DB
                            $totalSizeKB = 0;
                            $hasFile = false;

                            if ($item->upload_identitas) {
                                try {
                                    $decPathId = Illuminate\Support\Facades\Crypt::decryptString($item->upload_identitas);
                                    if (file_exists(public_path($decPathId))) {
                                        $totalSizeKB += filesize(public_path($decPathId)) / 1024;
                                        $hasFile = true;
                                    }
                                } catch (\Exception $e) {}
                            }
                            if ($item->upload_bukti) {
                                try {
                                    $decPathBkt = Illuminate\Support\Facades\Crypt::decryptString($item->upload_bukti);
                                    if (file_exists(public_path($decPathBkt))) {
                                        $totalSizeKB += filesize(public_path($decPathBkt)) / 1024;
                                        $hasFile = true;
                                    }
                                } catch (\Exception $e) {}
                            }

                            // Display size
                            if (!empty($item->ukuran_file)) {
                                $displaySize = $item->ukuran_file . ' MB';
                            } elseif ($hasFile) {
                                if ($totalSizeKB >= 1024) {
                                    $displaySize = number_format($totalSizeKB / 1024, 2) . ' MB';
                                } else {
                                    $displaySize = number_format($totalSizeKB, 1) . ' KB';
                                }
                            } else {
                                $displaySize = '-';
                            }

                            // Display waktu enkripsi
                            $displayWaktuEnkripsi = !empty($item->waktu_enkripsi) ? $item->waktu_enkripsi . ' detik' : '-';
                        @endphp
                        <tr>
                            <td class="text-center text-muted fw-bold">{{ $loop->iteration }}</td>
                            <td>
                                <span class="badge-code">{{ $item->kode_laporan }}</span>
                            </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="rounded-circle bg-light border d-flex align-items-center justify-content-center text-primary fw-bold" style="width: 32px; height: 32px; font-size: 12px;">
                                            {{ strtoupper(substr($pelaporNama, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark">{{ $pelaporNama }}</div>
                                            @php
                                                $algo = $item->aes_algorithm ?? 'AES-128';
                                            @endphp
                                            @if ($algo === 'AES-256')
                                                <span class="badge bg-success-subtle text-success border border-success-subtle" style="font-size: 10px; padding: 2px 6px;">
                                                    <i class="fas fa-shield me-1"></i>AES-256 (14R)
                                                </span>
                                            @else
                                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle" style="font-size: 10px; padding: 2px 6px;">
                                                    <i class="fas fa-lock me-1"></i>AES-128 (10R)
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            <td>
                                @if ($item->universitasRel)
                                    <div class="d-flex align-items-center gap-1.5 text-slate-700">
                                        <i class="fas fa-building-columns text-muted me-1" style="font-size: 11px;"></i>
                                        <span>{{ $item->universitasRel->nama }}</span>
                                    </div>
                                @elseif ($item->mitra == 'Mitra')
                                    <span class="badge bg-secondary-subtle text-secondary border">Mitra</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if ($displaySize != '-')
                                    <span class="metric-pill metric-pill-size">
                                        <i class="fas fa-weight-hanging text-muted"></i>
                                        <span>{{ $displaySize }}</span>
                                    </span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if ($displayWaktuEnkripsi != '-')
                                    <span class="metric-pill metric-pill-time">
                                        <i class="fas fa-stopwatch"></i>
                                        <span>{{ $displayWaktuEnkripsi }}</span>
                                    </span>
                                @else
                                    <span class="badge bg-light text-muted border fw-normal" style="font-size: 11px;">
                                        <i class="fas fa-bolt text-secondary me-1"></i>Instant (< 0.1s)
                                    </span>
                                @endif
                            </td>
                            <td class="text-muted" style="font-size: 12.5px;">
                                <i class="far fa-clock me-1 text-muted"></i>
                                {{ \Carbon\Carbon::parse($item->created_at)->locale('id')->isoFormat('D MMM Y, HH:mm') }}
                            </td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-action-gray dropdown-toggle" 
                                            type="button" 
                                            data-bs-toggle="dropdown" 
                                            aria-expanded="false">
                                        <i class="fas fa-ellipsis-vertical me-1 text-muted"></i> Aksi
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3 p-2" style="font-size: 13px; min-width: 210px;">
                                        <li>
                                            <h6 class="dropdown-header text-uppercase text-muted" style="font-size: 11px; letter-spacing: 0.5px;">Dokumen Terenkripsi</h6>
                                        </li>
                                        @php
                                            $pengaturanAktif = \App\Models\PengaturanModel::orderby('id', 'DESC')->first();
                                            $sistemAlgo = $pengaturanAktif->aes_algorithm ?? 'AES-128';
                                            $isAlgoMatch = ($algo === $sistemAlgo);
                                        @endphp

                                        @if (!$isAlgoMatch)
                                            <li>
                                                <div class="px-3 py-2 my-1 rounded-2 border" style="background: #fffbeb; border-color: #fde68a !important; font-size: 11.5px; line-height: 1.4;">
                                                    <div class="fw-bold text-warning-emphasis mb-1">
                                                        <i class="fas fa-triangle-exclamation text-warning me-1"></i> Perbedaan Algoritma
                                                    </div>
                                                    <span class="text-secondary">
                                                        Berkas ini dienkripsi dengan <strong>{{ $algo }}</strong>, sedangkan sistem disetel ke <strong>{{ $sistemAlgo }}</strong>.
                                                    </span>
                                                    <div class="mt-1 fw-semibold text-danger" style="font-size: 11px;">
                                                        Hubungi Admin untuk ubah pengaturan ke {{ $algo }} untuk mendekripsi.
                                                    </div>
                                                </div>
                                            </li>
                                        @endif

                                        @if ($item->upload_identitas)
                                            @if ($isAlgoMatch)
                                                <li>
                                                    <button class="dropdown-item py-2 rounded-2 text-success" 
                                                            type="button" 
                                                            onclick="bukaModalDekripsi('{{ $item->upload_identitas }}', 'laporan', '{{ $item->id }}', 'Dokumen Identitas', '{{ $item->kode_laporan }}', '{{ $displaySize }}', '{{ $displayWaktuEnkripsi }}')">
                                                        <i class="fas fa-key me-2 text-success"></i> Dekripsi Identitas
                                                    </button>
                                                </li>
                                            @endif
                                            <li>
                                                <a class="dropdown-item py-2 rounded-2 text-dark" 
                                                   href="{{ route('adm.download_berkas_enkripsi', ['path' => $item->upload_identitas]) }}">
                                                    <i class="fas fa-file-code me-2 text-warning"></i> Unduh Identitas (.rda)
                                                </a>
                                            </li>
                                        @endif
                                        @if ($item->upload_bukti)
                                            @if ($isAlgoMatch)
                                                <li>
                                                    <button class="dropdown-item py-2 rounded-2 text-primary" 
                                                            type="button" 
                                                            onclick="bukaModalDekripsi('{{ $item->upload_bukti }}', 'laporan', '{{ $item->id }}', 'Dokumen Bukti Kejadian', '{{ $item->kode_laporan }}', '{{ $displaySize }}', '{{ $displayWaktuEnkripsi }}')">
                                                        <i class="fas fa-key me-2 text-primary"></i> Dekripsi Bukti
                                                    </button>
                                                </li>
                                            @endif
                                            <li>
                                                <a class="dropdown-item py-2 rounded-2 text-dark" 
                                                   href="{{ route('adm.download_berkas_enkripsi', ['path' => $item->upload_bukti]) }}">
                                                    <i class="fas fa-file-code me-2 text-warning"></i> Unduh Bukti (.rda)
                                                </a>
                                            </li>
                                        @endif
                                        <li><hr class="dropdown-divider my-1"></li>
                                        <li>
                                            <a class="dropdown-item py-2 rounded-2 fw-semibold text-primary" 
                                               href="{{ route('adm.kriptografi.cara_kerja', ['kode_laporan' => $item->kode_laporan]) }}">
                                                <i class="fas fa-microchip me-2 text-primary"></i> Cara Kerja AES
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item py-2 rounded-2 text-secondary" 
                                               href="{{ route('laporan.show', ['laporan' => $item->kode_laporan]) }}">
                                                <i class="fas fa-arrow-up-right-from-square me-2 text-muted"></i> Detail Laporan
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
                                <div class="py-4">
                                    <i class="fas fa-folder-open fa-3x text-secondary opacity-50 mb-3 d-block"></i>
                                    <h6 class="fw-bold text-dark">Belum Ada Berkas Terenkripsi</h6>
                                    <small class="text-muted">Semua berkas yang diunggah pelapor akan terenkripsi otomatis dan tercatat di sini.</small>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

            </div>
        </div>
    </div>

    <!-- Modal Dekripsi Dokumen Terpadu (Tanpa Buka Tab Baru) -->
    <div class="modal fade" id="modalDekripsiBerkas" tabindex="-1" aria-labelledby="modalDekripsiLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow-lg overflow-hidden">
                <!-- Modal Header -->
                <div class="modal-header border-0 p-4 text-white position-relative" style="background: linear-gradient(135deg, #4338ca 0%, #6366f1 100%);">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background: rgba(255,255,255,0.2); backdrop-filter: blur(6px);">
                            <i class="fas fa-lock-open text-white fs-5"></i>
                        </div>
                        <div>
                            <h5 class="modal-title fw-bold text-white mb-0" id="modalDekripsiLabel">Dekripsi Dokumen</h5>
                            <small class="text-white-50" id="modalDokumenSubtitle">Standar Keamanan AES-256</small>
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Form Dekripsi -->
                <form action="{{ route('decrypt.process') }}" method="POST">
                    @csrf
                    <input type="hidden" name="file_path" id="modal_file_path" value="">
                    <input type="hidden" name="model_type" id="modal_model_type" value="">
                    <input type="hidden" name="model_id" id="modal_model_id" value="">

                    <div class="modal-body p-4">
                        <!-- Card Ringkasan Info & Metrik Enkripsi -->
                        <div class="p-3 rounded-3 mb-3" style="background: #f8fafc; border: 1px solid #e2e8f0;">
                            <div class="d-flex justify-content-between mb-1">
                                <small class="text-muted fw-semibold">Kode Laporan:</small>
                                <span class="fw-bold text-primary" id="modalKodeLaporan">-</span>
                            </div>
                            <div class="d-flex justify-content-between mb-1">
                                <small class="text-muted fw-semibold">Jenis Berkas:</small>
                                <span class="fw-bold text-dark" id="modalNamaDokumen">-</span>
                            </div>
                            <div class="d-flex justify-content-between mb-1">
                                <small class="text-muted fw-semibold">Ukuran File:</small>
                                <span class="fw-bold text-dark" id="modalUkuranBerkas">-</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <small class="text-muted fw-semibold">Waktu Enkripsi:</small>
                                <span class="fw-bold text-success" id="modalWaktuEnkripsi">-</span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-dark fw-bold small text-uppercase mb-2">Password Enkripsi Berkas <span class="text-danger">*</span></label>
                            <div class="position-relative">
                                <input type="password" 
                                       class="form-control form-control-lg rounded-3 fs-6" 
                                       name="password_file" 
                                       id="modalPasswordInput" 
                                       placeholder="Ketik password enkripsi..." 
                                       required
                                       style="padding-right: 44px; border: 1px solid #cbd5e1;">
                                <button type="button" 
                                        class="btn position-absolute top-50 end-0 translate-middle-y border-0 text-secondary pe-3" 
                                        onclick="togglePasswordModal()" 
                                        tabindex="-1">
                                    <i class="fas fa-eye" id="toggleModalEye"></i>
                                </button>
                            </div>
                            <small class="text-muted mt-2 d-block" style="font-size: 12px; line-height: 1.4;">
                                <i class="fas fa-info-circle text-primary me-1"></i> Masukkan password enkripsi dokumen yang dibuat saat pelaporan untuk mengunduh dan membaca berkas asli.
                            </small>
                        </div>
                    </div>

                    <div class="modal-footer border-0 p-4 pt-0">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" id="btnSubmitDekripsi" class="btn btn-primary rounded-pill px-4 shadow-sm" style="background: #4f46e5; border-color: #4f46e5;">
                            <i class="fas fa-download me-1"></i> Dekripsi & Unduh
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Notifikasi Hasil Dekripsi (Durasi & Ukuran) -->
    <div class="modal fade" id="modalHasilDekripsi" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content border-0 rounded-4 shadow-lg text-center p-4">
                <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px; background: #ecfdf5; color: #059669;">
                    <i class="fas fa-check-circle fa-2x"></i>
                </div>
                <h5 class="fw-bold text-dark mb-1">Dekripsi Berhasil!</h5>
                <p class="text-muted small mb-3">Berkas terdekripsi berhasil diproses dan sedang diunduh.</p>
                <div class="p-3 rounded-3 mb-3 text-start" style="background: #f8fafc; border: 1px solid #e2e8f0; font-size: 12.5px;">
                    <div class="d-flex justify-content-between mb-1">
                        <span class="text-muted">Waktu Dekripsi:</span>
                        <strong class="text-success" id="hasilDekripsiWaktu">-</strong>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Ukuran Berkas:</span>
                        <strong class="text-dark" id="hasilDekripsiUkuran">-</strong>
                    </div>
                </div>
                <button type="button" class="btn btn-primary rounded-pill w-100" data-bs-dismiss="modal" style="background: #4f46e5; border-color: #4f46e5;">
                    Tutup
                </button>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <!-- Required datatable js -->
    <script src="{{ asset('admin/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

    <script>
        function bukaModalDekripsi(filePath, modelType, modelId, namaDokumen, kodeLaporan, ukuranBerkas, waktuEnkripsi) {
            document.getElementById('modal_file_path').value = filePath;
            document.getElementById('modal_model_type').value = modelType;
            document.getElementById('modal_model_id').value = modelId;
            document.getElementById('modalNamaDokumen').textContent = namaDokumen;
            document.getElementById('modalDokumenSubtitle').textContent = namaDokumen + ' (AES-256)';
            document.getElementById('modalKodeLaporan').textContent = kodeLaporan;
            document.getElementById('modalUkuranBerkas').textContent = ukuranBerkas || '-';
            document.getElementById('modalWaktuEnkripsi').textContent = waktuEnkripsi || '-';
            
            // Reset input password
            const passInput = document.getElementById('modalPasswordInput');
            passInput.value = '';
            passInput.type = 'password';
            document.getElementById('toggleModalEye').className = 'fas fa-eye';

            var modal = new bootstrap.Modal(document.getElementById('modalDekripsiBerkas'));
            modal.show();
        }

        function togglePasswordModal() {
            const passInput = document.getElementById('modalPasswordInput');
            const eyeIcon = document.getElementById('toggleModalEye');
            if (passInput.type === 'password') {
                passInput.type = 'text';
                eyeIcon.className = 'fas fa-eye-slash';
            } else {
                passInput.type = 'password';
                eyeIcon.className = 'fas fa-eye';
            }
        }

        // Helper membaca cookie
        function getCookie(name) {
            let matches = document.cookie.match(new RegExp(
                "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
            ));
            return matches ? decodeURIComponent(matches[1]) : undefined;
        }

        function eraseCookie(name) {
            document.cookie = name + '=; Max-Age=-99999999; path=/;';
        }

        // Pantau cookie setelah submit form dekripsi
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.querySelector("#modalDekripsiBerkas form");
            if (form) {
                form.addEventListener("submit", function() {
                    const submitBtn = document.getElementById('btnSubmitDekripsi');
                    const originalHtml = submitBtn.innerHTML;
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Mendekripsi...';
                    submitBtn.disabled = true;

                    // Polling cookie untuk mendeteksi download selesai dan menampilkan metrik durasi & ukuran
                    let checkInterval = setInterval(function() {
                        const status = getCookie('crs_decrypt_status');
                        if (status === 'success') {
                            clearInterval(checkInterval);
                            submitBtn.innerHTML = originalHtml;
                            submitBtn.disabled = false;

                            const decryptTime = getCookie('crs_decrypt_time') || '-';
                            const decryptSize = getCookie('crs_decrypt_size') || '-';

                            // Hapus cookies
                            eraseCookie('crs_decrypt_status');
                            eraseCookie('crs_decrypt_time');
                            eraseCookie('crs_decrypt_size');

                            // Tutup modal form
                            const modalForm = bootstrap.Modal.getInstance(document.getElementById('modalDekripsiBerkas'));
                            if (modalForm) modalForm.hide();

                            // Tampilkan modal hasil
                            document.getElementById('hasilDekripsiWaktu').textContent = decryptTime + ' detik';
                            document.getElementById('hasilDekripsiUkuran').textContent = decryptSize + ' MB';
                            var modalHasil = new bootstrap.Modal(document.getElementById('modalHasilDekripsi'));
                            modalHasil.show();
                        }
                    }, 500);

                    // Timeout safety 15 detik
                    setTimeout(function() {
                        clearInterval(checkInterval);
                        submitBtn.innerHTML = originalHtml;
                        submitBtn.disabled = false;
                    }, 15000);
                });
            }
        });

        $(document).ready(function() {
            if ($('#datatabel tbody tr').length > 1 || !$('#datatabel tbody td').hasClass('text-center')) {
                $('#datatabel').DataTable({
                    language: {
                        search: "<i class='fas fa-search me-1 text-muted'></i> Cari Berkas:",
                        searchPlaceholder: "Ketik kode / nama pelapor...",
                        lengthMenu: "Tampilkan _MENU_ data",
                        info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                        paginate: {
                            first: "Awal",
                            last: "Akhir",
                            next: "Selanjutnya",
                            previous: "Sebelumnya"
                        }
                    }
                });
            }
        });
    </script>
@endpush
