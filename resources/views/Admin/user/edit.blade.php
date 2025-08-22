@extends('layouts.Admin.adm')
@section('content')
    <div id="content" class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                @include('layouts.Admin.breadcrumbs')
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing layout-top-spacing">
                        <form class="card" method="POST" action="{{ route('user.update', ['user' => $useredit]) }}">
                            @csrf
                            @method('PUT')
                            <div class="card">
                                <div class="card-body row g-3">
                                    <h5 id="pages_title">Edit User</h5>
                                    @include('components.alert')
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="input-placeholder">Nama <code>(Wajib diisi)</code></label>
                                            <input required name="name" type="text" class="form-control"
                                                value="{{ $useredit->name }}" id="nama">
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="select">Status  <code>(Wajib diisi)</code></label>
                                            <select name="status" required class="form-control" id="level" value="">
                                               <option value="">Pilih</option> 
                                                <option value="Aktif" @if ($useredit->status == "Aktif")
                                                    selected
                                                @endif>Aktif</option>
                                                <option @if ($useredit->status == "Tidak Aktif")
                                                    selected
                                                @endif value="Tidak Aktif">Tidak Aktif</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="input-placeholder">Email <code>(Wajib diisi)</code></label>
                                            <input required value="{{ $useredit->email }}" name="email" type="email"
                                                class="form-control" placeholder="Email@domain.com" id="email">
                                        </div>
                                        
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="input-placeholder">Password 
                                                <span class="ms-2" data-bs-toggle="tooltip" data-bs-placement="right"
                                                    title="(Minimal 8 karakter dan harus gabungan huruf besar, huruf kecil, angka, simbol)">
                                                    <i class="fas fa-question-circle"></i></span>
                                            </label>
                                            <input  type="password" name="password" class="form-control"
                                                placeholder="***********" id="pass1">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="input-placeholder">Konfirmasi Password</label>
                                            <input  type="password" name="password_confirmation"
                                                class="form-control" placeholder="***********" id="pass2">
                                        </div>
                                    </div>
                                </div>

                                <footer style="margin-left: 20px;margin-bottom: 20px;">
                                    <a href="{{ \Illuminate\Support\Facades\URL::previous() }}"
                                        class="btn btn-w-lg btn-secondary" type="reset">Batal</a>
                                    <button class="btn btn-w-lg btn-primary" type="submit">Simpan</button>
                                </footer>

                        </form>

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
        @endsection
