@extends('layouts.Admin.adm')

@section('content')
    <div id="content" class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                @include('layouts.Admin.breadcrumbs')
                <div class="row">

                    <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing layout-top-spacing">
                        <form class="card" method="POST" action="{{ url('adm/tambah_gabung_laporan') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div >
                                <div class="card-body row g-3">
                                    <h5 id="pages_title">Tambah Gabungan Laporan
                                    </h5>
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        @include('components.alert')
                                    </div>
                                    <div class="col-lg-12 col-12 layout-spacing layout-top-spacing">
                                        <div id="borderTopContent">
                                            <div class="row g-3">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="input-placeholder">Judul <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" required class="form-control"
                                                            placeholder="Nama" id="" name="nama"
                                                            value="{{ old('nama') }}">
                                                        @error('nama')
                                                            <small>{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="input-placeholder">Status <span class="text-danger">*</span>
                                                        </label>
                                                        <select name="status" class="form-control pelapors" required
                                                            id="" style="width: 100% !important">
                                                            <option value="">Pilih</option>
                                                            @foreach ($status as $raw)
                                                                <option value="{{ $raw->status }}">{{ $raw->status }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('status')
                                                            <small>{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="input-placeholder">Laporan <span class="text-danger">*</span>
                                                        </label>
                                                        <select id="input-placeholder" class="form-control select2"
                                                            name="laporan[]" required multiple
                                                            style="width: 100% !important">
                                                            <option value="" disabled>Pilih Laporan</option>
                                                            @foreach ($laporanselesai as $rows)
                                                                <option value="{{ $rows->id }}">
                                                                    {{ Illuminate\Support\Facades\Crypt::decryptString($rows->nama) }}
                                                                    | {{ $rows->universitasRel->nama }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('laporan')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>

                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="input-placeholder">Deskripsi <span class="text-danger">*</span>
                                                        </label>
                                                        <textarea name="deskripsi" class="form-control" required id="" cols="30" rows="5"></textarea>
                                                        @error('nama')
                                                            <small>{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3">
                                    <footer style="margin-left: 20px;">
                                        <a href="{{ \Illuminate\Support\Facades\URL::previous() }}"
                                            class="btn btn-w-lg btn-light" type="reset">Batal</a>
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
        <!-- Tambahkan di bagian <head> untuk CSS -->
        <!-- Tambahkan di bagian <head> untuk CSS -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

        <!-- Tambahkan jQuery terlebih dahulu -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Kemudian tambahkan select2 JS -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

        <!-- Inisialisasi Select2 -->
        <script>
            $('#input-placeholder').select2();
        </script>


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
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $('.pelapors').select2();
        </script>
    @endsection

    @push('css')
    @endpush
