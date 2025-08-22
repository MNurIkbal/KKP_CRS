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
                                    <h4 id="pages_title">Data Log Aktifitas</h4>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id='datatabel' class="table table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Pesan</th>
                                    <th>Status</th>
                                    <th>Dibuat</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($result as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->pesan }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                            <a href="{{ url('adm/hapus_log/' . $item->id) }}" class="btn btn-danger " title="Hapus"><i class="far fa-trash-alt">
                                                </i></a>
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
