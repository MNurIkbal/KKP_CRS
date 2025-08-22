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



                        </div>



                        <div class="row mt-4 mb-2">

                            <div class="d-flex" style="justify-content: space-between">
                                <div>
                                    <h4 id="pages_title">Data Laporan Gabungan</h4>

                                </div>
                                <div>
                                    <a href="{{ url('adm/laporan_gabungan') }}" class="btn btn-warning">Kembali</a>

                                    @php
                                        $ts = Illuminate\Support\Facades\Crypt::decryptString(
                                            $first_laporan->status_laporan,
                                        );

                                    @endphp


                                    @if ($ts == 'Laporan tidak sesuai dengan tindak kekerasan')
                                    @elseif($ts == 'Selesai')
                                    @else
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#updateStatusModal">Tambah Log</button>
                                        @if (!$first_laporan->nama_pendamping)
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                data-bs-target="#nama_pendamping">Pendamping</button>
                                        @endif
                                    @endif
                                    @if (in_array($ts, ['Selesai', 'Laporan tidak sesuai dengan tindak kekerasan']))
                                        <a href="{{ url('adm/update_tinjau_ulang', Illuminate\Support\Facades\Crypt::encryptString($id)) }}"
                                            class="btn btn-primary">Tinjau
                                            Ulang</a>
                                    @endif

                                </div>
                            </div>

                        </div>


                        <!-- Modal Update Laporan -->

                        @if (!$first_laporan->nama_pendamping)
                            <div class="modal fade" id="nama_pendamping" tabindex="-1" role="dialog"
                                aria-labelledby="updateStatusModalLabel" aria-hidden="true">

                                <div class="modal-dialog modal-lg" role="document">

                                    <div class="modal-content">

                                        <!-- Header Modal -->

                                        <div class="modal-header">

                                            <h5 class="modal-title" id="updateStatusModalLabel">Tambah Pendamping</h5>
                                        </div>

                                        <!-- Form di dalam Modal -->

                                        <form action="{{ url('adm/pendamping_gabung') }}" method="POST"
                                            enctype="multipart/form-data">

                                            <input type="hidden" name="merge_laporan_id"
                                                value="{{ $first_laporan->merge_laporan_id }}">

                                            @csrf

                                            @method('PUT')

                                            <!-- Body Modal -->

                                            <div class="modal-body">


                                                <!-- Input upload file -->

                                                <div class="form-group mb-3">

                                                    <label for="nama">Nama <span class="text-danger">*</span>
                                                    </label>

                                                    <input type="text" name="nama" id="nama" class="form-control"
                                                        required value="{{ old('nama') }}" placeholder="Nama">

                                                    @error('nama')
                                                        <small>{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="form-group mb-3">

                                                    <label for="no_hp">No Hp <span class="text-danger">*</span>
                                                    </label>

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
                        @endif


                        <div class="modal fade" id="updateStatusModal" tabindex="-1" role="dialog"
                            aria-labelledby="updateStatusModalLabel" aria-hidden="true">

                            <div class="modal-dialog modal-lg" role="document">

                                <div class="modal-content">

                                    <!-- Header Modal -->

                                    <div class="modal-header">

                                        <h5 class="modal-title" id="updateStatusModalLabel">Tambah Log Laporan</h5>
                                    </div>

                                    <!-- Form di dalam Modal -->

                                    <form action="{{ url('adm/kirim_log') }}" method="POST" enctype="multipart/form-data">

                                        <input type="hidden" name="merge_laporan_id"
                                            value="{{ $first_laporan->merge_laporan_id }}">

                                        @csrf


                                        <!-- Body Modal -->

                                        <div class="modal-body">

                                            <!-- Dropdown status_laporan -->

                                            <div class="form-group ">

                                                <label for="status_laporan" class="form-label">Status Laporan <span class="text-danger">*</span>
                                                </label>

                                                <select name="status_laporan" id="status_laporan"
                                                    class="form-control pelapors" required style="width: 100% !important">

                                                    <option value="">Pilih status</option>
                                                    @foreach ($statuslaporan as $raw)
                                                        <option value="{{ $raw->status }}">{{ $raw->status }}</option>
                                                    @endforeach


                                                </select>
                                                @error('status_laporan')
                                                    <small>{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <br>

                                            <!-- Textarea deskripsi_laporan -->

                                            <div class="form-group">

                                                <label for="deskripsi_laporan">Deskirpsi Laporan <span class="text-danger">*</span>
                                                </label>

                                                <textarea name="deskripsi_laporan" placeholder="Deskirpsi" id="deskripsi_laporan" rows="3"
                                                    class="form-control" required></textarea>
                                                @error('deskripsi_laporan')
                                                    <small>{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <br>
                                            <!-- Input upload file -->

                                            <div class="form-group mb-3">

                                                <label for="upload_file">Upload File Log <span class="text-danger">*</span>
                                                </label>

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

                                                <label for="tgl_batas_proses">Tanggal Batas Proses <span class="text-danger">*</span>
                                                </label>

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

                                        <th>ID</th>

                                        <th>Kode Laporan</th>

                                        <th>Nama Pelapor</th>

                                        <th>Perguruan Tinggi</th>
                                        <th>Pelapor</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>

                                        <th>Action</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    @foreach ($detail_laporan as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data->id }}</td>
                                            <td>{{ $data->kode_laporan }}</td>
                                            <td>{{ Illuminate\Support\Facades\Crypt::decryptString($data->nama) }}</td>
                                            @if ($data->universitasRel)
                                                <td>{{ $data->universitasRel->nama }}</td>
                                            @else
                                                <td></td>
                                            @endif
                                            <td>{{ Illuminate\Support\Facades\Crypt::decryptString($data->pelapor) }}</td>
                                            <td>{{ date('d, F Y H:i', strtotime($data->created_at)) }}</td>
                                            <td>
                                                @php
                                                    $level = Illuminate\Support\Facades\Crypt::decryptString(
                                                        $data->status_laporan,
                                                    );
                                                @endphp
                                                @if ($level == 'Selesai')
                                                    <span class="badge badge-pill bg-success">{{ $level }}</span>
                                                @elseif ($level == 'Ditolak')
                                                    <span class="badge badge-pill bg-danger">{{ $level }}</span>
                                                @else
                                                    <span class="badge badge-pill bg-primary">{{ $level }}</span>
                                                @endif

                                            </td>
                                            <td>
                                                @php
                                                    $status = Illuminate\Support\Facades\Crypt::decryptString(
                                                        $data->status_laporan,
                                                    );
                                                @endphp
                                                @if ($status == 'Diterima')
                                                    <a href="{{ url('adm/update_status_laporan/' . '1/' . $data->kode_laporan) }}"
                                                        class="btn btn-success" title="Diterima"><i
                                                            class="fas fa-check"></i></a>
                                                    <a href="{{ url('adm/update_status_laporan/' . '0/' . $data->kode_laporan) }}"
                                                        class="btn btn-danger" title="Ditolak"><i
                                                            class="fas fa-times"></i></a>
                                                @else
                                                    <a class="" title="Detail"
                                                        href="{{ url(
                                                            'adm/detail_laporan_gabungan/' . $data->kode_laporan . '/' . Illuminate\Support\Facades\Crypt::encryptString($id),
                                                        ) }}"
                                                        title="Lihat Log"><button type="button"
                                                            class="btn btn-success  "><i
                                                                class="fas fa-eye"></i></button></a>&nbsp;
                                                @endif
                                                @if (!in_array($status, ['Selesai', 'Laporan tidak sesuai dengan tindak kekerasan']))
                                                    <a class="" title="Hapus"
                                                        href="{{ url('adm/hapus_laporan/' . $data->kode_laporan) }}"
                                                        title="Lihat Log"><button type="button"
                                                            class="btn btn-danger  "><i
                                                                class="fas fa-trash"></i></button></a>&nbsp;
                                                @endif
                                            </td>

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
        $('#datatabel').DataTable();
        $('.pelapors').select2({
            dropdownParent: $('#updateStatusModal')
        });
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
