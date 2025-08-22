@extends('layouts.Admin.adm')

@section('content')
    <div id="content" class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                @include('layouts.Admin.breadcrumbs')
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing layout-top-spacing">
                        <form class="card" method="POST" action="{{ route('template.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div >
                                <div class="card-body row g-3">
                                    <h5 id="pages_title">Tambah Template Status</h5>
                                    <div class="col-lg-12 col-12 layout-spacing layout-top-spacing">
                                        <div class="tab-content" id="borderTopContent">
                                            <div class="row g-3">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="input-placeholder">Judul Template <span class="text-red-500">*</span>
</label>
                                                        <input type="text" required class="form-control"
                                                            placeholder="Nama" id="input-placeholder" name="status"
                                                            value="{{ $template->status ?? old('status') }}">
                                                            @error('status')
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="input-placeholder">Deskripsi Status <span class="text-red-500">*</span>
</label>
                                                        <input type="text" required class="form-control"
                                                            placeholder="Nama" id="input-placeholder"
                                                            name="deskripsi_status"
                                                            value="{{ $template->deskripsi_status ?? old('deskripsi_status') }}">
                                                            @error('deskripsi_status')
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3">
                                    <footer style="margin-left: 20px;">
                                    <a href="{{\Illuminate\Support\Facades\URL::previous()}}" class="btn btn-w-lg btn-light"
                                       type="reset">Batal</a>
                                    <button class="btn btn-w-lg btn-primary" type="submit">Simpan</button>
                                </footer>
                                </div>
                                <br>
                            </div>
                    </div>
                </div>
            </div>


        </div>
        </form>
        <footer class="footer">

            <div class="container-fluid">
    
                <div class="row">
    
                    <div class="text-center">
    
                        <script>document.write(new Date().getFullYear())</script> © Aplikasi CRS LLDIKTI Wilayah III
    
                    </div>
    
    
                </div>
    
            </div>
    
        </footer>
    @endsection

    @push('css')
    @endpush
