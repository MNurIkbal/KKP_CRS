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


                        <div class="row mt-2 mb-2">

                            <div class="col-md-6" style="margin-bottom: 10px;"><strong>ID Laporan</strong> :
                                {{ $laporan->id }}</div>
                            <div class="col-md-6" style="margin-bottom: 10px;"><strong>Kode Laporan</strong> :
                                {{ $laporan->kode_laporan }}</div>

                            <div class="col-md-6" style="margin-bottom: 10px;"><strong>Lokasi Kejadian</strong> :
                                {{ Illuminate\Support\Facades\Crypt::decryptString($laporan->lokasi_kejadian) }}</div>

                            <div class="col-md-6" style="margin-bottom: 10px;"><strong>No Identitas</strong> :
                                {{ Illuminate\Support\Facades\Crypt::decryptString($laporan->no_identitas) }}</div>

                            @if ($universitas)
                                <div class="col-md-6" style="margin-bottom: 10px;"><strong>Perguruan Tinggi</strong> :
                                    {{ $universitas->nama }}</div>
                            @endif

                            <div class="col-md-6" style="margin-bottom: 10px;"><strong>Nama</strong> :
                                {{ Illuminate\Support\Facades\Crypt::decryptString($laporan->nama) }}</div>
                            <div class="col-md-6" style="margin-bottom: 10px;"><strong>Kategori</strong> :
                                {{ Illuminate\Support\Facades\Crypt::decryptString($laporan->kategori) }}</div>
                            <div class="col-md-6" style="margin-bottom: 10px;"><strong>Pelapor</strong> :
                                {{ Illuminate\Support\Facades\Crypt::decryptString($laporan->pelapor) }}</div>
                            @if ($jenis)
                                <div class="col-md-6" style="margin-bottom: 10px;"><strong>Jenis Kekerasan</strong> :
                                    {{ $jenis->tipe_kekerasan }}</div>
                            @endif

                            <div class="col-md-6" style="margin-bottom: 10px;">NIK/NIM/NPSN :
                                {{ Illuminate\Support\Facades\Crypt::decryptString($laporan->no_identitas) }}</div>

                            @if ($laporan->universitasRel)
                                <div class="col-md-6" style="margin-bottom: 10px;"><strong>Perguruan Tinggi</strong> :
                                    {{ $laporan->universitasRel->nama }}
                                </div>
                            @endif


                            @if ($laporan->instansi_bekerja)
                                <div class="col-md-6" style="margin-bottom: 10px;"><strong>Instansi</strong> :
                                    {{ Illuminate\Support\Facades\Crypt::decryptString($laporan->instansi_bekerja) }}
                                </div>
                            @endif


                            <div class="col-md-6" style="margin-bottom: 10px;">Jenis Kelamin :
                                {{ Illuminate\Support\Facades\Crypt::decryptString($laporan->jenis_kelamin) }}</div>

                            <div class="col-md-6" style="margin-bottom: 10px;"><strong>Email</strong> :
                                {{ Illuminate\Support\Facades\Crypt::decryptString($laporan->email) }}</div>

                            <div class="col-md-6" style="margin-bottom: 10px;">No Telp:
                                {{ Illuminate\Support\Facades\Crypt::decryptString($laporan->no_hp) }}</div>


                            <div class="col-md-6" style="margin-bottom: 10px;"><strong>Jenis Identitas</strong> :

                                @if ($laporan->identitasRel)
                                    {{ $laporan->identitasRel->jenis_identitas }}
                                @endif
                            </div>


                            <div class="col-md-6" style="margin-bottom: 10px;">Tanggal Kejadian :
                                @if ($laporan->kronologi_kejadian)
                                    @php
                                        $crat = Illuminate\Support\Facades\Crypt::decryptString(
                                            $laporan->tanggal_kejadian,
                                        );
                                    @endphp
                                    {{ Carbon\Carbon::parse($crat)->locale('id')->diffForHumans() }}
                                @endif
                            </div>

                            <div class="col-md-6" style="margin-bottom: 10px;">Tanggal Laporan :
                                {{ Carbon\Carbon::parse($laporan->created_at)->locale('id')->diffForHumans() }}
                            </div>

                            <div class="col-md-6" style="margin-bottom: 10px;">Nama Pendamping :
                                @if ($laporan->nama_pendamping)
                                    {{ Illuminate\Support\Facades\Crypt::decryptString($laporan->nama_pendamping) }}
                                @endif

                            </div>
                            <div class="col-md-6" style="margin-bottom: 10px;">No Wa Pendamping :
                                @if ($laporan->nama_pendamping)
                                    {{ Illuminate\Support\Facades\Crypt::decryptString($laporan->no_wa_pendamping) }}
                                @endif
                            </div>


                            @if ($laporan->upload_identitas)
                                <div class="col-md-6" style="margin-bottom: 10px;">File Identitas : <a
                                        href="{{ asset(Illuminate\Support\Facades\Crypt::decryptString($laporan->upload_identitas)) }}"
                                        download="" target="_blank" class="btn btn-sm btn-success"><i
                                            class="fas fa-download"></i></a></div>
                            @endif

                            @if ($laporan->upload_bukti)
                                <div class="col-md-6" style="margin-bottom: 10px;">File Bukti : <a
                                        href="{{ asset(Illuminate\Support\Facades\Crypt::decryptString($laporan->upload_bukti)) }}"
                                        download="" target="_blank" class="btn btn-sm btn-success"><i
                                            class="fas fa-download"></i></a></div>
                            @endif
                        </div>
                        @if ($laporan->ket)
                            <div class="col-md-12" style="margin-bottom: 10px;">Catatan Kenapa Laporan Tidak Sesuai:
                                <br>
                                {{ Illuminate\Support\Facades\Crypt::decryptString($laporan->ket) }}
                            </div>
                        @endif
                        <div class="col-md-12" style="margin-bottom: 10px;">Kronologi Kejadian :
                            <br>
                            <p>
                                {!! Illuminate\Support\Facades\Crypt::decryptString($laporan->kronologi_kejadian) !!}
                            </p>
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
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#updateStatusModal">Tambah Log</button>
                                        @if (!$laporan->nama_pendamping)
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                data-bs-target="#nama_pendamping">Pendamping</button>
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
                                                    @if ($row->status == 'Admin')
                                                        <div class="d-flex justify-content-end">
                                                            <div class="alert bg-primary text-white"
                                                                style="max-width: 80%;">
                                                                <p>{!! $row->pesan !!}</p>
                                                                <small
                                                                    class="text-white">{{ date('d, F Y H:i', strtotime($row->created_at)) }}</small>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="d-flex justify-content-start">
                                                            <div class="alert bg-secondary text-white"
                                                                style="max-width: 80%;">
                                                                <p>{!! $row->pesan !!}</p>
                                                                <small
                                                                    class="text-white">{{ date('d, F Y H:i', strtotime($row->created_at)) }}</small>
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
                                                    <a href="{{ asset(Illuminate\Support\Facades\Crypt::decryptString($data->upload_file)) }}"
                                                        class="btn btn-primary" download="" target="_blank">
                                                        <i class="fas fa-download"></i>
                                                    </a>
                                                @else
                                                    <a href="#" class="btn btn-danger ">
                                                        <i class="fas fa-eye-slash"></i>
                                                    </a>
                                                @endif
                                            </td>

                                            <td>
                                                @if ($data->tgl_batas_proses)
                                                    {{ date('d, F Y', strtotime($data->tgl_batas_proses)) }}
                                                @endif
                                            </td>

                                            @if (!in_array($rr, ['Selesai', 'Laporan tidak sesuai dengan tindak kekerasan']))
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

    @include('components.delete-modal')
@endsection



@push('css')
@endpush





@push('js')
    <script>
        $(document).ready(function() {

        });
    </script>
@endpush
