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
                            <div class="col-sm-10 col-12">
                                <h4 id="pages_title">Data Laporan Masuk {{ $kategori }}</h4>
                            </div>
                        </div>
                         @if (Auth::user()->level == 'superadmin')
                            <div class="mb-4 w-1/2">
                                <label for="jenis_identitas" class="block mb-2 text-sm font-medium text-gray-900">
                                    Kategori <span class="text-red-500">*</span>
                                </label>

                                <div class="relative">
                                    <select id="jenis_identitas" name="jenis_identitas" required
                                        class="block w-full px-3 py-2 bg-gray-100 border border-gray-300 text-sm text-gray-900 rounded-lg focus:ring-pink-400 focus:border-pink-400 outline-none appearance-none cursor-pointer"
                                        onchange="kirimDataJenisIdentitas(this.value)">
                                        <option value="">Pilih</option>
                                        <option value="All">All</option>
                                        <option value="Dosen">Dosen/Tenaga Pendidik</option>
                                        <option value="Mahasiswa">Mahasiswa</option>
                                        <option value="Mitra">Mitra</option>
                                    </select>

                                    @error('jenis_identitas')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <script>
                                function kirimDataJenisIdentitas(value) {
                                    if (value) {
                                        const link = "{{ url('adm/ganti_laporan') }}/" + value;
                                        window.location.href = url;
                                    }
                                }
                            </script>
                        @endif


                        <div class="table-responsive">
                            <table id='datatabel' class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID</th>
                                        <th>Kode Laporan</th>
                                        <th>Nama Pelapor</th>
                                        @if ($kategori == 'Dosen/Tenaga Pendidik' || $kategori == 'Mahasiswa')
                                            <th>Perguruan Tinggi</th>
                                        @else
                                            <th>Instansi Bekerja</th>
                                        @endif
                                        <th>Pelapor</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($laporan as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data->id }}</td>
                                            <td>{{ $data->kode_laporan }}</td>
                                            <td>{{ Illuminate\Support\Facades\Crypt::decryptString($data->nama) }}</td>
                                            @if ($kategori == 'Dosen/Tenaga Pendidik' || $kategori == 'Mahasiswa')
                                                @if ($data->universitasRel)
                                                
                                                    <td>{{ $data->universitasRel->nama }}</td>
                                                @else
                                                    <td></td>
                                                @endif
                                            @else
                                             @if ($data->instansi_bekerja)
                                                    <td>{{ Illuminate\Support\Facades\Crypt::decryptString($data->instansi_bekerja) }}
                                                    </td>
                                                @else
                                                    <td></td>
                                                @endif
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
