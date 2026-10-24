@extends('layouts.Admin.adm')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>

    <div id="content" class="main-content">

        <div class="page-content">

            <div class="container-fluid">

                @include('layouts.Admin.breadcrumbs')

                <div class="card">

                    <div class="card-body">

                        <div class="row mb-2">

                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">

                                @include('components.alert')

                            </div>

                            <div class="col-sm-10 col-12">

                                <h4 id="pages_title">Data Laporan</h4>

                            </div>



                        </div>


                        @php
                            $decryptVal = function($val) {
                                if (empty($val)) return '-';
                                try {
                                    return Illuminate\Support\Facades\Crypt::decryptString($val);
                                } catch (\Exception $e) {
                                    return $val;
                                }
                            };

                            $currentStatus = 'Diterima';
                            try {
                                $currentStatus = Illuminate\Support\Facades\Crypt::decryptString($laporan->status_laporan);
                            } catch (\Exception $e) {
                                $currentStatus = $laporan->status_laporan;
                            }
                            $statusBadgeClass = 'bg-primary';
                            if (in_array($currentStatus, ['Diterima', 'Menunggu'])) $statusBadgeClass = 'bg-info text-dark';
                            elseif ($currentStatus == 'Sedang diverifikasi') $statusBadgeClass = 'bg-primary';
                            elseif ($currentStatus == 'Selesai') $statusBadgeClass = 'bg-success';
                            elseif (str_contains(strtolower($currentStatus), 'tidak sesuai') || str_contains(strtolower($currentStatus), 'tolak')) $statusBadgeClass = 'bg-danger';
                            elseif (str_contains(strtolower($currentStatus), 'tinjau')) $statusBadgeClass = 'bg-warning text-dark';

                            $namaVal = $decryptVal($laporan->nama);
                            $noIdentitasVal = $decryptVal($laporan->no_identitas);
                            $jkVal = $decryptVal($laporan->jenis_kelamin);
                            $emailVal = $decryptVal($laporan->email);
                            $hpVal = $decryptVal($laporan->no_hp);
                            $kategoriVal = $decryptVal($laporan->kategori);
                            $pelaporVal = $decryptVal($laporan->pelapor);
                            $instansiVal = $decryptVal($laporan->instansi_bekerja);
                            $lokasiVal = $decryptVal($laporan->lokasi_kejadian);
                            $ketVal = $laporan->ket ? $decryptVal($laporan->ket) : null;
                            $kronologiVal = $decryptVal($laporan->kronologi_kejadian);

                            $tglKejadian = '-';
                            try {
                                $rawTgl = Illuminate\Support\Facades\Crypt::decryptString($laporan->tanggal_kejadian);
                                $tglKejadian = Carbon\Carbon::parse($rawTgl)->locale('id')->isoFormat('D MMMM Y');
                            } catch(\Exception $e) {
                                $tglKejadian = $laporan->tanggal_kejadian ?? '-';
                            }
                        @endphp

                        <div class="row g-3 mt-1 mb-4">
                            <!-- ID & Kode Laporan -->
                            <div class="col-md-4 col-sm-6">
                                <div class="p-3 rounded-3" style="background: #f8fafc; border: 1px solid #e2e8f0;">
                                    <small class="text-secondary fw-semibold d-block">ID Laporan</small>
                                    <span class="fw-bold text-dark">{{ $laporan->id }}</span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="p-3 rounded-3" style="background: #f8fafc; border: 1px solid #e2e8f0;">
                                    <small class="text-secondary fw-semibold d-block">Kode Laporan</small>
                                    <span class="fw-bold text-primary">{{ $laporan->kode_laporan }}</span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="p-3 rounded-3" style="background: #f8fafc; border: 1px solid #e2e8f0;">
                                    <small class="text-secondary fw-semibold d-block">Status Saat Ini</small>
                                    <span class="badge {{ $statusBadgeClass }} px-2 py-1 mt-1 fs-6">{{ $currentStatus }}</span>
                                </div>
                            </div>

                            <!-- Data Pelapor -->
                            <div class="col-md-4 col-sm-6">
                                <div class="p-3 rounded-3" style="background: #f8fafc; border: 1px solid #e2e8f0;">
                                    <small class="text-secondary fw-semibold d-block">Nama Lengkap</small>
                                    <span class="fw-bold text-dark">{{ $namaVal }}</span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="p-3 rounded-3" style="background: #f8fafc; border: 1px solid #e2e8f0;">
                                    <small class="text-secondary fw-semibold d-block">Jenis Identitas & Nomor</small>
                                    <span class="fw-bold text-dark">
                                        @if($identitasDokumen)
                                            <span class="badge bg-light text-dark border me-1">{{ $identitasDokumen->jenis_identitas }}</span>
                                        @endif
                                        {{ $noIdentitasVal }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="p-3 rounded-3" style="background: #f8fafc; border: 1px solid #e2e8f0;">
                                    <small class="text-secondary fw-semibold d-block">Jenis Kelamin</small>
                                    <span class="fw-bold text-dark">{{ $jkVal }}</span>
                                </div>
                            </div>

                            <!-- Kontak & Kategori -->
                            <div class="col-md-4 col-sm-6">
                                <div class="p-3 rounded-3" style="background: #f8fafc; border: 1px solid #e2e8f0;">
                                    <small class="text-secondary fw-semibold d-block">Email Pelapor</small>
                                    <span class="fw-bold text-dark">{{ $emailVal }}</span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="p-3 rounded-3" style="background: #f8fafc; border: 1px solid #e2e8f0;">
                                    <small class="text-secondary fw-semibold d-block">Nomor Telepon / WA</small>
                                    <span class="fw-bold text-dark">{{ $hpVal }}</span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="p-3 rounded-3" style="background: #f8fafc; border: 1px solid #e2e8f0;">
                                    <small class="text-secondary fw-semibold d-block">Kategori & Peran</small>
                                    <span class="fw-bold text-dark">
                                        {{ $kategoriVal }} <span class="badge bg-secondary ms-1">{{ $pelaporVal }}</span>
                                    </span>
                                </div>
                            </div>

                            <!-- Kampus / Instansi & Jenis Kekerasan -->
                            <div class="col-md-4 col-sm-6">
                                <div class="p-3 rounded-3" style="background: #f8fafc; border: 1px solid #e2e8f0;">
                                    <small class="text-secondary fw-semibold d-block">Perguruan Tinggi / Kampus</small>
                                    <span class="fw-bold text-dark">
                                        @if ($universitas)
                                            {{ $universitas->nama }}
                                        @elseif ($laporan->mitra == 'Mitra')
                                            Mitra
                                        @else
                                            -
                                        @endif
                                    </span>
                                </div>
                            </div>
                            @if ($laporan->instansi_bekerja)
                                <div class="col-md-4 col-sm-6">
                                    <div class="p-3 rounded-3" style="background: #f8fafc; border: 1px solid #e2e8f0;">
                                        <small class="text-secondary fw-semibold d-block">Instansi Bekerja (Mitra)</small>
                                        <span class="fw-bold text-dark">{{ $instansiVal }}</span>
                                    </div>
                                </div>
                            @endif
                            <div class="col-md-4 col-sm-6">
                                <div class="p-3 rounded-3" style="background: #f8fafc; border: 1px solid #e2e8f0;">
                                    <small class="text-secondary fw-semibold d-block">Jenis Tindak Kekerasan</small>
                                    <span class="fw-bold text-danger">
                                        @if ($jenis)
                                            <i class="fas fa-exclamation-triangle me-1"></i> {{ $jenis->tipe_kekerasan }}
                                        @else
                                            -
                                        @endif
                                    </span>
                                </div>
                            </div>

                            <!-- Kejadian, Lokasi & Tanggal -->
                            <div class="col-md-4 col-sm-6">
                                <div class="p-3 rounded-3" style="background: #f8fafc; border: 1px solid #e2e8f0;">
                                    <small class="text-secondary fw-semibold d-block">Lokasi Kejadian</small>
                                    <span class="fw-bold text-dark">{{ $lokasiVal }}</span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="p-3 rounded-3" style="background: #f8fafc; border: 1px solid #e2e8f0;">
                                    <small class="text-secondary fw-semibold d-block">Tanggal Terjadinya Insiden</small>
                                    <span class="fw-bold text-dark">{{ $tglKejadian }}</span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="p-3 rounded-3" style="background: #f8fafc; border: 1px solid #e2e8f0;">
                                    <small class="text-secondary fw-semibold d-block">Waktu Pembuatan Laporan</small>
                                    <span class="fw-bold text-dark">
                                        {{ Carbon\Carbon::parse($laporan->created_at)->locale('id')->isoFormat('D MMMM Y, HH:mm') }} WIB
                                    </span>
                                </div>
                            </div>
                            @if ($laporan->tgl_batas_proses)
                                <div class="col-md-4 col-sm-6">
                                    <div class="p-3 rounded-3" style="background: #fffbeb; border: 1px solid #fde68a;">
                                        <small class="text-warning text-dark fw-semibold d-block">Batas Waktu Proses</small>
                                        <span class="fw-bold text-dark">
                                            <i class="far fa-calendar-check text-warning me-1"></i>
                                            {{ Carbon\Carbon::parse($laporan->tgl_batas_proses)->locale('id')->isoFormat('D MMMM Y') }}
                                        </span>
                                    </div>
                                </div>
                            @endif

                            <!-- File Lampiran Identitas & Bukti -->
                            @php
                                $identitasSize = '-';
                                if ($laporan->upload_identitas) {
                                    try {
                                        $p = Illuminate\Support\Facades\Crypt::decryptString($laporan->upload_identitas);
                                        if (file_exists(public_path($p))) {
                                            $sz = filesize(public_path($p));
                                            $identitasSize = $sz >= 1048576 ? number_format($sz / 1048576, 2) . ' MB' : number_format($sz / 1024, 1) . ' KB';
                                        }
                                    } catch (\Exception $e) {}
                                }
                                $buktiSize = '-';
                                if ($laporan->upload_bukti) {
                                    try {
                                        $p = Illuminate\Support\Facades\Crypt::decryptString($laporan->upload_bukti);
                                        if (file_exists(public_path($p))) {
                                            $sz = filesize(public_path($p));
                                            $buktiSize = $sz >= 1048576 ? number_format($sz / 1048576, 2) . ' MB' : number_format($sz / 1024, 1) . ' KB';
                                        }
                                    } catch (\Exception $e) {}
                                }
                                $waktuEnkripsiLaporan = $laporan->waktu_enkripsi ? $laporan->waktu_enkripsi . ' detik' : 'Instant (< 0.1s)';
                            @endphp

                            @if ($laporan->upload_identitas)
                                <div class="col-md-6">
                                    <div class="p-3 rounded-3 d-flex align-items-center justify-content-between flex-wrap gap-2" style="background: #f0fdf4; border: 1px solid #bbf7d0;">
                                        <div>
                                            <small class="text-success fw-semibold d-block">Dokumen Identitas (KTP/KTM)</small>
                                            <div class="d-flex align-items-center gap-2 mt-1">
                                                <span class="fw-bold text-dark"><i class="fas fa-file-shield text-success me-1"></i> AES-256</span>
                                                <span class="badge bg-white text-secondary border px-2 py-1"><i class="fas fa-weight-hanging me-1"></i>{{ $identitasSize }}</span>
                                                <span class="badge bg-warning-subtle text-dark border px-2 py-1"><i class="fas fa-stopwatch me-1"></i>{{ $waktuEnkripsiLaporan }}</span>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="{{ route('adm.download_berkas_enkripsi', ['path' => $laporan->upload_identitas]) }}" 
                                               class="btn btn-sm btn-dark" 
                                               style="font-weight: 600; border-radius: 8px;"
                                               title="Unduh File Ciphertext AES (.rda)">
                                                <i class="fas fa-file-code me-1 text-warning"></i> Unduh .RDA
                                            </a>
                                            <button type="button" 
                                                onclick="bukaModalDekripsi('{{ $laporan->upload_identitas }}', 'laporan', '{{ $laporan->id }}', 'Dokumen Identitas', '{{ $laporan->kode_laporan }}', '{{ $identitasSize }}', '{{ $waktuEnkripsiLaporan }}')"
                                                class="btn btn-sm btn-success shadow-sm"
                                                title="Dekripsi Berkas Identitas dengan Kunci">
                                                <i class="fas fa-key me-1"></i> Dekripsi
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($laporan->upload_bukti)
                                <div class="col-md-6">
                                    <div class="p-3 rounded-3 d-flex align-items-center justify-content-between flex-wrap gap-2" style="background: #f0fdf4; border: 1px solid #bbf7d0;">
                                        <div>
                                            <small class="text-success fw-semibold d-block">Dokumen Bukti Kejadian</small>
                                            <div class="d-flex align-items-center gap-2 mt-1">
                                                <span class="fw-bold text-dark"><i class="fas fa-file-shield text-success me-1"></i> AES-256</span>
                                                <span class="badge bg-white text-secondary border px-2 py-1"><i class="fas fa-weight-hanging me-1"></i>{{ $buktiSize }}</span>
                                                <span class="badge bg-warning-subtle text-dark border px-2 py-1"><i class="fas fa-stopwatch me-1"></i>{{ $waktuEnkripsiLaporan }}</span>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="{{ route('adm.download_berkas_enkripsi', ['path' => $laporan->upload_bukti]) }}" 
                                               class="btn btn-sm btn-dark" 
                                               style="font-weight: 600; border-radius: 8px;"
                                               title="Unduh File Ciphertext AES (.rda)">
                                                <i class="fas fa-file-code me-1 text-warning"></i> Unduh .RDA
                                            </a>
                                            <button type="button" 
                                                onclick="bukaModalDekripsi('{{ $laporan->upload_bukti }}', 'laporan', '{{ $laporan->id }}', 'Dokumen Bukti Kejadian', '{{ $laporan->kode_laporan }}', '{{ $buktiSize }}', '{{ $waktuEnkripsiLaporan }}')"
                                                class="btn btn-sm btn-success shadow-sm"
                                                title="Dekripsi Berkas Bukti dengan Kunci">
                                                <i class="fas fa-key me-1"></i> Dekripsi
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Card Link Cara Kerja Enkripsi & Dekripsi AES -->
                        <div class="card border-0 rounded-4 mb-4 overflow-hidden" style="background: linear-gradient(135deg, #f8fafc 0%, #eef2ff 100%); border: 1px solid #c7d2fe !important;">
                            <div class="card-body p-3 p-md-4 d-flex align-items-center justify-content-between flex-wrap gap-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="rounded-3 p-3 text-primary d-flex align-items-center justify-content-center" style="background: #ffffff; border: 1px solid #e0e7ff; width: 48px; height: 48px;">
                                        <i class="fas fa-microchip fs-4 text-primary"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold text-dark mb-1">Analisis Logika & Cara Kerja Kriptografi AES-256</h6>
                                        <p class="text-muted mb-0 small">Pelajari tahapan matematis (SubBytes, ShiftRows, MixColumns, AddRoundKey) dan dekonstruksi blok file laporan ini.</p>
                                    </div>
                                </div>
                                <a href="{{ route('adm.kriptografi.cara_kerja', ['kode_laporan' => $laporan->kode_laporan]) }}" 
                                   class="btn btn-primary rounded-pill px-4 shadow-sm" style="background: #4f46e5; border-color: #4f46e5;">
                                    <i class="fas fa-atom me-1"></i> Buka Detail Cara Kerja
                                </a>
                            </div>
                        </div>

                        <!-- Catatan Penolakan jika ada -->
                        @if ($ketVal)
                            <div class="alert alert-danger shadow-sm mb-4" role="alert">
                                <h6 class="alert-heading fw-bold mb-1"><i class="fas fa-exclamation-circle me-1"></i> Catatan Penolakan / Laporan Tidak Sesuai:</h6>
                                <p class="mb-0">{{ $ketVal }}</p>
                            </div>
                        @endif

                        <!-- Kronologi Kejadian -->
                        <div class="card border-0 shadow-sm mb-4" style="background: #f8fafc; border: 1px solid #e2e8f0 !important;">
                            <div class="card-body p-4">
                                <h6 class="fw-bold text-dark mb-2"><i class="fas fa-align-left text-primary me-2"></i>Kronologi Kejadian :</h6>
                                <div class="text-muted" style="line-height: 1.8; font-size: 14.5px;">
                                    {!! $kronologiVal !!}
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4 mb-2">

                            <div class="d-flex" style="justify-content: space-between">
                                <div>
                                    <h4>Detail Update Laporan</h4>
                                </div>
                                <div>
                                    <a href="{{ url('adm/laporan') }}" class="btn btn-warning">Kembali</a>

                                    @php
                                        $ts = Illuminate\Support\Facades\Crypt::decryptString($laporan->status_laporan);

                                    @endphp
                                    @if (in_array($ts, ['Selesai', 'Laporan tidak sesuai dengan tindak kekerasan']))
                                        <a class="" title="Hapus"
                                            href="{{ url('adm/tinjau_ulang/' . $laporan->id) }}"
                                            title="Tinjau Ulang"><button type="button" class="btn btn-primary">Tinjau
                                                Ulang</button></a>
                                    @endif

                                    @if ($ts == 'Laporan tidak sesuai dengan tindak kekerasan')
                                    @elseif($ts == 'Selesai')
                                    @else
                                        @if (Auth::user()->level != 'pelapor')
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#updateStatusModal">Tambah Log</button>
                                            @if (!$laporan->nama_pendamping)
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                    data-bs-target="#nama_pendamping">Pendamping</button>
                                            @endif
                                        @endif
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#chat">Chat</button>
                                    @endif
                                </div>
                            </div>

                        </div>

                        <!-- Modal Update Laporan -->

                        <div class="modal fade" id="nama_pendamping" tabindex="-1" role="dialog"
                            aria-labelledby="updateStatusModalLabel" aria-hidden="true">

                            <div class="modal-dialog modal-lg" role="document">

                                <div class="modal-content">

                                    <!-- Header Modal -->

                                    <div class="modal-header">

                                        <h5 class="modal-title" id="updateStatusModalLabel">Tambah Pendamping</h5>
                                    </div>

                                    <!-- Form di dalam Modal -->

                                    <form action="{{ url('adm/pendamping') }}" method="POST"
                                        enctype="multipart/form-data">

                                        <input type="hidden" name="kode_laporan" value="{{ $laporan->kode_laporan }}">

                                        @csrf

                                        @method('PUT')

                                        <!-- Body Modal -->

                                        <div class="modal-body">


                                            <!-- Input upload file -->

                                            <div class="form-group mb-3">

                                                <label for="nama">Nama <span class="text-danger">*</span></label>

                                                <input type="text" name="nama" id="nama" class="form-control"
                                                    required value="{{ old('nama') }}" placeholder="Nama">

                                                @error('nama')
                                                    <small>{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-3">

                                                <label for="no_hp">No Hp <span class="text-danger">*</span></label>

                                                <input type="number" name="no_hp" id="no_hp" class="form-control"
                                                    required value="{{ old('no_hp') }}" placeholder="No Hp">

                                                @error('no_hp')
                                                    <small>{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <!-- Input tanggal batas proses -->

                                        </div>

                                        <!-- Footer Modal -->

                                        <div class="modal-footer">

                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Tutup</button>

                                            <button type="submit" class="btn btn-primary">Simpan</button>

                                        </div>

                                    </form>

                                </div>

                            </div>

                        </div>

                        <div class="modal fade" id="chat" tabindex="-1" role="dialog"
                            aria-labelledby="updateStatusModalLabel" aria-hidden="true" style="overflow: hidden">

                            <div class="modal-dialog modal-lg" role="document">

                                <div class="modal-content">

                                    <!-- Header Modal -->
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="updateStatusModalLabel">Chat</h5>
                                    </div>

                                    <!-- Form di dalam Modal -->
                                    <form action="{{ url('adm/chat_admin') }}" method="POST"
                                        enctype="multipart/form-data">

                                        <input type="hidden" name="id" value="{{ $laporan->id }}">
                                        @csrf

                                        <!-- Body Modal -->
                                        <div class="modal-body" style="max-height: 500px; overflow: hidden;">
                                            <div class="chat-container" id="chatContainer"
                                                style="max-height: 400px; overflow-y: scroll;">
                                                <!-- Loop chat messages -->
                                                @foreach ($chat as $row)
                                                    @php
                                                        $isMe = (Auth::user()->level === 'pelapor' && $row->status !== 'Admin') || (Auth::user()->level !== 'pelapor' && $row->status === 'Admin');
                                                    @endphp
                                                    @if ($isMe)
                                                        <div class="d-flex justify-content-end mb-2">
                                                            <div class="p-3 rounded-4 bg-primary text-white" style="max-width: 80%; box-shadow: 0 2px 8px rgba(79, 70, 229, 0.25);">
                                                                <small class="d-block fw-bold mb-1 text-white-50">Anda ({{ $row->status }})</small>
                                                                <p class="mb-1">{!! $row->pesan !!}</p>
                                                                <small class="text-white-50" style="font-size: 11px;">{{ date('d F Y, H:i', strtotime($row->created_at)) }}</small>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="d-flex justify-content-start mb-2">
                                                            <div class="p-3 rounded-4 bg-light text-dark border" style="max-width: 80%;">
                                                                <small class="d-block fw-bold mb-1 text-primary">{{ $row->nama }} ({{ $row->status }})</small>
                                                                <p class="mb-1">{!! $row->pesan !!}</p>
                                                                <small class="text-muted" style="font-size: 11px;">{{ date('d F Y, H:i', strtotime($row->created_at)) }}</small>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>

                                        <!-- Add the following JavaScript at the bottom of your page -->
                                        <script>
                                            // Scroll to the bottom of the chat container when the modal is shown or content is updated
                                            $(document).ready(function() {
                                                // When modal is shown
                                                $('#chat').on('shown.bs.modal', function() {
                                                    var chatContainer = $('#chatContainer');
                                                    chatContainer.scrollTop(chatContainer[0].scrollHeight);
                                                });

                                                // Alternatively, when a new message is added (after form submission), scroll to the bottom
                                                $('form').submit(function() {
                                                    var chatContainer = $('#chatContainer');
                                                    setTimeout(function() {
                                                        chatContainer.scrollTop(chatContainer[0].scrollHeight);
                                                    }, 200);
                                                });
                                            });
                                        </script>


                                        <!-- Input Message -->
                                        <div class="m-4">
                                            <div class="d-flex">
                                                <textarea name="pesan" class="form-control me-2" placeholder="Ketik pesan..." required>{{ old('pesan') }}</textarea>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fa-solid fa-paper-plane"></i>
                                                </button>
                                            </div>
                                        </div>

                                        @error('pesan')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror

                                        <!-- Footer Modal -->
                                    </form>

                                </div>

                            </div>

                        </div>


                        <div class="modal fade" id="updateStatusModal" tabindex="-1" role="dialog"
                            aria-labelledby="updateStatusModalLabel" aria-hidden="true">

                            <div class="modal-dialog modal-lg" role="document">

                                <div class="modal-content">

                                    <!-- Header Modal -->

                                    <div class="modal-header">

                                        <h5 class="modal-title" id="updateStatusModalLabel">Tambah Log Laporan</h5>
                                    </div>

                                    <!-- Form di dalam Modal -->

                                    <form action="{{ route('laporan.update', $laporan->kode_laporan) }}" method="POST"
                                        enctype="multipart/form-data">

                                        <input type="hidden" name="kode_laporan" value="{{ $laporan->kode_laporan }}">

                                        @csrf

                                        @method('PUT')

                                        <!-- Body Modal -->

                                        <div class="modal-body">

                                            <!-- Dropdown status_laporan -->

                                            <div class="form-group ">

                                                <label for="status_laporan" class="form-label">Status Laporan <span class="text-danger">*</span></label>

                                                <select name="status_laporan" id="status_laporan"
                                                    class="form-control pelapors" required style="width: 100% !important">

                                                    <option value="">Pilih status</option>

                                                    @foreach ($statuslaporan as $status)
                                                        <option value="{{ $status->status }}"
                                                            {{ old('status_laporan', $laporan->status_laporan) == $status ? 'selected' : '' }}>

                                                            {{ $status->status }}

                                                        </option>
                                                    @endforeach

                                                </select>
                                                @error('status_laporan')
                                                    <small>{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <br>

                                            <!-- Textarea deskripsi_laporan -->

                                            <div class="form-group">

                                                <label for="deskripsi_laporan">Deskripsi Laporan <span class="text-danger">*</span></label>

                                                <textarea name="deskripsi_laporan" id="deskripsi_laporan" rows="3" class="form-control" required>{{ old('deskripsi_laporan', Illuminate\Support\Facades\Crypt::decryptString($laporan->deskripsi_laporan)) }}</textarea>
                                                @error('deskripsi_laporan')
                                                    <small>{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <!-- Input upload file -->

                                            <div class="form-group mb-3">

                                                <label for="upload_file">Upload File Log <span class="text-danger">*</span></label>

                                                <input type="file" name="upload_file" id="upload_file"
                                                    class="form-control" required
                                                    accept=".jpeg,.jpg,.png,.pdf,.zip,.mp4,.mp3">
                                                <small>File Yang boleh di upload .JPG, .JPEG, .PNG, .Mp4, .Mp3, .ZIP, .PDF
                                                    Maksimal Upload 10 MB</small>
                                                <br>
                                                <small id="error_message_dua" style="color: red;">
                                                </small>
                                                @error('upload_file')
                                                    <small>{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="password_file">Password Enkripsi File <span class="text-danger">*</span></label>
                                                <input type="password" name="password_file" id="password_file"
                                                    class="form-control" required placeholder="Masukkan password untuk enkripsi">
                                                @error('password_file')
                                                    <small>{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <!-- Input tanggal batas proses -->

                                            <div class="form-group">

                                                <label for="tgl_batas_proses">Tanggal Batas Proses <span class="text-danger">*</span></label>

                                                <input type="date" required name="tgl_batas_proses"
                                                    id="tgl_batas_proses" class="form-control"
                                                    value="{{ old('tgl_batas_proses') }}">


                                                @error('tgl_batas_proses')
                                                    <small>{{ $message }}</small>
                                                @enderror
                                            </div>

                                        </div>

                                        <!-- Footer Modal -->

                                        <div class="modal-footer">

                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Tutup</button>

                                            <button type="submit" class="btn btn-primary">Simpan</button>

                                        </div>

                                    </form>

                                </div>

                            </div>

                        </div>

                        <br>
                        <div class="table-responsive">

                            <table id='datatabel' class="table table-hover" style="width:100%">

                                <thead>

                                    <tr>

                                        <th>No</th>

                                        <th>Status Laporan</th>

                                        <th>Tanggal Diubah</th>

                                        <th>Deskripsi</th>

                                        <th>File</th>
                                        <th>Waktu Enkripsi</th>
                                        <th>Ukuran File</th>
                                        @php
                                            $rr = Illuminate\Support\Facades\Crypt::decryptString(
                                                $laporan->status_laporan,
                                            );
                                        @endphp
                                        <th>Tanggal Batas Proses</th>
                                        @if (!in_array($rr, ['Selesai', 'Laporan tidak sesuai dengan tindak kekerasan']))
                                            <th>Action</th>
                                        @endif

                                    </tr>

                                </thead>

                                <tbody>

                                    @foreach ($logs as $data)
                                        <tr>

                                            <td>{{ $loop->iteration }}</td>

                                            <td>{{ Illuminate\Support\Facades\Crypt::decryptString($data->status_laporan) }}
                                            </td>

                                            <td>{{ $data->created_at }}</td>

                                            <td>{{ Illuminate\Support\Facades\Crypt::decryptString($data->deskripsi_laporan) }}
                                            </td>

                                            <td>
                                                @if ($data->upload_file)
                                                    <button type="button" 
                                                        onclick="bukaModalDekripsi('{{ $data->upload_file }}', 'log', '{{ $data->id }}', 'Berkas Log Tindak Lanjut', '{{ $laporan->kode_laporan }}')"
                                                        class="btn btn-primary" title="Dekripsi Berkas Log">
                                                        <i class="fas fa-download"></i>
                                                    </button>
                                                @else
                                                    <a href="#" class="btn btn-danger ">
                                                        <i class="fas fa-eye-slash"></i>
                                                    </a>
                                                @endif
                                            </td>
                                            <td>{{ $data->waktu_enkripsi ? $data->waktu_enkripsi . ' s' : '-' }}</td>
                                            <td>{{ $data->ukuran_file ? $data->ukuran_file . ' MB' : '-' }}</td>

                                            <td>
                                                @if ($data->tgl_batas_proses)
                                                    {{ date('d, F Y', strtotime($data->tgl_batas_proses)) }}
                                                @endif
                                            </td>

                                            @if (!in_array($rr, ['Selesai', 'Laporan tidak sesuai dengan tindak kekerasan']) && Auth::user()->level != 'pelapor')
                                                <td>
                                                    <form action="{{ url('adm/hapus_logs_laporan') }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="id"
                                                            value="{{ $data->id }}">
                                                        <button type="submit" class="btn btn-danger"><i
                                                                class="fas fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            @endif

                                        </tr>
                                    @endforeach

                                </tbody>

                            </table>
                        </div>




                    </div>

                </div>

            </div>

        </div>

    </div>
    </div>

    </div>
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
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script src="{{ asset('admin/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Responsive examples -->
    <script src="{{ asset('admin/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $('.pelapors').select2({
            dropdownParent: $('#updateStatusModal')
        });
        $('#datatabel').DataTable();
        document.getElementById('upload_file').addEventListener('change', function(event) {
            const allowedTypes = [
                'image/jpeg',
                'image/jpg',
                'image/png',
                'application/pdf',
                'application/zip',
                'video/mp4',
                'audio/mpeg' // untuk mp3
            ];
            const maxFiles = 5;
            const maxSize = 20 * 1024 * 1024; // 4MB = 4024KB kira-kira

            const files = event.target.files;
            const errorMessage = document.getElementById('error_message_dua');
            errorMessage.textContent = '';

            if (files.length > maxFiles) {
                errorMessage.textContent = 'Maksimal upload 5 file saja.';
                event.target.value = '';
                return;
            }

            for (let i = 0; i < files.length; i++) {
                const file = files[i];

                // Cek tipe file
                if (!allowedTypes.includes(file.type)) {
                    errorMessage.textContent =
                        `Tipe file "${file.name}" tidak diperbolehkan. Hanya jpeg, jpg, png, pdf, zip, mp4, dan mp3.`;
                    event.target.value = '';
                    return;
                }

                // Cek ukuran file
                if (file.size > maxSize) {
                    errorMessage.textContent = `Ukuran file "${file.name}" melebihi 20 MB.`;
                    event.target.value = '';
                    return;
                }
            }

            // Semua valid
            errorMessage.textContent = '';
        });
    </script>

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
                        <!-- Card Ringkasan Info -->
                        <!-- Card Ringkasan Info & Metrik -->
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
                        <button type="submit" id="btnSubmitDekripsiDetail" class="btn btn-primary rounded-pill px-4 shadow-sm" style="background: #4f46e5; border-color: #4f46e5;">
                            <i class="fas fa-download me-1"></i> Dekripsi & Unduh
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Notifikasi Hasil Dekripsi (Durasi & Ukuran) -->
    <div class="modal fade" id="modalHasilDekripsiDetail" tabindex="-1" aria-hidden="true">
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
                        <strong class="text-success" id="hasilDekripsiWaktuDetail">-</strong>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Ukuran Berkas:</span>
                        <strong class="text-dark" id="hasilDekripsiUkuranDetail">-</strong>
                    </div>
                </div>
                <button type="button" class="btn btn-primary rounded-pill w-100" data-bs-dismiss="modal" style="background: #4f46e5; border-color: #4f46e5;">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    @include('components.delete-modal')
@endsection

@push('js')
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

        function getCookie(name) {
            let matches = document.cookie.match(new RegExp(
                "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
            ));
            return matches ? decodeURIComponent(matches[1]) : undefined;
        }

        function eraseCookie(name) {
            document.cookie = name + '=; Max-Age=-99999999; path=/;';
        }

        document.addEventListener("DOMContentLoaded", function() {
            const form = document.querySelector("#modalDekripsiBerkas form");
            if (form) {
                form.addEventListener("submit", function() {
                    const submitBtn = document.getElementById('btnSubmitDekripsiDetail');
                    const originalHtml = submitBtn.innerHTML;
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Mendekripsi...';
                    submitBtn.disabled = true;

                    let checkInterval = setInterval(function() {
                        const status = getCookie('crs_decrypt_status');
                        if (status === 'success') {
                            clearInterval(checkInterval);
                            submitBtn.innerHTML = originalHtml;
                            submitBtn.disabled = false;

                            const decryptTime = getCookie('crs_decrypt_time') || '-';
                            const decryptSize = getCookie('crs_decrypt_size') || '-';

                            eraseCookie('crs_decrypt_status');
                            eraseCookie('crs_decrypt_time');
                            eraseCookie('crs_decrypt_size');

                            const modalForm = bootstrap.Modal.getInstance(document.getElementById('modalDekripsiBerkas'));
                            if (modalForm) modalForm.hide();

                            document.getElementById('hasilDekripsiWaktuDetail').textContent = decryptTime + ' detik';
                            document.getElementById('hasilDekripsiUkuranDetail').textContent = decryptSize + ' MB';
                            var modalHasil = new bootstrap.Modal(document.getElementById('modalHasilDekripsiDetail'));
                            modalHasil.show();
                        }
                    }, 500);

                    setTimeout(function() {
                        clearInterval(checkInterval);
                        submitBtn.innerHTML = originalHtml;
                        submitBtn.disabled = false;
                    }, 15000);
                });
            }
        });
    </script>
@endpush
