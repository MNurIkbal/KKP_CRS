@extends('layouts.Admin.adm')

@section('content')
<div id="content" class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            @include('layouts.Admin.breadcrumbs')

            <!-- Hero Banner Penjelasan Ilmiah AES -->
            <div class="card border-0 shadow-sm rounded-4 mb-4" style="background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #312e81 100%); color: #ffffff;">
                <div class="card-body p-4 p-md-5">
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-3">
                        <div class="badge px-3 py-1.5 rounded-pill bg-primary bg-opacity-25 text-white border border-primary border-opacity-50 fw-semibold" style="font-size: 12px; letter-spacing: 0.5px;">
                            <i class="fas fa-microchip me-1"></i> ANALISIS KRIPTOGRAFI AES & SP-NETWORK
                        </div>
                        <a href="{{ route('adm.dekripsi_berkas') }}" class="btn btn-sm btn-light rounded-pill px-3 shadow-sm fw-semibold">
                            <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar Berkas
                        </a>
                    </div>
                    <h2 class="fw-bold text-white mb-2">Cara Kerja Enkripsi & Dekripsi AES (Rijndael)</h2>
                    <p class="text-white-50 mb-0" style="font-size: 14.5px; line-height: 1.7; max-width: 900px;">
                        Halaman ini menjelaskan secara transparan alur matematis dan logika transformasi data pada berkas laporan 
                        <strong class="text-white font-monospace">{{ $laporan->kode_laporan }}</strong>. Seluruh berkas diproses per blok <strong>16 bytes (128-bit)</strong> melalui 10 putaran (rounds) transformasi: <em>SubBytes, ShiftRows, MixColumns</em>, dan <em>AddRoundKey</em>.
                    </p>
                </div>
            </div>

            <!-- Ringkasan Metrik Riil Database -->
            <div class="row g-3 mb-4">
                <div class="col-md-3 col-sm-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100 p-3 bg-white">
                        <small class="text-muted fw-semibold d-block mb-1">Durasi Enkripsi (DB)</small>
                        <div class="d-flex align-items-baseline gap-2">
                            <h3 class="fw-bold text-success mb-0">{{ $kriptoInfo['waktu_enkripsi'] }}</h3>
                            <span class="text-muted small">detik</span>
                        </div>
                        <small class="text-success mt-2 d-block" style="font-size: 11.5px;">
                            <i class="fas fa-bolt me-1"></i>Tersimpan di kolom <code>waktu_enkripsi</code>
                        </small>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100 p-3 bg-white">
                        <small class="text-muted fw-semibold d-block mb-1">Durasi Dekripsi Terakhir</small>
                        <div class="d-flex align-items-baseline gap-2">
                            <h3 class="fw-bold text-primary mb-0">{{ $kriptoInfo['waktu_dekripsi'] }}</h3>
                            <span class="text-muted small">detik</span>
                        </div>
                        <small class="text-primary mt-2 d-block" style="font-size: 11.5px;">
                            <i class="fas fa-check-double me-1"></i>Tersimpan di kolom <code>waktu_dekripsi</code>
                        </small>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100 p-3 bg-white">
                        <small class="text-muted fw-semibold d-block mb-1">Ukuran File Tercatat</small>
                        <div class="d-flex align-items-baseline gap-2">
                            <h3 class="fw-bold text-dark mb-0">{{ $kriptoInfo['ukuran_file'] }}</h3>
                            <span class="text-muted small">MB</span>
                        </div>
                        <small class="text-muted mt-2 d-block" style="font-size: 11.5px;">
                            <i class="fas fa-database me-1"></i>Tersimpan di kolom <code>ukuran_file</code>
                        </small>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100 p-3 bg-white">
                        <small class="text-muted fw-semibold d-block mb-1">Algoritma & Mode</small>
                        <div class="d-flex align-items-baseline gap-2">
                            <h4 class="fw-bold text-indigo mb-0" style="color: #4f46e5;">AES-128 / 256</h4>
                        </div>
                        <small class="text-muted mt-2 d-block" style="font-size: 11.5px;">
                            <i class="fas fa-shield-halved me-1"></i>Blok 16 Bytes &middot; Padding PKCS#7
                        </small>
                    </div>
                </div>
            </div>

            <div class="row g-4 mb-4">
                <!-- Box 1: Pembentukan Kunci Cipher (Key Derivation) -->
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden bg-white">
                        <div class="card-header bg-white border-bottom p-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-3 p-2.5 bg-primary bg-opacity-10 text-primary">
                                    <i class="fas fa-key fs-5"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold mb-0 text-dark">1. Pembangkitan Kunci (Key Scheduling)</h5>
                                    <small class="text-muted">Transformasi Kata Sandi Pengguna ke 16-byte Secret Key</small>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <p class="text-muted" style="font-size: 13.5px; line-height: 1.6;">
                                Pada sistem CRS, kata sandi input pelapor dikonversi menjadi representasi nilai hash 128-bit melalui algoritma <em>MD5 Digest</em>, kemudian diambil 16 byte pertama untuk membentuk <strong>State Matrix Kunci (4x4 bytes)</strong>.
                            </p>

                            <div class="p-3 rounded-3 mb-3 bg-light border">
                                <small class="text-muted fw-semibold d-block mb-1">Password File Input Asli:</small>
                                <span class="font-monospace text-dark fw-bold bg-white px-2 py-1 rounded border">{{ $kriptoInfo['raw_password'] }}</span>
                            </div>

                            <div class="p-3 rounded-3 mb-3 bg-light border">
                                <small class="text-muted fw-semibold d-block mb-1">Hasil MD5 Digest Hash (128-bit):</small>
                                <span class="font-monospace text-danger fw-bold bg-white px-2 py-1 rounded border d-block text-break">{{ $kriptoInfo['md5_hash'] }}</span>
                            </div>

                            <div class="p-3 rounded-3 bg-indigo bg-opacity-10 border border-primary border-opacity-25" style="background: #eef2ff;">
                                <small class="text-primary fw-semibold d-block mb-1">AES 16-Bytes Key Matrix (Hexadecimal):</small>
                                <span class="font-monospace text-primary fw-bold bg-white px-2 py-1 rounded border d-block" style="letter-spacing: 1px;">
                                    {{ $kriptoInfo['aes_key_hex'] }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Box 2: Alur Logika 4 Tahapan Transformasi Per Round -->
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden bg-white">
                        <div class="card-header bg-white border-bottom p-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-3 p-2.5 bg-success bg-opacity-10 text-success">
                                    <i class="fas fa-arrows-spin fs-5"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold mb-0 text-dark">2. 4 Transformasi Putaran (Round Transformations)</h5>
                                    <small class="text-muted">Proses Substitusi dan Permutasi Blok Data</small>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <div class="timeline-kripto">
                                <div class="d-flex gap-3 mb-3">
                                    <span class="badge rounded-pill bg-success-subtle text-success border px-2 py-1 fw-bold" style="height: fit-content;">01</span>
                                    <div>
                                        <h6 class="fw-bold mb-0 text-dark">SubBytes (Substitusi S-Box)</h6>
                                        <small class="text-muted">Setiap byte di dalam state matriks digantikan dengan nilai pemetaan non-linear dari tabel substitusi (S-Box) untuk menciptakan efek <em>confusion</em>.</small>
                                    </div>
                                </div>
                                <div class="d-flex gap-3 mb-3">
                                    <span class="badge rounded-pill bg-primary-subtle text-primary border px-2 py-1 fw-bold" style="height: fit-content;">02</span>
                                    <div>
                                        <h6 class="fw-bold mb-0 text-dark">ShiftRows (Pergeseran Baris)</h6>
                                        <small class="text-muted">Baris ke-0 tidak digeser, baris ke-1 digeser 1 byte ke kiri, baris ke-2 digeser 2 bytes, dan baris ke-3 digeser 3 bytes untuk menciptakan efek <em>diffusion</em>.</small>
                                    </div>
                                </div>
                                <div class="d-flex gap-3 mb-3">
                                    <span class="badge rounded-pill bg-warning-subtle text-warning-emphasis border px-2 py-1 fw-bold" style="height: fit-content;">03</span>
                                    <div>
                                        <h6 class="fw-bold mb-0 text-dark">MixColumns (Pencampuran Kolom)</h6>
                                        <small class="text-muted">Setiap kolom dikalikan dengan polinomial tetap pada Galois Field GF(2^8) menggunakan matriks sirkulan perkalian log/inverse log table.</small>
                                    </div>
                                </div>
                                <div class="d-flex gap-3">
                                    <span class="badge rounded-pill bg-purple-subtle text-indigo border px-2 py-1 fw-bold" style="height: fit-content; background: #f3e8ff; color: #7e22ce;">04</span>
                                    <div>
                                        <h6 class="fw-bold mb-0 text-dark">AddRoundKey (Operasi XOR Kunci)</h6>
                                        <small class="text-muted">State matriks hasil pemrosesan di-XOR secara biner dengan subkunci putaran (Round Key) yang telah dijadwalkan.</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Analisis Berkas Riil Laporan Ini -->
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4 bg-white">
                <div class="card-header bg-white border-bottom p-4">
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-3 p-2.5 bg-indigo bg-opacity-10 text-primary" style="background: #eef2ff;">
                                <i class="fas fa-file-shield fs-5"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-0 text-dark">3. Data Fisik Berkas Terenkripsi pada Laporan Ini</h5>
                                <small class="text-muted">Sampel byte ciphertext dan pembagian blok data 16-bytes</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="row g-4">
                        <!-- Dokumen Identitas -->
                        <div class="col-lg-6">
                            <div class="p-4 rounded-4 border bg-light h-100">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <h6 class="fw-bold text-dark mb-0"><i class="fas fa-id-card text-success me-2"></i>Dokumen Identitas (KTP/KTM)</h6>
                                    @if ($fileIdentitasInfo)
                                        <span class="badge bg-success text-white px-2.5 py-1">Tersedia di Server</span>
                                    @else
                                        <span class="badge bg-secondary text-white px-2.5 py-1">Tidak Ada File</span>
                                    @endif
                                </div>

                                @if ($fileIdentitasInfo)
                                    <table class="table table-sm table-borderless mb-3" style="font-size: 13px;">
                                        <tr>
                                            <td class="text-muted" style="width: 160px;">Nama Berkas:</td>
                                            <td class="fw-bold font-monospace text-break">{{ $fileIdentitasInfo['filename'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Ukuran Berkas:</td>
                                            <td class="fw-bold text-dark">{{ $fileIdentitasInfo['size_formatted'] }} ({{ number_format($fileIdentitasInfo['size_bytes']) }} bytes)</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Jumlah Blok 16-byte:</td>
                                            <td class="fw-bold text-primary">{{ number_format($fileIdentitasInfo['blocks_count']) }} Blok Iterasi</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Padding Tambahan:</td>
                                            <td class="fw-bold text-dark">{{ $fileIdentitasInfo['padding_bytes'] }} bytes</td>
                                        </tr>
                                    </table>

                                    <div>
                                        <small class="text-muted fw-bold d-block mb-1">Cuplikan 32-Byte Pertama Ciphertext (Hex):</small>
                                        <pre class="p-2.5 rounded-3 bg-dark text-warning font-monospace mb-3" style="font-size: 11.5px; white-space: pre-wrap;">{{ $fileIdentitasInfo['hex_sample'] }}</pre>
                                    </div>

                                    <a href="{{ route('adm.download_berkas_enkripsi', ['path' => $laporan->upload_identitas]) }}" class="btn btn-sm btn-dark rounded-pill px-3 shadow-sm" style="font-weight: 600;">
                                        <i class="fas fa-file-code me-1 text-warning"></i> Unduh File Ciphertext AES (.rda)
                                    </a>
                                @else
                                    <p class="text-muted small mb-0">Laporan ini tidak melampirkan berkas identitas.</p>
                                @endif
                            </div>
                        </div>

                        <!-- Dokumen Bukti Kejadian -->
                        <div class="col-lg-6">
                            <div class="p-4 rounded-4 border bg-light h-100">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <h6 class="fw-bold text-dark mb-0"><i class="fas fa-file-shield text-primary me-2"></i>Dokumen Bukti Kejadian</h6>
                                    @if ($fileBuktiInfo)
                                        <span class="badge bg-primary text-white px-2.5 py-1">Tersedia di Server</span>
                                    @else
                                        <span class="badge bg-secondary text-white px-2.5 py-1">Tidak Ada File</span>
                                    @endif
                                </div>

                                @if ($fileBuktiInfo)
                                    <table class="table table-sm table-borderless mb-3" style="font-size: 13px;">
                                        <tr>
                                            <td class="text-muted" style="width: 160px;">Nama Berkas:</td>
                                            <td class="fw-bold font-monospace text-break">{{ $fileBuktiInfo['filename'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Ukuran Berkas:</td>
                                            <td class="fw-bold text-dark">{{ $fileBuktiInfo['size_formatted'] }} ({{ number_format($fileBuktiInfo['size_bytes']) }} bytes)</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Jumlah Blok 16-byte:</td>
                                            <td class="fw-bold text-primary">{{ number_format($fileBuktiInfo['blocks_count']) }} Blok Iterasi</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Padding Tambahan:</td>
                                            <td class="fw-bold text-dark">{{ $fileBuktiInfo['padding_bytes'] }} bytes</td>
                                        </tr>
                                    </table>

                                    <div>
                                        <small class="text-muted fw-bold d-block mb-1">Cuplikan 32-Byte Pertama Ciphertext (Hex):</small>
                                        <pre class="p-2.5 rounded-3 bg-dark text-warning font-monospace mb-3" style="font-size: 11.5px; white-space: pre-wrap;">{{ $fileBuktiInfo['hex_sample'] }}</pre>
                                    </div>

                                    <a href="{{ route('adm.download_berkas_enkripsi', ['path' => $laporan->upload_bukti]) }}" class="btn btn-sm btn-dark rounded-pill px-3 shadow-sm" style="font-weight: 600;">
                                        <i class="fas fa-file-code me-1 text-warning"></i> Unduh File Ciphertext AES (.rda)
                                    </a>
                                @else
                                    <p class="text-muted small mb-0">Laporan ini tidak melampirkan berkas bukti kejadian.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bagian 4: Tracing Matematis Blok 1 Riil Dari Berkas Laporan Ini -->
            @if ($stepTrace)
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4 bg-white">
                    <div class="card-header bg-white border-bottom p-4">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-3 p-2.5 bg-warning bg-opacity-10 text-warning" style="background: #fffbeb;">
                                <i class="fas fa-calculator fs-5 text-warning"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-0 text-dark">4. Tracing Matematis Byte Per Byte (Data Riil Blok 1)</h5>
                                <small class="text-muted">Demonstrasi nyata pembacaan byte dari berkas: <strong>{{ $stepTrace['source_filename'] }}</strong></small>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <p class="text-muted mb-4" style="font-size: 13.5px; line-height: 1.6;">
                            Berikut adalah 16 bytes pertama ($128\text{-bit}$) yang diambil langsung dari berkas ciphertext laporan ini, kemudian dihitung secara bertahap melalui matriks keadaan <em>State Matrix (4x4)</em>:
                        </p>

                        <div class="row g-4 text-center">
                            <!-- Matriks 1: Ciphertext Awal -->
                            <div class="col-md-3">
                                <div class="p-3 rounded-4 bg-light border h-100">
                                    <small class="text-muted fw-bold text-uppercase d-block mb-2" style="font-size: 11px;">1. State Ciphertext (Input)</small>
                                    <div class="matrix-box p-2 rounded-3 bg-white border mb-2 font-monospace" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 4px; font-size: 12px;">
                                        @foreach ($stepTrace['cipher_matrix'] as $row)
                                            @foreach ($row as $byteVal)
                                                <div class="p-1.5 rounded bg-danger-subtle text-danger fw-bold">{{ $byteVal }}</div>
                                            @endforeach
                                        @endforeach
                                    </div>
                                    <small class="text-muted" style="font-size: 11px;">16 Bytes Cipher Asli</small>
                                </div>
                            </div>

                            <!-- Matriks 2: Round Key Matrix -->
                            <div class="col-md-3">
                                <div class="p-3 rounded-4 bg-light border h-100">
                                    <small class="text-muted fw-bold text-uppercase d-block mb-2" style="font-size: 11px;">2. Round Key (Kunci AES)</small>
                                    <div class="matrix-box p-2 rounded-3 bg-white border mb-2 font-monospace" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 4px; font-size: 12px;">
                                        @foreach ($stepTrace['key_matrix'] as $row)
                                            @foreach ($row as $byteVal)
                                                <div class="p-1.5 rounded bg-primary-subtle text-primary fw-bold">{{ $byteVal }}</div>
                                            @endforeach
                                        @endforeach
                                    </div>
                                    <small class="text-muted" style="font-size: 11px;">16 Bytes Kunci Turunan</small>
                                </div>
                            </div>

                            <!-- Matriks 3: Transformasi S-Box -->
                            <div class="col-md-3">
                                <div class="p-3 rounded-4 bg-light border h-100">
                                    <small class="text-muted fw-bold text-uppercase d-block mb-2" style="font-size: 11px;">3. SubBytes (Substitusi)</small>
                                    <div class="matrix-box p-2 rounded-3 bg-white border mb-2 font-monospace" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 4px; font-size: 12px;">
                                        @foreach ($stepTrace['subbytes_matrix'] as $row)
                                            @foreach ($row as $byteVal)
                                                <div class="p-1.5 rounded bg-warning-subtle text-warning-emphasis fw-bold">{{ $byteVal }}</div>
                                            @endforeach
                                        @endforeach
                                    </div>
                                    <small class="text-muted" style="font-size: 11px;">Hasil Pemetaan S-Box</small>
                                </div>
                            </div>

                            <!-- Matriks 4: Plaintext Terdekripsi -->
                            <div class="col-md-3">
                                <div class="p-3 rounded-4 bg-light border h-100">
                                    <small class="text-muted fw-bold text-uppercase d-block mb-2" style="font-size: 11px;">4. State Plaintext (Output)</small>
                                    <div class="matrix-box p-2 rounded-3 bg-white border mb-2 font-monospace" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 4px; font-size: 12px;">
                                        @foreach ($stepTrace['plain_matrix'] as $row)
                                            @foreach ($row as $byteVal)
                                                <div class="p-1.5 rounded bg-success-subtle text-success fw-bold">{{ $byteVal }}</div>
                                            @endforeach
                                        @endforeach
                                    </div>
                                    <small class="text-muted" style="font-size: 11px;">ASCII: <code>{{ $stepTrace['plain_text_ascii'] }}</code></small>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 p-3 rounded-3 bg-light border" style="font-size: 13px;">
                            <div class="row align-items-center">
                                <div class="col-lg-6">
                                    <strong class="d-block text-dark mb-1"><i class="fas fa-file-lines me-1 text-primary"></i> Byte Ciphertext Hex (Blok 1):</strong>
                                    <code class="text-danger font-monospace">{{ $stepTrace['cipher_raw_hex'] }}</code>
                                </div>
                                <div class="col-lg-6 mt-3 mt-lg-0">
                                    <strong class="d-block text-dark mb-1"><i class="fas fa-check-circle me-1 text-success"></i> Byte Plaintext Terpulihkan (Blok 1):</strong>
                                    <code class="text-success font-monospace">{{ $stepTrace['plain_raw_hex'] }}</code>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Bagian 5: Perbedaan Logika Enkripsi vs Dekripsi -->
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white mb-4">
                <div class="card-header bg-white border-bottom p-4">
                    <h5 class="fw-bold mb-0 text-dark">5. Pembalikan Logika (Enkripsi vs Dekripsi)</h5>
                    <small class="text-muted">Mengapa proses dekripsi membutuhkan waktu komputasi yang simetris</small>
                </div>
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle mb-0" style="font-size: 13.5px;">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 20%;">Tahapan</th>
                                    <th style="width: 40%;"><i class="fas fa-lock text-success me-1"></i> Proses Enkripsi (File Asli &rarr; Ciphertext)</th>
                                    <th style="width: 40%;"><i class="fas fa-lock-open text-primary me-1"></i> Proses Dekripsi (Ciphertext &rarr; File Asli)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="fw-bold">1. Substitusi Byte</td>
                                    <td>Menggunakan tabel <code>$sBox</code> langsung.</td>
                                    <td>Menggunakan tabel inversi <code>$invSBox</code>.</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">2. Pergeseran Baris</td>
                                    <td><code>ShiftRows()</code>: Menggeser baris state matrix ke arah <strong>Kiri</strong>.</td>
                                    <td><code>InvShiftRows()</code>: Menggeser baris state matrix ke arah <strong>Kanan</strong>.</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">3. Perkalian Kolom</td>
                                    <td><code>MixColumns()</code>: Mengalikan kolom matriks dengan polinomial standar GF(2^8).</td>
                                    <td><code>InvMixColumns()</code>: Mengalikan dengan inversi polinomial GF(2^8).</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">4. Kunci Putaran</td>
                                    <td><code>AddRoundKey()</code>: Urutan putaran kunci dari Round 0 sampai Round 10.</td>
                                    <td><code>AddRoundKey()</code>: Urutan putaran kunci dibalik dari Round 10 mundur ke Round 0.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
