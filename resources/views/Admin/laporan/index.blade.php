@extends('layouts.Admin.adm')
@section('content')
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
                            <div class="col-sm-12 col-12 mb-3">
                                <div style="display: flex;justify-content: space-between">
                                    <div>
                                        <h4 id="pages_title">Data Laporan Masuk</h4>
                                    </div>
                                    <div>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#export"
                                            class="btn btn-primary">Export Excel</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if (Auth::user()->level == 'superadmin')
                            <style>
                                .form-row {
                                    display: flex;
                                    margin-bottom: 20px;
                                }

                                .form-col {
                                    flex: 1;
                                }

                                .form-left {
                                    flex: 1;
                                    /* Kolom kiri 1x */
                                }

                                .form-right {
                                    flex: 2;
                                    /* Kolom kanan 2x */
                                    display: flex;
                                    gap: 20px;
                                }

                                .form-right .form-col {
                                    flex: 1;
                                    /* Bagi dua kanan */
                                }
                            </style>

                            <form action="{{ url('adm/filter') }}" method="GET">
                                @csrf
                                <div class="form-row">
                                    <!-- Kolom kiri -->
                                    <div class="form-left">
                                        <label for="kategori1" class="block mb-2 text-sm font-medium text-gray-900">
                                            Perguruan Tinggi <span class="text-red-500">*</span>
                                        </label>
                                        <select id="kategori1" name="pt" required
                                            class="select2 block w-full px-3 py-2 bg-gray-100 border border-gray-300 text-sm text-gray-900 rounded-lg focus:ring focus:ring-pink-400 focus:border-pink-400 outline-none">
                                            <option value="">Pilih</option>
                                            <option value="All">All</option>
                                            @foreach ($universitas as $tiga)
                                                <option value="{{ $tiga->id }}">{{ $tiga->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Kolom kanan (2 kolom) -->
                                    <div class="form-right" style="margin-left: 10px;">
                                        <div class="form-col">
                                            <label for="kategori2" class="block mb-2 text-sm font-medium text-gray-900">
                                                Jenis Kekerasan <span class="text-red-500">*</span>
                                            </label>
                                            <select id="kategori2" name="kekerasan" required
                                                class="select2 block w-full px-3 py-2 bg-gray-100 border border-gray-300 text-sm text-gray-900 rounded-lg focus:ring focus:ring-pink-400 focus:border-pink-400 outline-none">
                                                <option value="">Pilih</option>
                                                <option value="All">All</option>
                                                @foreach ($kekerasan as $dua)
                                                    <option value="{{ $dua->id }}">{{ $dua->tipe_kekerasan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-col">
                                            <button class="btn btn-primary mt-4" type="submit">Filter</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"
                                rel="stylesheet" />
                            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

                            <script>
                                $('.select2').select2({
                                    width: '100%', // biar full lebar
                                    placeholder: "Pilih opsi"
                                });
                            </script>
                        @endif


                        <div class="table-responsive">
                            <table id='datatabel' class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID</th>
                                        <th>Nama Pelapor</th>
                                        <th>Perguruan Tinggi</th>
                                        <th>Jenis Kekerasan</th>
                                        <th>Pelapor</th>
                                        <th>Waktu</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($laporan as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data->id }}</td>
                                            <td>{{ Illuminate\Support\Facades\Crypt::decryptString($data->nama) }}</td>
                                            @if ($data->universitasRel)
                                                <td>{{ $data->universitasRel->nama }}</td>
                                            @else
                                                <td></td>
                                            @endif
                                            <td>{{ $data->kekerasan->tipe_kekerasan ?? null }}</td>
                                            <td>{{ Illuminate\Support\Facades\Crypt::decryptString($data->pelapor) }}</td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($data->created_at)->diffInYears(now()) >= 5
                                                    ? \Carbon\Carbon::parse($data->created_at)->format('d F Y')
                                                    : \Carbon\Carbon::parse($data->created_at)->diffForHumans() }}

                                            </td>
                                            <td>
                                                @php
                                                    $level = Illuminate\Support\Facades\Crypt::decryptString(
                                                        $data->status_laporan,
                                                    );
                                                @endphp
                                                @if ($level == 'Selesai')
                                                    <span class="badge badge-pill bg-success">{{ $level }}</span>
                                                @elseif ($level == 'Laporan tidak sesuai dengan tindak kekerasan')
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
                                                    <a href="#" class="btn btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#mina{{ $data->id }}"
                                                        title="Laporan tidak sesuai dengan tindak kekerasan"><i
                                                            class="fas fa-times"></i></a>
                                                    <div class="modal fade" id="mina{{ $data->id }}" tabindex="-1"
                                                        role="dialog" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <form method="POST" enctype="multipart/form-data"
                                                                class="modal-content"
                                                                action="{{ url('adm/update_status_laporans') }}">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="hidden" name="id"
                                                                    value="{{ $data->id }}">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Laporan Tidak Sesuai </h5>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label for="">Catatan *</label>
                                                                        <textarea name="catatan" id="catatan" cols="30" class="form-control" required rows="5">{{ old('catatan') }}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Simpan</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                @else
                                                    <a class="" title="Detail"
                                                        href="{{ route('laporan.show', ['laporan' => $data->kode_laporan]) }}"
                                                        title="Lihat Log"><button type="button"
                                                            class="btn btn-success  "><i
                                                                class="fas fa-eye"></i></button></a>&nbsp;
                                                @endif
                                                <a class="" title="Hapus"
                                                    href="{{ url('adm/hapus_laporan/' . $data->kode_laporan) }}"
                                                    title="Lihat Log"><button type="button" class="btn btn-danger  "><i
                                                            class="fas fa-trash"></i></button></a>&nbsp;
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

    <script>
        function kirimDataJenisIdentitas(value) {
            if (value) {
                const encoded = encodeURIComponent(value);
                const link = "{{ url('adm/ganti_laporan') }}/" + encoded;
                window.location.href = link;
            }
        }
    </script>
    <div class="modal fade" id="export" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form method="POST" enctype="multipart/form-data" action="{{ url('adm/export_laporan') }}"
                class="modal-content modal-lg">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Export Laporan</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Waktu Mulai <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" required name="mulai"
                                    value="{{ old('mulai') }}">
                                @error('mulai')
                                    <small>{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Waktu Akhir <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" required name="akhir"
                                    value="{{ old('akhir') }}">
                                @error('akhir')
                                    <small>{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Export</button>
                </div>
            </form>
        </div>
    </div>
    @include('components.delete-modal')
@endsection



@push('js')
    <!-- Required datatable js -->
    <script src="{{ asset('admin/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Responsive examples -->
    <script src="{{ asset('admin/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>


    <script>
        $(document).ready(function() {
            $('#datatabel').DataTable();
            $('.show_confirm').click(function(e) {
                if (!confirm('Yakin ingin menghapus data ini?')) {
                    e.preventDefault();
                }
            });
        });
    </script>
@endpush
