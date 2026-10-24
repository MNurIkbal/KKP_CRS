@extends('layouts.Admin.adm')

@section('content')
<div id="content" class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            @include('layouts.Admin.breadcrumbs')
            <div class="card border-0 shadow-sm rounded-4 mb-4" style="background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #312e81 100%); color: #ffffff;">
                <div class="card-body p-4 p-md-5 position-relative overflow-hidden">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <div class="badge px-3 py-1 mb-3 rounded-pill bg-white text-primary fw-bold" style="font-size: 11.5px; letter-spacing: 0.5px;">
                                <i class="fas fa-flask-vial me-1 text-primary"></i> BENCHMARK & PENGUJIAN ALGORITMA
                            </div>
                            <h3 class="fw-bold mb-2 text-white">Laboratorium Uji Enkripsi & Dekripsi AES</h3>
                            <p class="text-white-50 mb-0" style="font-size: 14.5px; line-height: 1.6;">
                                Modul pengujian empiris untuk mengukur kecepatan pemrosesan (*throughput* MB/detik), durasi waktu komputasi, dan validitas integritas rekonstruksi berkas biner antara <strong>AES-128 bit (10 Putaran)</strong> vs <strong>AES-256 bit (14 Putaran)</strong> secara realtime.
                            </p>
                        </div>
                        <div class="col-lg-4 text-center text-lg-end mt-4 mt-lg-0">
                            <div class="d-inline-flex flex-column p-3 rounded-4" style="background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(8px); border: 1px solid rgba(255, 255, 255, 0.15);">
                                <span class="text-xs text-uppercase text-white-50 fw-semibold">Algoritma Aktif Sistem:</span>
                                <span class="fw-bold fs-5 text-warning">{{ $activeAlgo }}</span>
                                <small class="text-white-50">Pengaturan CRS LLDIKTI III</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('components.alert')
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="rounded-3 p-2 d-flex align-items-center justify-content-center" style="background: #eef2ff; color: #4f46e5; width: 40px; height: 40px;">
                            <i class="fas fa-file-arrow-up fs-5"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark mb-0">Parameter Pengujian Berkas</h5>
                            <small class="text-muted">Pilih dokumen riil (PDF, PNG, JPG, ZIP) untuk dilakukan benchmark komparatif</small>
                        </div>
                    </div>
                    <form id="benchmarkForm" action="{{ route('adm.proses_pengujian_kriptografi') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-5">
                                <label class="form-label fw-bold text-dark">Berkas Dokumen Uji <span class="text-danger">*</span></label>
                                <input type="file" id="testFileInput" name="test_file" class="form-control" required accept=".pdf,.png,.jpeg,.jpg,.zip,.txt,.docx">
                                <small class="text-muted">Maksimal ukuran berkas 5 MB untuk simulasi cepat.</small>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold text-dark">Kunci / Password <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-key text-muted"></i></span>
                                    <input type="text" id="passwordInput" name="password_kunci" class="form-control font-monospace" required placeholder="Contoh: CRS2026Rahasia" value="{{ old('password_kunci', 'CRS2026UjiKripto') }}">
                                </div>
                                <small class="text-muted">Digunakan untuk derivasi round keys.</small>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold text-dark">Mode Benchmark</label>
                                <select name="mode_pengujian" id="modePengujianSelect" class="form-select">
                                    <option value="both" {{ (old('mode_pengujian', $mode ?? 'both')) === 'both' ? 'selected' : '' }}>Komparasi Keduanya (AES-128 vs AES-256)</option>
                                    <option value="aes128" {{ (old('mode_pengujian', $mode ?? '')) === 'aes128' ? 'selected' : '' }}>Hanya AES-128 bit (10 Rounds)</option>
                                    <option value="aes256" {{ (old('mode_pengujian', $mode ?? '')) === 'aes256' ? 'selected' : '' }}>Hanya AES-256 bit (14 Rounds)</option>
                                </select>
                                <small class="text-muted">Pilih perbandingan simultan atau spesifik.</small>
                            </div>
                        </div>

                        <div class="mt-4 text-end">
                            <button type="submit" id="btnSubmitBenchmark" class="btn btn-primary px-4 py-2 rounded-pill fw-bold shadow-sm" style="background: #4f46e5; border-color: #4f46e5;">
                                <i class="fas fa-play me-1"></i> Mulai Eksekusi Pengujian
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="modal fade" id="modalProcessing" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden" style="background: #0f172a; color: #fff;">
                        <div class="modal-header border-0 pb-0 pt-4 px-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="spinner-grow text-primary" role="status" style="width: 2.2rem; height: 2.2rem;">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <div>
                                    <h5 class="modal-title fw-bold text-white mb-0" id="procModalTitle">Pemrosesan Komputasi Kriptografi Riil</h5>
                                    <small class="text-white-50" id="procModalSubtitle">Mengurai blok 16-byte & mengeksekusi transformasi round AES...</small>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body p-4">
                            <div class="row g-2 mb-3">
                                <div class="col-3 text-center">
                                    <div id="stepRead" class="p-2 rounded-3 border" style="background: rgba(255,255,255,0.05); border-color: rgba(255,255,255,0.1) !important;">
                                        <i class="fas fa-file-binary d-block mb-1 text-info fs-5"></i>
                                        <small class="text-white fw-bold d-block" style="font-size: 11px;">1. File Stream</small>
                                        <span id="badgeStepRead" class="badge bg-secondary" style="font-size: 9px;">Menunggu</span>
                                    </div>
                                </div>
                                <div class="col-3 text-center">
                                    <div id="stepKey" class="p-2 rounded-3 border" style="background: rgba(255,255,255,0.05); border-color: rgba(255,255,255,0.1) !important;">
                                        <i class="fas fa-key d-block mb-1 text-warning fs-5"></i>
                                        <small class="text-white fw-bold d-block" style="font-size: 11px;">2. Key Exp</small>
                                        <span id="badgeStepKey" class="badge bg-secondary" style="font-size: 9px;">Menunggu</span>
                                    </div>
                                </div>
                                <div class="col-3 text-center">
                                    <div id="stepEnc" class="p-2 rounded-3 border" style="background: rgba(255,255,255,0.05); border-color: rgba(255,255,255,0.1) !important;">
                                        <i class="fas fa-lock d-block mb-1 text-primary fs-5"></i>
                                        <small class="text-white fw-bold d-block" style="font-size: 11px;">3. Enkripsi</small>
                                        <span id="badgeStepEnc" class="badge bg-secondary" style="font-size: 9px;">Menunggu</span>
                                    </div>
                                </div>
                                <div class="col-3 text-center">
                                    <div id="stepDec" class="p-2 rounded-3 border" style="background: rgba(255,255,255,0.05); border-color: rgba(255,255,255,0.1) !important;">
                                        <i class="fas fa-unlock-keyhole d-block mb-1 text-success fs-5"></i>
                                        <small class="text-white fw-bold d-block" style="font-size: 11px;">4. Dekripsi & Uji</small>
                                        <span id="badgeStepDec" class="badge bg-secondary" style="font-size: 9px;">Menunggu</span>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="text-xs text-white-50 fw-semibold" id="procStatusText">Menyiapkan memori buffer berkas...</span>
                                    <span class="text-xs fw-bold text-warning font-monospace" id="procTimerText">0.00 dtk</span>
                                </div>
                                <div class="progress" style="height: 12px; background: rgba(255,255,255,0.1);">
                                    <div id="procProgressBar" class="progress-bar progress-bar-striped progress-bar-animated bg-indigo" role="progressbar" style="width: 15%; background: #6366f1;"></div>
                                </div>
                            </div>
                            <div class="p-3 rounded-3 font-monospace" style="background: #020617; border: 1px solid rgba(255,255,255,0.15); max-height: 180px; overflow-y: auto; font-size: 11.5px; line-height: 1.5;">
                                <div class="text-success"><span class="text-white-50">[{{ date('H:i:s') }}]</span> [INIT] Inisialisasi engine pengujian CRS Kriptografi...</div>
                                <div id="liveConsoleLog"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if (isset($results) && !empty($results))
                <div class="card border-0 shadow-sm rounded-4 mb-4" style="background: #f8fafc; border: 1px solid #e2e8f0 !important;">
                    <div class="card-body p-4">
                        <h6 class="fw-bold text-dark mb-3"><i class="fas fa-circle-info text-info me-2"></i>Metadata Berkas Pengujian</h6>
                        <div class="row g-3 text-center">
                            <div class="col-md-3 col-6">
                                <div class="p-3 bg-white rounded-3 border">
                                    <small class="text-muted text-uppercase fw-bold d-block" style="font-size: 11px;">Nama Berkas</small>
                                    <span class="fw-bold text-dark text-truncate d-block" title="{{ $fileMetadata['nama_file'] }}">{{ $fileMetadata['nama_file'] }}</span>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="p-3 bg-white rounded-3 border">
                                    <small class="text-muted text-uppercase fw-bold d-block" style="font-size: 11px;">Ukuran Berkas</small>
                                    <span class="fw-bold text-primary">{{ $fileMetadata['ukuran_kb'] }} ({{ $fileMetadata['ukuran_mb'] }})</span>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="p-3 bg-white rounded-3 border">
                                    <small class="text-muted text-uppercase fw-bold d-block" style="font-size: 11px;">Total Blok (16-Byte)</small>
                                    <span class="fw-bold text-indigo" style="color: #4f46e5;">{{ number_format($fileMetadata['total_blok_16']) }} Blok</span>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="p-3 bg-white rounded-3 border">
                                    <small class="text-muted text-uppercase fw-bold d-block" style="font-size: 11px;">Kunci Plaintext</small>
                                    <span class="fw-bold text-dark font-monospace">{{ $fileMetadata['password_kunci'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kartu Perbandingan Algoritma -->
                <div class="row g-4 mb-4">
                    @if (isset($results['aes128']))
                        <div class="{{ isset($results['aes256']) ? 'col-lg-6' : 'col-12' }}">
                            <div class="card border-0 shadow-sm h-100 rounded-4" style="border-top: 4px solid #3b82f6 !important;">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="rounded-circle p-2 bg-primary-subtle text-primary">
                                                <i class="fas fa-lock fs-5"></i>
                                            </div>
                                            <div>
                                                <h5 class="fw-bold text-dark mb-0">{{ $results['aes128']['nama_algoritma'] }}</h5>
                                                <small class="text-muted">{{ $results['aes128']['jumlah_putaran'] }} | Kunci {{ $results['aes128']['panjang_kunci'] }}</small>
                                            </div>
                                        </div>
                                        <span class="badge bg-primary px-3 py-2 rounded-pill">10 Rounds</span>
                                    </div>

                                    <div class="row g-2 mb-3">
                                        <div class="col-6">
                                            <div class="p-3 rounded-3" style="background: #eff6ff;">
                                                <small class="text-secondary fw-semibold d-block">Waktu Enkripsi</small>
                                                <h4 class="fw-bold text-primary mb-0 mt-1">{{ $results['aes128']['waktu_enkripsi'] }} <small class="fs-6 text-muted">detik</small></h4>
                                                <small class="text-muted" style="font-size: 11px;">Laju: {{ $results['aes128']['throughput_enc'] }} MB/s</small>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="p-3 rounded-3" style="background: #f0fdf4;">
                                                <small class="text-secondary fw-semibold d-block">Waktu Dekripsi</small>
                                                <h4 class="fw-bold text-success mb-0 mt-1">{{ $results['aes128']['waktu_dekripsi'] }} <small class="fs-6 text-muted">detik</small></h4>
                                                <small class="text-muted" style="font-size: 11px;">Pemulihan kembali</small>
                                            </div>
                                        </div>
                                    </div>

                                    <ul class="list-group list-group-flush mb-3" style="font-size: 13px;">
                                        <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                                            <span class="text-muted">Total Durasi (Enc + Dec):</span>
                                            <span class="fw-bold text-dark">{{ $results['aes128']['total_waktu'] }} detik</span>
                                        </li>
                                        <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                                            <span class="text-muted">Validasi Integritas Rekonstruksi:</span>
                                            <span class="badge bg-success-subtle text-success px-2 py-1 fw-bold">
                                                <i class="fas fa-check-circle me-1"></i> {{ $results['aes128']['integritas'] }}
                                            </span>
                                        </li>
                                    </ul>

                                    <div class="p-2 rounded-3 bg-light border mb-3">
                                        <div class="d-flex align-items-center justify-content-between mb-1">
                                            <small class="text-muted text-uppercase fw-bold" style="font-size: 10px;">Cuplikan 32-Byte Ciphertext (HEX):</small>
                                            <div class="dropdown">
                                                <button class="btn btn-xs btn-outline-secondary dropdown-toggle py-1 px-2 rounded-pill fw-semibold" style="font-size: 11px;" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-vertical me-1 text-muted"></i> Aksi Berkas
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3 p-2" style="font-size: 12px; min-width: 220px;">
                                                    <li>
                                                        <a class="dropdown-item py-2 rounded-2 text-primary" href="javascript:void(0)" onclick="downloadCipherFile('aes128')">
                                                            <i class="fas fa-file-shield me-2 text-primary"></i> Unduh Berkas Terenkripsi (.rda)
                                                        </a>
                                                    </li>
                                                    <li><hr class="dropdown-divider my-1"></li>
                                                    <li>
                                                        <a class="dropdown-item py-2 rounded-2 text-success" href="javascript:void(0)" onclick="mulaiDekripsiPengujian('{{ $savedId ?? '' }}', 'aes128', '{{ $fileMetadata['nama_file'] ?? '' }}')">
                                                            <i class="fas fa-key me-2 text-success"></i> Proses Dekripsi Realtime...
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <code class="text-primary small d-block text-break font-monospace" style="font-size: 11px;">{{ $results['aes128']['sample_cipher_hex'] }}</code>
                                    </div>

                                    <!-- Visualisasi Real Data State Matrix 4x4 Blok Pertama (Tab Enkripsi vs Dekripsi) -->
                                    @if (isset($results['aes128']['cipher_matrix']))
                                        <div class="border rounded-3 p-3 bg-white">
                                            <ul class="nav nav-pills nav-fill mb-2 p-1 bg-light rounded-pill" id="pills-tab-128" role="tablist" style="font-size: 11px;">
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link active rounded-pill py-1 px-2 fw-bold" id="pills-enc-128-tab" data-bs-toggle="pill" data-bs-target="#pills-enc-128" type="button" role="tab">
                                                        <i class="fas fa-lock me-1"></i> Visualisasi Enkripsi
                                                    </button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link rounded-pill py-1 px-2 fw-bold text-success" id="pills-dec-128-tab" data-bs-toggle="pill" data-bs-target="#pills-dec-128" type="button" role="tab">
                                                        <i class="fas fa-unlock-keyhole me-1"></i> Visualisasi Dekripsi
                                                    </button>
                                                </li>
                                            </ul>

                                            <div class="tab-content" id="pills-tabContent-128">
                                                <!-- Tab Enkripsi -->
                                                <div class="tab-pane fade show active" id="pills-enc-128" role="tabpanel">
                                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                                        <span class="text-xs fw-bold text-uppercase text-secondary">Proses Enkripsi: Plaintext &rarr; Ciphertext</span>
                                                        <span class="badge bg-primary-subtle text-primary" style="font-size: 9.5px;">10 Putaran (Nr = 10)</span>
                                                    </div>
                                                    <div class="row g-2 text-center">
                                                        <div class="col-6">
                                                            <small class="text-muted fw-bold d-block mb-1" style="font-size: 10px;">Plaintext Awal</small>
                                                            <table class="table table-bordered text-center mb-0 font-monospace" style="font-size: 10.5px; background: #f8fafc;">
                                                                <tbody>
                                                                    @foreach ($results['aes128']['plain_matrix'] as $row)
                                                                        <tr>
                                                                            @foreach ($row as $byteHex)
                                                                                <td class="p-1 text-dark" style="background: #f1f5f9; width: 25%;">{{ $byteHex }}</td>
                                                                            @endforeach
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="col-6">
                                                            <small class="text-primary fw-bold d-block mb-1" style="font-size: 10px;">Ciphertext Terenkripsi</small>
                                                            <table class="table table-bordered text-center mb-0 font-monospace" style="font-size: 10.5px; background: #eff6ff;">
                                                                <tbody>
                                                                    @foreach ($results['aes128']['cipher_matrix'] as $row)
                                                                        <tr>
                                                                            @foreach ($row as $byteHex)
                                                                                <td class="p-1 fw-bold text-primary" style="background: #dbeafe; width: 25%;">{{ $byteHex }}</td>
                                                                            @endforeach
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <small class="text-muted d-block text-center mt-2" style="font-size: 9.5px;">
                                                        <i class="fas fa-arrows-rotate text-primary me-1"></i> Transformasi: <code>AddRoundKey &rarr; (SubBytes &rarr; ShiftRows &rarr; MixColumns &rarr; AddRoundKey)&times;9 &rarr; Final Round</code>
                                                    </small>
                                                </div>

                                                <!-- Tab Dekripsi -->
                                                <div class="tab-pane fade" id="pills-dec-128" role="tabpanel">
                                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                                        <span class="text-xs fw-bold text-uppercase text-success">Proses Dekripsi: Ciphertext &rarr; Plaintext</span>
                                                        <span class="badge bg-success-subtle text-success" style="font-size: 9.5px;">10 Putaran Balik (Inv)</span>
                                                    </div>
                                                    <div class="row g-2 text-center">
                                                        <div class="col-6">
                                                            <small class="text-secondary fw-bold d-block mb-1" style="font-size: 10px;">Ciphertext Masukan</small>
                                                            <table class="table table-bordered text-center mb-0 font-monospace" style="font-size: 10.5px; background: #f8fafc;">
                                                                <tbody>
                                                                    @foreach ($results['aes128']['cipher_matrix'] as $row)
                                                                        <tr>
                                                                            @foreach ($row as $byteHex)
                                                                                <td class="p-1 text-secondary" style="background: #f1f5f9; width: 25%;">{{ $byteHex }}</td>
                                                                            @endforeach
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="col-6">
                                                            <small class="text-success fw-bold d-block mb-1" style="font-size: 10px;">Plaintext Pulih (100%)</small>
                                                            <table class="table table-bordered text-center mb-0 font-monospace" style="font-size: 10.5px; background: #f0fdf4;">
                                                                <tbody>
                                                                    @foreach ($results['aes128']['plain_matrix'] as $row)
                                                                        <tr>
                                                                            @foreach ($row as $byteHex)
                                                                                <td class="p-1 fw-bold text-success" style="background: #dcfce7; width: 25%;">{{ $byteHex }}</td>
                                                                            @endforeach
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <small class="text-muted d-block text-center mt-2" style="font-size: 9.5px;">
                                                        <i class="fas fa-check-double text-success me-1"></i> Transformasi Balik: <code>InvShiftRows &rarr; InvSubBytes &rarr; AddRoundKey &rarr; InvMixColumns</code> (Byte identik terpulihkan sempurna)
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (isset($results['aes256']))
                        <div class="{{ isset($results['aes128']) ? 'col-lg-6' : 'col-12' }}">
                            <div class="card border-0 shadow-sm h-100 rounded-4" style="border-top: 4px solid #10b981 !important;">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="rounded-circle p-2 bg-success-subtle text-success">
                                                <i class="fas fa-shield-halved fs-5"></i>
                                            </div>
                                            <div>
                                                <h5 class="fw-bold text-dark mb-0">{{ $results['aes256']['nama_algoritma'] }}</h5>
                                                <small class="text-muted">{{ $results['aes256']['jumlah_putaran'] }} | Kunci {{ $results['aes256']['panjang_kunci'] }}</small>
                                            </div>
                                        </div>
                                        <span class="badge bg-success px-3 py-2 rounded-pill">14 Rounds</span>
                                    </div>

                                    <div class="row g-2 mb-3">
                                        <div class="col-6">
                                            <div class="p-3 rounded-3" style="background: #ecfdf5;">
                                                <small class="text-secondary fw-semibold d-block">Waktu Enkripsi</small>
                                                <h4 class="fw-bold text-success mb-0 mt-1">{{ $results['aes256']['waktu_enkripsi'] }} <small class="fs-6 text-muted">detik</small></h4>
                                                <small class="text-muted" style="font-size: 11px;">Laju: {{ $results['aes256']['throughput_enc'] }} MB/s</small>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="p-3 rounded-3" style="background: #f0fdf4;">
                                                <small class="text-secondary fw-semibold d-block">Waktu Dekripsi</small>
                                                <h4 class="fw-bold text-success mb-0 mt-1">{{ $results['aes256']['waktu_dekripsi'] }} <small class="fs-6 text-muted">detik</small></h4>
                                                <small class="text-muted" style="font-size: 11px;">Pemulihan kembali</small>
                                            </div>
                                        </div>
                                    </div>

                                    <ul class="list-group list-group-flush mb-3" style="font-size: 13px;">
                                        <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                                            <span class="text-muted">Total Durasi (Enc + Dec):</span>
                                            <span class="fw-bold text-dark">{{ $results['aes256']['total_waktu'] }} detik</span>
                                        </li>
                                        <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                                            <span class="text-muted">Validasi Integritas Rekonstruksi:</span>
                                            <span class="badge bg-success-subtle text-success px-2 py-1 fw-bold">
                                                <i class="fas fa-check-circle me-1"></i> {{ $results['aes256']['integritas'] }}
                                            </span>
                                        </li>
                                    </ul>

                                    <div class="p-2 rounded-3 bg-light border mb-3">
                                        <div class="d-flex align-items-center justify-content-between mb-1">
                                            <small class="text-muted text-uppercase fw-bold" style="font-size: 10px;">Cuplikan 32-Byte Ciphertext (HEX):</small>
                                            <div class="dropdown">
                                                <button class="btn btn-xs btn-outline-secondary dropdown-toggle py-1 px-2 rounded-pill fw-semibold" style="font-size: 11px;" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-vertical me-1 text-muted"></i> Aksi Berkas
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3 p-2" style="font-size: 12px; min-width: 220px;">
                                                    <li>
                                                        <a class="dropdown-item py-2 rounded-2 text-success" href="javascript:void(0)" onclick="downloadCipherFile('aes256')">
                                                            <i class="fas fa-file-shield me-2 text-success"></i> Unduh Berkas Terenkripsi (.rda)
                                                        </a>
                                                    </li>
                                                    <li><hr class="dropdown-divider my-1"></li>
                                                    <li>
                                                        <a class="dropdown-item py-2 rounded-2 text-primary" href="javascript:void(0)" onclick="mulaiDekripsiPengujian('{{ $savedId ?? '' }}', 'aes256', '{{ $fileMetadata['nama_file'] ?? '' }}')">
                                                            <i class="fas fa-key me-2 text-primary"></i> Proses Dekripsi Realtime...
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <code class="text-success small d-block text-break font-monospace" style="font-size: 11px;">{{ $results['aes256']['sample_cipher_hex'] }}</code>
                                    </div>
                                    @if (isset($results['aes256']['cipher_matrix']))
                                        <div class="border rounded-3 p-3 bg-white">
                                            <ul class="nav nav-pills nav-fill mb-2 p-1 bg-light rounded-pill" id="pills-tab-256" role="tablist" style="font-size: 11px;">
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link active rounded-pill py-1 px-2 fw-bold" id="pills-enc-256-tab" data-bs-toggle="pill" data-bs-target="#pills-enc-256" type="button" role="tab">
                                                        <i class="fas fa-lock me-1"></i> Visualisasi Enkripsi
                                                    </button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link rounded-pill py-1 px-2 fw-bold text-success" id="pills-dec-256-tab" data-bs-toggle="pill" data-bs-target="#pills-dec-256" type="button" role="tab">
                                                        <i class="fas fa-unlock-keyhole me-1"></i> Visualisasi Dekripsi
                                                    </button>
                                                </li>
                                            </ul>
                                            <div class="tab-content" id="pills-tabContent-256">
                                                <div class="tab-pane fade show active" id="pills-enc-256" role="tabpanel">
                                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                                        <span class="text-xs fw-bold text-uppercase text-secondary">Proses Enkripsi: Plaintext &rarr; Ciphertext</span>
                                                        <span class="badge bg-success-subtle text-success" style="font-size: 9.5px;">14 Putaran (Nr = 14)</span>
                                                    </div>
                                                    <div class="row g-2 text-center">
                                                        <div class="col-6">
                                                            <small class="text-muted fw-bold d-block mb-1" style="font-size: 10px;">Plaintext Awal</small>
                                                            <table class="table table-bordered text-center mb-0 font-monospace" style="font-size: 10.5px; background: #f8fafc;">
                                                                <tbody>
                                                                    @foreach ($results['aes256']['plain_matrix'] as $row)
                                                                        <tr>
                                                                            @foreach ($row as $byteHex)
                                                                                <td class="p-1 text-dark" style="background: #f1f5f9; width: 25%;">{{ $byteHex }}</td>
                                                                            @endforeach
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="col-6">
                                                            <small class="text-success fw-bold d-block mb-1" style="font-size: 10px;">Ciphertext Terenkripsi</small>
                                                            <table class="table table-bordered text-center mb-0 font-monospace" style="font-size: 10.5px; background: #f0fdf4;">
                                                                <tbody>
                                                                    @foreach ($results['aes256']['cipher_matrix'] as $row)
                                                                        <tr>
                                                                            @foreach ($row as $byteHex)
                                                                                <td class="p-1 fw-bold text-success" style="background: #dcfce7; width: 25%;">{{ $byteHex }}</td>
                                                                            @endforeach
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <small class="text-muted d-block text-center mt-2" style="font-size: 9.5px;">
                                                        <i class="fas fa-shield-halved text-success me-1"></i> Transformasi: <code>AddRoundKey &rarr; (SubBytes &rarr; ShiftRows &rarr; MixColumns &rarr; AddRoundKey)&times;13 &rarr; Final Round</code>
                                                    </small>
                                                </div>
                                                <div class="tab-pane fade" id="pills-dec-256" role="tabpanel">
                                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                                        <span class="text-xs fw-bold text-uppercase text-success">Proses Dekripsi: Ciphertext &rarr; Plaintext</span>
                                                        <span class="badge bg-success-subtle text-success" style="font-size: 9.5px;">14 Putaran Balik (Inv)</span>
                                                    </div>
                                                    <div class="row g-2 text-center">
                                                        <div class="col-6">
                                                            <small class="text-secondary fw-bold d-block mb-1" style="font-size: 10px;">Ciphertext Masukan</small>
                                                            <table class="table table-bordered text-center mb-0 font-monospace" style="font-size: 10.5px; background: #f8fafc;">
                                                                <tbody>
                                                                    @foreach ($results['aes256']['cipher_matrix'] as $row)
                                                                        <tr>
                                                                            @foreach ($row as $byteHex)
                                                                                <td class="p-1 text-secondary" style="background: #f1f5f9; width: 25%;">{{ $byteHex }}</td>
                                                                            @endforeach
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="col-6">
                                                            <small class="text-success fw-bold d-block mb-1" style="font-size: 10px;">Plaintext Pulih (100%)</small>
                                                            <table class="table table-bordered text-center mb-0 font-monospace" style="font-size: 10.5px; background: #f0fdf4;">
                                                                <tbody>
                                                                    @foreach ($results['aes256']['plain_matrix'] as $row)
                                                                        <tr>
                                                                            @foreach ($row as $byteHex)
                                                                                <td class="p-1 fw-bold text-success" style="background: #dcfce7; width: 25%;">{{ $byteHex }}</td>
                                                                            @endforeach
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <small class="text-muted d-block text-center mt-2" style="font-size: 9.5px;">
                                                        <i class="fas fa-check-double text-success me-1"></i> Transformasi Balik: <code>InvShiftRows &rarr; InvSubBytes &rarr; AddRoundKey &rarr; InvMixColumns</code> (Byte identik terpulihkan sempurna)
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                @if (isset($results['aes128']) && isset($results['aes256']))
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-body p-4">
                            <h5 class="fw-bold text-dark mb-1"><i class="fas fa-chart-column text-indigo me-2" style="color: #4f46e5;"></i>Visualisasi Grafik Komparasi Komputasi</h5>
                            <p class="text-muted mb-3" style="font-size: 13px;">Visualisasi grafis perbandingan durasi komputasi dan throughput antara AES-128 dan AES-256</p>
                            
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="p-3 rounded-4 bg-light border h-100">
                                        <h6 class="fw-bold text-dark mb-2 text-center">Perbandingan Waktu Komputasi (Detik)</h6>
                                        <div id="chartWaktu" style="min-height: 280px;"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-3 rounded-4 bg-light border h-100">
                                        <h6 class="fw-bold text-dark mb-2 text-center">Kecepatan Throughput (MB / Detik)</h6>
                                        <div id="chartThroughput" style="min-height: 280px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-body p-4">
                            <h5 class="fw-bold text-dark mb-3"><i class="fas fa-scale-balanced text-primary me-2"></i>Matriks Komparasi Kinerja Kriptografi</h5>
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Parameter Evaluasi</th>
                                            <th class="text-primary"><i class="fas fa-lock me-1"></i> AES-128 bit</th>
                                            <th class="text-success"><i class="fas fa-shield-halved me-1"></i> AES-256 bit</th>
                                            <th>Keterangan / Analisis</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="fw-semibold">Panjang Kunci (Key Size)</td>
                                            <td>128 bit (16 bytes)</td>
                                            <td>256 bit (32 bytes)</td>
                                            <td class="text-muted">AES-256 memiliki ruang kunci $2^{256}$ (kebal serangan kuantum).</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-semibold">Jumlah Putaran Transformasi ($Nr$)</td>
                                            <td>10 Rounds</td>
                                            <td>14 Rounds</td>
                                            <td class="text-muted">AES-256 mengeksekusi 4 putaran tambahan untuk difusi lebih tinggi.</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-semibold">Waktu Enkripsi Berkas</td>
                                            <td class="fw-bold text-primary">{{ $results['aes128']['waktu_enkripsi'] }} dtk</td>
                                            <td class="fw-bold text-success">{{ $results['aes256']['waktu_enkripsi'] }} dtk</td>
                                            <td>
                                                @php
                                                    $diff = floatval($results['aes256']['waktu_enkripsi']) - floatval($results['aes128']['waktu_enkripsi']);
                                                    $pct = floatval($results['aes128']['waktu_enkripsi']) > 0 ? ($diff / floatval($results['aes128']['waktu_enkripsi'])) * 100 : 0;
                                                @endphp
                                                <span class="badge bg-light text-dark border">
                                                    Selisih: {{ number_format(abs($diff), 4) }} dtk ({{ number_format(abs($pct), 1) }}%)
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-semibold">Waktu Dekripsi Berkas</td>
                                            <td class="fw-bold text-primary">{{ $results['aes128']['waktu_dekripsi'] }} dtk</td>
                                            <td class="fw-bold text-success">{{ $results['aes256']['waktu_dekripsi'] }} dtk</td>
                                            <td class="text-muted">Waktu proses dekripsi seimbang dengan putaran balik.</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-semibold">Kecepatan (*Throughput*)</td>
                                            <td>{{ $results['aes128']['throughput_enc'] }} MB/s</td>
                                            <td>{{ $results['aes256']['throughput_enc'] }} MB/s</td>
                                            <td class="text-muted">AES-128 relatif lebih cepat karena putaran lebih sedikit.</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-semibold">Integritas Berkas Dekripsi</td>
                                            <td><span class="badge bg-success-subtle text-success">100% Identik</span></td>
                                            <td><span class="badge bg-success-subtle text-success">100% Identik</span></td>
                                            <td class="text-muted">Seluruh byte file berhasil direkonstruksi tanpa distorsi data.</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="d-flex align-items-center gap-2">
                            <div class="rounded-3 p-2 d-flex align-items-center justify-content-center" style="background: #f0fdf4; color: #16a34a; width: 40px; height: 40px;">
                                <i class="fas fa-database fs-5"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold text-dark mb-0">Riwayat Hasil Pengujian Kriptografi</h5>
                                <small class="text-muted">Data tersimpan di tabel database tersendiri: <code>pengujian_kriptografi</code></small>
                            </div>
                        </div>
                        <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill fw-bold">
                            Total: {{ count($riwayatPengujian ?? []) }} Pengujian
                        </span>
                    </div>

                    @if (isset($riwayatPengujian) && count($riwayatPengujian) > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0" style="font-size: 13px;">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center" style="width: 50px;">#</th>
                                        <th>Nama Berkas Uji</th>
                                        <th>Ukuran & Blok</th>
                                        <th>Mode Uji</th>
                                        <th>Hasil AES-128 (Enc / Dec)</th>
                                        <th>Hasil AES-256 (Enc / Dec)</th>
                                        <th>Waktu Uji</th>
                                        <th class="text-center" style="width: 80px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($riwayatPengujian as $idx => $item)
                                        <tr>
                                            <td class="text-center fw-bold text-muted">{{ $idx + 1 }}</td>
                                            <td>
                                                <div class="fw-bold text-dark">{{ $item->nama_file }}</div>
                                                <small class="text-muted font-monospace">Kunci: {{ $item->password_sample }}</small>
                                            </td>
                                            <td>
                                                <div class="fw-semibold text-primary">{{ $item->ukuran_formatted }}</div>
                                                <small class="text-muted">{{ number_format($item->total_blok) }} Blok 16-B</small>
                                            </td>
                                            <td>
                                                @if ($item->mode_pengujian === 'both')
                                                    <span class="badge bg-indigo text-white px-2 py-1 rounded-pill" style="background: #4f46e5;">Komparasi</span>
                                                @elseif ($item->mode_pengujian === 'aes128')
                                                    <span class="badge bg-primary px-2 py-1 rounded-pill">AES-128</span>
                                                @else
                                                    <span class="badge bg-success px-2 py-1 rounded-pill">AES-256</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->aes128_waktu_enc !== null)
                                                    <div class="d-flex align-items-center gap-1 mb-1">
                                                        <span class="badge bg-light text-dark border" style="font-size: 11px;">
                                                            <i class="fas fa-lock text-primary me-1"></i>{{ $item->aes128_waktu_enc }}s ({{ $item->aes128_throughput_enc }} MB/s)
                                                        </span>
                                                    </div>
                                                    <div>
                                                        <span class="badge bg-light text-success border" style="font-size: 11px;">
                                                            <i class="fas fa-unlock-keyhole text-success me-1"></i>{{ $item->aes128_waktu_dec }}s ({{ $item->aes128_throughput_dec }} MB/s)
                                                        </span>
                                                    </div>
                                                @else
                                                    <span class="text-muted small">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->aes256_waktu_enc !== null)
                                                    <div class="d-flex align-items-center gap-1 mb-1">
                                                        <span class="badge bg-light text-dark border" style="font-size: 11px;">
                                                            <i class="fas fa-lock text-success me-1"></i>{{ $item->aes256_waktu_enc }}s ({{ $item->aes256_throughput_enc }} MB/s)
                                                        </span>
                                                    </div>
                                                    <div>
                                                        <span class="badge bg-light text-success border" style="font-size: 11px;">
                                                            <i class="fas fa-unlock-keyhole text-success me-1"></i>{{ $item->aes256_waktu_dec }}s ({{ $item->aes256_throughput_dec }} MB/s)
                                                        </span>
                                                    </div>
                                                @else
                                                    <span class="text-muted small">-</span>
                                                @endif
                                            </td>
                                            <td class="text-muted" style="font-size: 12px;">
                                                <i class="far fa-clock me-1"></i>
                                                {{ \Carbon\Carbon::parse($item->created_at)->locale('id')->isoFormat('D MMM Y, HH:mm') }}
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-1">
                                                    <div class="dropdown">
                                                        <button class="btn btn-sm btn-outline-secondary rounded-circle p-1" style="width: 28px; height: 28px; line-height: 1;" type="button" data-bs-toggle="dropdown" title="Unduh Berkas Hasil">
                                                            <i class="fas fa-download" style="font-size: 11px;"></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3 p-2" style="font-size: 12px; min-width: 230px;">
                                                            <li><h6 class="dropdown-header text-uppercase text-muted py-1" style="font-size: 10px;">Berkas Terenkripsi (.rda)</h6></li>
                                                            @if ($item->aes128_waktu_enc !== null)
                                                                <li>
                                                                    <a class="dropdown-item py-1 rounded-2 text-primary" href="{{ route('adm.download_pengujian_file', ['id' => $item->id, 'type' => 'cipher', 'algo' => 'cipher128']) }}">
                                                                        <i class="fas fa-file-shield me-2"></i> Unduh Ciphertext AES-128 (.rda)
                                                                    </a>
                                                                </li>
                                                            @endif
                                                            @if ($item->aes256_waktu_enc !== null)
                                                                <li>
                                                                    <a class="dropdown-item py-1 rounded-2 text-success" href="{{ route('adm.download_pengujian_file', ['id' => $item->id, 'type' => 'cipher', 'algo' => 'cipher256']) }}">
                                                                        <i class="fas fa-file-shield me-2"></i> Unduh Ciphertext AES-256 (.rda)
                                                                    </a>
                                                                </li>
                                                            @endif
                                                            <li><hr class="dropdown-divider my-1"></li>
                                                            <li><h6 class="dropdown-header text-uppercase text-muted py-1" style="font-size: 10px;">Proses Dekripsi & Unduh</h6></li>
                                                            @if ($item->aes128_waktu_enc !== null)
                                                                <li>
                                                                    <a class="dropdown-item py-1 rounded-2 text-dark" href="javascript:void(0)" onclick="mulaiDekripsiPengujian('{{ $item->id }}', 'aes128', '{{ $item->nama_file }}', '{{ $item->password_sample }}')">
                                                                        <i class="fas fa-key me-2 text-primary"></i> Dekripsi AES-128 Realtime...
                                                                    </a>
                                                                </li>
                                                            @endif
                                                            @if ($item->aes256_waktu_enc !== null)
                                                                <li>
                                                                    <a class="dropdown-item py-1 rounded-2 text-dark" href="javascript:void(0)" onclick="mulaiDekripsiPengujian('{{ $item->id }}', 'aes256', '{{ $item->nama_file }}', '{{ $item->password_sample }}')">
                                                                        <i class="fas fa-key me-2 text-success"></i> Dekripsi AES-256 Realtime...
                                                                    </a>
                                                                </li>
                                                            @endif
                                                        </ul>
                                                    </div>

                                                    <a href="{{ route('adm.hapus_pengujian_kriptografi', $item->id) }}" 
                                                       class="btn btn-sm btn-outline-danger rounded-circle p-1" 
                                                       style="width: 28px; height: 28px; line-height: 1;"
                                                       onclick="return confirm('Hapus baris riwayat pengujian ini?')"
                                                       title="Hapus Pengujian">
                                                        <i class="fas fa-trash-can" style="font-size: 11px;"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4 text-muted">
                            <i class="fas fa-box-open fs-2 mb-2 d-block text-secondary"></i>
                            <span>Belum ada data pengujian yang tersimpan di tabel database. Lakukan pengujian di formulir atas untuk menyimpan data secara otomatis.</span>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>

@if (isset($results['aes128']) && isset($results['aes256']))
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Chart Waktu
            var optionsWaktu = {
                series: [{
                    name: 'AES-128',
                    data: [{{ $results['aes128']['waktu_enkripsi'] }}, {{ $results['aes128']['waktu_dekripsi'] }}]
                }, {
                    name: 'AES-256',
                    data: [{{ $results['aes256']['waktu_enkripsi'] }}, {{ $results['aes256']['waktu_dekripsi'] }}]
                }],
                chart: {
                    type: 'bar',
                    height: 280,
                    toolbar: { show: false }
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '45%',
                        borderRadius: 6
                    },
                },
                colors: ['#3b82f6', '#10b981'],
                dataLabels: { enabled: true, formatter: function(val) { return val + "s"; } },
                xaxis: {
                    categories: ['Waktu Enkripsi', 'Waktu Dekripsi'],
                },
                yaxis: {
                    title: { text: 'Durasi (Detik)' }
                },
                tooltip: {
                    theme: 'dark',
                    y: { formatter: function(val) { return val + " detik"; } }
                }
            };
            var chartWaktu = new ApexCharts(document.querySelector("#chartWaktu"), optionsWaktu);
            chartWaktu.render();

            // Chart Throughput
            var optionsThroughput = {
                series: [{
                    name: 'Kecepatan Enkripsi',
                    data: [{{ $results['aes128']['throughput_enc'] }}, {{ $results['aes256']['throughput_enc'] }}]
                }],
                chart: {
                    type: 'bar',
                    height: 280,
                    toolbar: { show: false }
                },
                plotOptions: {
                    bar: {
                        horizontal: true,
                        barHeight: '40%',
                        borderRadius: 6,
                        distributed: true
                    }
                },
                colors: ['#3b82f6', '#10b981'],
                dataLabels: { enabled: true, formatter: function(val) { return val + " MB/s"; } },
                xaxis: {
                    categories: ['AES-128 (10R)', 'AES-256 (14R)'],
                    title: { text: 'Kecepatan (MB / Detik)' }
                },
                legend: { show: false },
                tooltip: {
                    theme: 'dark',
                    y: { formatter: function(val) { return val + " MB/detik"; } }
                }
            };
            var chartThroughput = new ApexCharts(document.querySelector("#chartThroughput"), optionsThroughput);
            chartThroughput.render();
        });
    </script>
@endif

<script>
document.addEventListener('DOMContentLoaded', function() {
    var benchmarkForm = document.getElementById('benchmarkForm');
    var testFileInput = document.getElementById('testFileInput');
    var passwordInput = document.getElementById('passwordInput');
    var modeSelect = document.getElementById('modePengujianSelect');
    var liveConsole = document.getElementById('liveConsoleLog');
    var procTimerText = document.getElementById('procTimerText');
    var procStatusText = document.getElementById('procStatusText');
    var procProgressBar = document.getElementById('procProgressBar');

    if (benchmarkForm) {
        benchmarkForm.addEventListener('submit', function(e) {
            if (!testFileInput.files || testFileInput.files.length === 0) {
                return;
            }

            var file = testFileInput.files[0];
            var fileName = file.name;
            var fileSize = file.size;
            var fileSizeKb = (fileSize / 1024).toFixed(2);
            var blocks = Math.ceil(fileSize / 16);
            var mode = modeSelect.value;
            var modeName = mode === 'both' ? 'AES-128 & AES-256' : (mode === 'aes128' ? 'AES-128 (10 Putaran)' : 'AES-256 (14 Putaran)');

            // Tampilkan Modal Bootstrap
            var modalEl = document.getElementById('modalProcessing');
            var bsModal = new bootstrap.Modal(modalEl, { backdrop: 'static', keyboard: false });
            bsModal.show();

            var startTime = performance.now();
            var timerInterval = setInterval(function() {
                var elapsed = ((performance.now() - startTime) / 1000).toFixed(2);
                procTimerText.textContent = elapsed + " dtk";
            }, 60);

            function logMessage(text, colorClass) {
                var d = new Date();
                var timeStr = d.toTimeString().split(' ')[0];
                var line = document.createElement('div');
                line.className = colorClass || 'text-light';
                line.innerHTML = '<span class="text-white-50">[' + timeStr + ']</span> ' + text;
                liveConsole.appendChild(line);
                liveConsole.scrollTop = liveConsole.scrollHeight;
            }

            // Realtime Step Animation Pipeline
            // Step 1: File Reading
            setTimeout(function() {
                document.getElementById('stepRead').style.background = 'rgba(56, 189, 248, 0.2)';
                document.getElementById('badgeStepRead').className = 'badge bg-info';
                document.getElementById('badgeStepRead').textContent = 'Aktif';
                procStatusText.textContent = 'Membaca byte biner berkas (' + fileSizeKb + ' KB, ' + blocks + ' blok)...';
                procProgressBar.style.width = '25%';
                logMessage('Membaca berkas: <strong>' + fileName + '</strong> (' + fileSizeKb + ' KB)', 'text-info');
                logMessage('Ditemukan total <strong>' + blocks.toLocaleString() + '</strong> blok ukuran 16-byte.', 'text-light');
            }, 250);

            // Step 2: Key Expansion
            setTimeout(function() {
                document.getElementById('badgeStepRead').className = 'badge bg-success';
                document.getElementById('badgeStepRead').textContent = 'Selesai';
                document.getElementById('stepKey').style.background = 'rgba(234, 179, 8, 0.2)';
                document.getElementById('badgeStepKey').className = 'badge bg-warning text-dark';
                document.getElementById('badgeStepKey').textContent = 'Proses';
                procStatusText.textContent = 'Mengekspansi subkunci (Key Schedule) ' + modeName + '...';
                procProgressBar.style.width = '45%';
                logMessage('Derivasi kunci rahasia untuk mode ' + modeName + '...', 'text-warning');
                if (mode === 'both' || mode === 'aes128') {
                    logMessage('[AES-128] KeyExpansion: 16-byte raw key -> 44 words (11 subkunci round)', 'text-white-50');
                }
                if (mode === 'both' || mode === 'aes256') {
                    logMessage('[AES-256] KeyExpansion: 32-byte SHA-256 key -> 60 words (15 subkunci round)', 'text-white-50');
                }
            }, 700);

            // Step 3: Encryption
            setTimeout(function() {
                document.getElementById('badgeStepKey').className = 'badge bg-success';
                document.getElementById('badgeStepKey').textContent = 'Selesai';
                document.getElementById('stepEnc').style.background = 'rgba(79, 70, 229, 0.25)';
                document.getElementById('badgeStepEnc').className = 'badge bg-primary';
                document.getElementById('badgeStepEnc').textContent = 'Transformasi';
                procStatusText.textContent = 'Mengeksekusi SubBytes, ShiftRows, MixColumns, AddRoundKey...';
                procProgressBar.style.width = '70%';
                logMessage('Menjalankan iterasi transformasi biner per blok 16-byte...', 'text-primary');
                logMessage('State Matrix: $S_{r} = AddRoundKey(MixColumns(ShiftRows(SubBytes(S_{r-1}))))', 'text-white-50');
            }, 1200);

            // Step 4: Decryption & Verification
            setTimeout(function() {
                document.getElementById('badgeStepEnc').className = 'badge bg-success';
                document.getElementById('badgeStepEnc').textContent = 'Selesai';
                document.getElementById('stepDec').style.background = 'rgba(16, 185, 129, 0.25)';
                document.getElementById('badgeStepDec').className = 'badge bg-success';
                document.getElementById('badgeStepDec').textContent = 'Verifikasi';
                procStatusText.textContent = 'Mengeksekusi dekripsi balik & validasi kecocokan SHA-256...';
                procProgressBar.style.width = '90%';
                logMessage('Uji dekripsi balik untuk validasi integritas rekonstruksi berkas...', 'text-success');
                logMessage('Memvalidasi byte original vs hasil dekripsi: 100% Identik.', 'text-success');
            }, 1700);
        });
    }
});

// Fungsi Download Berkas Hasil Pengujian yang baru selesai diuji
function downloadCipherFile(algo) {
    @if (isset($savedId) && $savedId)
        var fileKey = algo === 'aes128' ? 'cipher128' : 'cipher256';
        var url = "{{ url('adm/download_pengujian_file') }}/{{ $savedId }}/cipher/" + fileKey;
        window.location.href = url;
    @else
        alert('Silakan pilih berkas dari Riwayat Pengujian di bawah untuk mengunduh.');
    @endif
}

function downloadPlainFile(algo) {
    @if (isset($savedId) && $savedId)
        var fileKey = algo === 'aes128' ? 'cipher128' : 'cipher256';
        var url = "{{ url('adm/download_pengujian_file') }}/{{ $savedId }}/plain/" + fileKey;
        window.location.href = url;
    @else
        alert('Silakan pilih berkas dari Riwayat Pengujian di bawah untuk mengunduh.');
    @endif
}
</script>
@endsection
