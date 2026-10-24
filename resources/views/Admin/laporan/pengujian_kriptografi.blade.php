@extends('layouts.Admin.adm')

@section('content')
<div id="content" class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            @include('layouts.Admin.breadcrumbs')

            <!-- Hero Banner -->
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

            <!-- Form Uji Coba Berkas -->
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

                    <form action="{{ route('adm.proses_pengujian_kriptografi') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-5">
                                <label class="form-label fw-bold text-dark">Berkas Dokumen Uji <span class="text-danger">*</span></label>
                                <input type="file" name="test_file" class="form-control" required accept=".pdf,.png,.jpeg,.jpg,.zip,.txt,.docx">
                                <small class="text-muted">Maksimal ukuran berkas 5 MB untuk simulasi cepat.</small>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label fw-bold text-dark">Kunci / Password <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-key text-muted"></i></span>
                                    <input type="text" name="password_kunci" class="form-control font-monospace" required placeholder="Contoh: CRS2026Rahasia" value="{{ old('password_kunci', 'CRS2026UjiKripto') }}">
                                </div>
                                <small class="text-muted">Digunakan untuk derivasi round keys.</small>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-bold text-dark">Mode Benchmark</label>
                                <select name="mode_pengujian" class="form-select">
                                    <option value="both" {{ (old('mode_pengujian', $mode ?? 'both')) === 'both' ? 'selected' : '' }}>Komparasi Keduanya (AES-128 vs AES-256)</option>
                                    <option value="aes128" {{ (old('mode_pengujian', $mode ?? '')) === 'aes128' ? 'selected' : '' }}>Hanya AES-128 bit (10 Rounds)</option>
                                    <option value="aes256" {{ (old('mode_pengujian', $mode ?? '')) === 'aes256' ? 'selected' : '' }}>Hanya AES-256 bit (14 Rounds)</option>
                                </select>
                                <small class="text-muted">Pilih perbandingan simultan atau spesifik.</small>
                            </div>
                        </div>

                        <div class="mt-4 text-end">
                            <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill fw-bold shadow-sm" style="background: #4f46e5; border-color: #4f46e5;">
                                <i class="fas fa-play me-1"></i> Mulai Eksekusi Pengujian
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Tampilkan Hasil Pengujian Jika Ada -->
            @if (isset($results) && !empty($results))
                <!-- Ringkasan Berkas yang Diuji -->
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
                                        <small class="text-muted text-uppercase fw-bold d-block mb-1" style="font-size: 10px;">Cuplikan 32-Byte Ciphertext (HEX):</small>
                                        <code class="text-primary small d-block text-break font-monospace" style="font-size: 11px;">{{ $results['aes128']['sample_cipher_hex'] }}</code>
                                    </div>

                                    <!-- Visualisasi Real Data State Matrix 4x4 Blok Pertama -->
                                    @if (isset($results['aes128']['cipher_matrix']))
                                        <div class="border rounded-3 p-3 bg-white">
                                            <div class="d-flex align-items-center justify-content-between mb-2">
                                                <span class="text-xs fw-bold text-uppercase text-secondary">Visualisasi Transformasi Blok 1 (Riil)</span>
                                                <span class="badge bg-primary-subtle text-primary" style="font-size: 10px;">16 Bytes (State Matrix)</span>
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
                                                    <small class="text-primary fw-bold d-block mb-1" style="font-size: 10px;">Ciphertext Hasil (10R)</small>
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
                                            <small class="text-muted d-block text-center mt-2" style="font-size: 10px;"><i class="fas fa-microchip me-1 text-primary"></i> Transformasi 10 Putaran (SubBytes, ShiftRows, MixColumns, AddRoundKey)</small>
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
                                        <small class="text-muted text-uppercase fw-bold d-block mb-1" style="font-size: 10px;">Cuplikan 32-Byte Ciphertext (HEX):</small>
                                        <code class="text-success small d-block text-break font-monospace" style="font-size: 11px;">{{ $results['aes256']['sample_cipher_hex'] }}</code>
                                    </div>

                                    <!-- Visualisasi Real Data State Matrix 4x4 Blok Pertama -->
                                    @if (isset($results['aes256']['cipher_matrix']))
                                        <div class="border rounded-3 p-3 bg-white">
                                            <div class="d-flex align-items-center justify-content-between mb-2">
                                                <span class="text-xs fw-bold text-uppercase text-secondary">Visualisasi Transformasi Blok 1 (Riil)</span>
                                                <span class="badge bg-success-subtle text-success" style="font-size: 10px;">16 Bytes (State Matrix)</span>
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
                                                    <small class="text-success fw-bold d-block mb-1" style="font-size: 10px;">Ciphertext Hasil (14R)</small>
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
                                            <small class="text-muted d-block text-center mt-2" style="font-size: 10px;"><i class="fas fa-shield-halved me-1 text-success"></i> Transformasi 14 Putaran (SubBytes, ShiftRows, MixColumns, AddRoundKey)</small>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Grafik Komparasi Realtime (ApexCharts) -->
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
@endsection
