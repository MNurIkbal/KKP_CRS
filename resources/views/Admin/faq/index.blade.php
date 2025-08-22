@extends('layouts.Admin.adm')
@section('content')
    <div id="content" class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                @include('components.alert')
                            </div>
                            <div class="d-flex " style="justify-content: space-between;margin-bottom: 20px;">
                                <div>
                                    <h4 id="pages_title">FAQ</h4>
                                </div>
                                <div>
                                    <a class="btn btn-w-lg btn-primary" href="#" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">Tambah Data</a>
                                </div>
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <form method="POST" enctype="multipart/form-data" action="{{ url('adm/tambah_faq') }}"
                                        class="modal-dialog modal-xl">
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Tambah FAQ</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="">Judul <span class="text-red-500">*</span>
</label>
                                                    <input type="text" class="form-control" required placeholder="Judul"
                                                        name="judul" value="{{ old('judul') }}">
                                                    @error('judul')
                                                        <small>{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="">Deskripsi <span class="text-red-500">*</span>
</label>
                                                    <textarea name="deskripsi" class="form-control" required placeholder="Deskripsi" id="" cols="30"
                                                        rows="10">{{ old('deskripsi') }}</textarea>
                                                    @error('deskripsi')
                                                        <small>{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <table id='datatabel' class="table table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Deskripsi</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($faq as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->judul }}</td>
                                        <td>{{ $data->deskripsi }}</td>
                                        <td>
                                            <a class="" href="#"><button type="button"
                                                    class="btn btn-warning  "  data-bs-toggle="modal"
                                                    data-bs-target="#edit{{ $data->id }}"><i class="fas fa-edit"></i></button></a>&nbsp;

                                            <form method="POST" action="{{ url('adm/hapus_faq') }}" class="d-inline-block">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $data->id }}">
                                                <input name="_method" type="hidden" value="DELETE">
                                                <button type="submit" class="btn btn-danger  show_confirm "> <i
                                                        class="far fa-trash-alt"> </i></button>
                                            </form>
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
    @foreach ($faq as $rr)
        <div class="modal fade" id="edit{{ $rr->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <form method="POST" enctype="multipart/form-data" action="{{ url('adm/update_faq') }}"
                class="modal-dialog modal-xl">
                @csrf
                <div class="modal-content">
                    @method("PUT")
                    <input type="hidden" name="id" value="{{ $rr->id }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit FAQ</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="">Judul <span class="text-red-500">*</span>
</label>
                            <input type="text" class="form-control" required placeholder="Judul" name="judul"
                                value="{{ $rr->judul }}">
                            @error('judul')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="">Deskripsi <span class="text-red-500">*</span>
</label>
                            <textarea name="deskripsi" class="form-control" required placeholder="Deskripsi" id="" cols="30"
                                rows="10">{{ $rr->deskripsi }}</textarea>
                            @error('deskripsi')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    @endforeach
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
