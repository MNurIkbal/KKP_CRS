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
                            <div style="justify-content: space-between;margin-bottom: 20px;" class="d-flex">
                                <div>
                                    <h4 id="pages_title">Template Status</h4>
                                </div>
                                <div>
                                    <a class="btn btn-w-lg btn-primary" href="{{ route('template.create') }}">Tambah
                                        Data</a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id='datatabel' class="table table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Status</th>
                                    <th>Deskripsi</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($template as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->status }}</td>
                                        <td>{{ $data->deskripsi_status }}</td>
                                        <td>
                                            <a class=""href="{{ route('template.edit', ['template' => $data->id]) }}"><button
                                                    type="button" class="btn btn-warning  "><i
                                                        class="fas fa-edit"></i></button></a>&nbsp;
                                            @if (!in_array($data->status, ['Selesai',
                                                                    'Laporan Di Tinjau Ulang',
                                                                    'Sedang diverifikasi',
                                                                    'Laporan tidak sesuai dengan tindak kekerasan',]))
                                                <form method="POST" action="{{ route('template.destroy', $data->id) }}"
                                                    class="d-inline-block">
                                                    @csrf
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    <button type="submit" class="btn btn-danger  show_confirm "> <i
                                                            class="far fa-trash-alt"> </i></button>
                                                </form>
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
