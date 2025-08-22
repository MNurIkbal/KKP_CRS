@extends('layouts.apptailwind')



@section('title', 'Form Laporan SWYC & Satgas PPK')



@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

        <br>
        <br>
        <br>
    <div>

        <div class="flex items-start justify-center min-h-screen bg-gray-50 pt-10">
            <form
                class="space-y-4 max-w-6xl bg-white text-gray-900 px-8 py-12 my-10 mx-auto shadow-2xl shadow-[#e91e6254] rounded-2xl"
                action="{{ url('kirim_kontak') }}" method="post" enctype="multipart/form-data" style="width: 100% !important">

                @csrf

                <h2 class="text-3xl font-bold text-center mb-8">Kontak Kami</h2>

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-700 border border-red-400 rounded-lg">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session()->get('success'))
                    <div class="bg-green-100 text-green-800 border border-green-400 rounded-lg p-4 mb-4">
                        {{ session()->get('success') }}
                    </div>
                @endif
                <style>
                    iframe {
                        width: 100% !important;
                    }
                </style>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        {!! $set->maps !!}
                    </div>
                    <div>
                        <a href="https://wa.me/{{ $set->no_wa }}">
                            <div class="flex items-center space-x-2">
                                <i class="fab fa-whatsapp" style="font-weight: bold"></i>
                                <p>{{ $set->no_wa }}</p>
                            </div>
                        </a>
                        <br>
                        <a href="{{ $set->ig }}" target="_blank">
                            <div class="flex items-center space-x-2">
                                <i class="fab fa-instagram" style="font-weight: bold"></i>
                                <p>Swyc Budi Luhur</p>
                            </div>
                        </a>
                        <br>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-envelope"></i>
                            <p>{{ $set->email }}</p>
                        </div>
                        <br>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-location-dot"></i>
                            <p>{{ $set->alamat }}</p>
                        </div>
                    </div>
                </div>
                <br>
                <div class="container">
                    <h2 class="text-2xl font-bold ">Masukan Dan Saran Anda</h2>
                    <br>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="satu">
                            <div class="w-full">

                                <label for="text-field" class="block mb-2 text-sm font-medium text-gray-900">Nama Lengkap
                                    <span class="text-red-500">*</span>

                                </label>

                                <input
                                    class="bg-gray-100 text-gray-900 text-sm rounded-lg outline-none focus:ring-[#fa87ad] focus:border-[#fa87ad] block w-full px-2.5 py-4"
                                    type="text" name="nama" placeholder="Masukkan nama" required=""
                                    value="{{ old('nama') }}">

                                @error('nama')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror

                            </div>

                        </div>
                        <div>
                            <div class="w-full">

                                <label for="text-field" class="block mb-2 text-sm font-medium text-gray-900">Email
                                    <span class="text-red-500">*</span>

                                </label>

                                <input
                                    class="bg-gray-100 text-gray-900 text-sm rounded-lg outline-none focus:ring-[#fa87ad] focus:border-[#fa87ad] block w-full px-2.5 py-4"
                                    type="text" name="email" placeholder="Masukkan Email" required=""
                                    value="{{ old('email') }}">

                                @error('email')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror

                            </div>
                        </div>

                    </div>
                    <br>
                    <div class="w-full">

                        <label for="text-field" class="block mb-2 text-sm font-medium text-gray-900">Subjek
                            <span class="text-red-500">*</span>

                        </label>

                        <input
                            class="bg-gray-100 text-gray-900 text-sm rounded-lg outline-none focus:ring-[#fa87ad] focus:border-[#fa87ad] block w-full px-2.5 py-4"
                            type="text" name="subjek" placeholder="Masukkan Subjek " required=""
                            value="{{ old('subjek') }}">

                        @error('subjek')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror

                    </div>
                    <br>
                    <div class="w-full">

                        <label for="text-field" class="block mb-2 text-sm font-medium text-gray-900">Pesan
                            <span class="text-red-500">*</span>

                        </label>

                        <textarea
                            class="bg-gray-100 text-gray-900 text-sm rounded-lg outline-none focus:ring-[#fa87ad] focus:border-[#fa87ad] block w-full px-2.5 py-4"
                            cols="10" rows="10" type="text" name="pesan" placeholder="Masukkan Pesan " required="">{{ old('pesan') }}</textarea>

                        @error('pesan')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror

                    </div>
                    <br>
                    <div class="form-group mb-3 row">
                        <div class="col-12">

                            {!! NoCaptcha::renderJs() !!}

                            {!! NoCaptcha::display() !!}

                        </div>

                    </div>


                </div>
                <button type="submit"
                    class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-[#f84480] hover:bg-[#ff256e] focus:ring-4 focus:ring-blue-30 ">Kirim</button>
            </form>
        </div>


    </div>

@endsection
