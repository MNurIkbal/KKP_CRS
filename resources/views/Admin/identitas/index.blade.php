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
                                    <h4 id="pages_title">Data Jenis Identitas</h4>
                                </div>
                                <div>
                                    <a class="btn btn-w-lg btn-primary" href="{{ route('identitas.create') }}">Tambah Data</a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id='datatabel' class="table table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Identitas</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($identitas as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->jenis_identitas }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-action-dropdown dropdown-toggle" type="button"
                                                    id="dropdownActionIdentitas{{ $data->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v me-1"></i> Aksi
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="dropdownActionIdentitas{{ $data->id }}">
                                                    <li>
                                                        <a class="dropdown-item py-2" href="{{ route('identitas.edit', ['identita' => $data->id]) }}">
                                                            <i class="fas fa-edit text-warning me-2"></i> Edit
                                                        </a>
                                                    </li>
                                                    <li><hr class="dropdown-divider my-1"></li>
                                                    <li>
                                                        <form method="POST" action="{{ route('identitas.destroy', $data->id) }}" class="d-inline-block w-100">
                                                            @csrf
                                                            <input name="_method" type="hidden" value="DELETE">
                                                            <button type="submit" class="dropdown-item py-2 text-danger show_confirm" style="background: none; border: none; width: 100%; text-align: left;">
                                                                <i class="far fa-trash-alt me-2"></i> Hapus
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
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

                    <script>document.write(new Date().getFullYear())</script> © Aplikasi CRS LLDIKTI Wilayah III

                </div>


            </div>

        </div>

    </footer>
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
