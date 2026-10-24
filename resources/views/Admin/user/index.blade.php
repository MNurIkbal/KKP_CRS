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
                            <div class="d-flex" style="justify-content: space-between;margin-bottom: 20px;">
                                <div>
                                    <h4 id="pages_title">Data User</h4>
                                </div>
                                <div>
                                    <a class="btn btn-w-lg btn-primary" href="{{ route('user.create') }}">Tambah Data</a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id='datatabel' class="table table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Email</th>
                                    <th>Nama</th>
                                    <th>Level</th>
                                    <th>Perguruan Tinggi</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->level }}</td>
                                        <td>{{ $item->universitasRel?->nama ?? '' }}
                                        </td>
                                        <td>
                                            @if ($item->status == "Aktif")
                                                <span class="badge badge-pill badge-success bg-success">Aktif</span>
                                                @else
                                                <span class="badge badge-pill badge-danger bg-danger">Tidak     Aktif</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-action-dropdown dropdown-toggle" type="button"
                                                    id="dropdownActionUser{{ $item->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v me-1"></i> Aksi
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="dropdownActionUser{{ $item->id }}">
                                                    <li>
                                                        <a class="dropdown-item py-2" href="{{ route('user.edit', ['user' => $item->id]) }}">
                                                            <i class="fas fa-edit text-warning me-2"></i> Edit
                                                        </a>
                                                    </li>
                                                    <li><hr class="dropdown-divider my-1"></li>
                                                    <li>
                                                        <button type="button" class="dropdown-item py-2 text-danger delete-btn" data-id="{{ $item->id }}" data-name="{{ $item->name }}" style="background: none; border: none; width: 100%; text-align: left;">
                                                            <i class="far fa-trash-alt me-2"></i> Hapus
                                                        </button>
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

                    <script>
                        document.write(new Date().getFullYear())
                    </script> © Aplikasi CRS LLDIKTI Wilayah III

                </div>


            </div>

        </div>

    </footer>

    <!-- Modal Konfirmasi Hapus -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus item <span id="itemName"></span>?
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
            $('#datatabel').DataTable();
            // Menangani tombol hapus
            $('#datatabel').on('click', '.delete-btn', function() {
                var itemId = $(this).data('id');
                var itemName = $(this).data('name');

                // Tampilkan nama item di dalam modal
                $('#itemName').text(itemName);

                // Set action untuk form hapus
                var actionUrl = '/adm/user/' + itemId;
                $('#deleteForm').attr('action', actionUrl);

                // Tampilkan modal
                $('#deleteModal').modal('show');
            });
        });
    </script>
@endpush
