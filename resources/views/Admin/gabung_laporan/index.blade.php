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
                            <div class="d-flex " style="justify-content: space-between;margin-bottom: 20px;">
                                <div>
                                    <h4 id="pages_title">Data Gabungan Laporan Masuk</h4>
                                </div>
                                <div>
                                    <a class="btn btn-w-lg btn-primary" href="{{ url('adm/tambah_gabung_laporan') }}">Tambah Data</a>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id='datatabel' class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Status</th>
                                        <th>Dibuat</th>
                                        <th>Deskripsi</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($laporan as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ Illuminate\Support\Facades\Crypt::decryptString($data->nama) }}</td>
                                            <td>
                                                @php
                                                    $level = Illuminate\Support\Facades\Crypt::decryptString(
                                                        $data->status,
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
                                            <td>{{ date("d F Y",strtotime($data->created_at)) }}</td>
                                            <td>{{ Illuminate\Support\Facades\Crypt::decryptString($data->deskripsi) }}</td>
                                            <td>
                                                @php
                                                    $status = Illuminate\Support\Facades\Crypt::decryptString(
                                                        $data->status,
                                                    );
                                                @endphp
                                                @if ($status == 'Diterima')
                                                    <a href="{{ url('adm/update_status_laporan/' . '1/' . $data->id) }}"
                                                        class="btn btn-success" title="Diterima"><i
                                                            class="fas fa-check"></i></a>
                                                    <a href="{{ url('adm/update_status_laporan/' . '0/' . $data->id) }}"
                                                        class="btn btn-danger" title="Ditolak"><i
                                                            class="fas fa-times"></i></a>
                                                @else
                                                    <a class="" title="Detail"
                                                        href="{{ url('adm/detail_laporan/' . Illuminate\Support\Facades\Crypt::encryptString($data->id) ) }}"
                                                        title="Lihat Log"><button type="button"
                                                            class="btn btn-success  "><i
                                                            class="fas fa-eye"></i></button></a>&nbsp;
                                                @endif
                                                <a class="" title="Hapus"
                                                    href="{{ url('adm/hapus_laporan_gabungan/' . $data->id) }}"
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
    @include('components.delete-modal')
@endsection

@push('css')
@endpush


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
