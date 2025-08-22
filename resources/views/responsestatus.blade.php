@extends('layouts.apptailwind')

@section('title', 'Status Laporan')

@section('content')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <div class="min-h-screen bg-white pt-[165px]">
        <div class="px-7">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <h5 class="font-medium">Kode Laporan :</h5>
                    <p>{{ $first->kode_laporan }}</p>
                </div>
                <div>
                    <h5 class="font-medium">Nama :</h5>
                    <p>{{ Illuminate\Support\Facades\Crypt::decryptString($first->nama) }}</p>
                </div>
                <div>
                    <h5 class="font-medium">Jenis Kelamin :</h5>
                    <p>{{ Illuminate\Support\Facades\Crypt::decryptString($first->jenis_kelamin) }}</p>
                </div>
                <div>
                    <h5 class="font-medium">Email :</h5>
                    <p>{{ Illuminate\Support\Facades\Crypt::decryptString($first->email) }}</p>
                </div>
                <div>
                    <h5 class="font-medium">No Hp :</h5>
                    <p>{{ Illuminate\Support\Facades\Crypt::decryptString($first->no_hp) }}</p>
                </div>
                <div>
                    <h5 class="font-medium">Tanggal Kejadian :</h5>
                    @if ($first->tanggal_kejadian)
                    @php
                        $as = Illuminate\Support\Facades\Crypt::decryptString($first->tanggal_kejadian);
                    @endphp
                    <p>
                        {{ Carbon\Carbon::parse($as)->locale('id')->diffForHumans() }}
                    </p>
                    @endif
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 px-4 justify-center mt-8">
            <div
                class="bg-white p-6 max-w-3xl w-full rounded-2xl mb-10 transition-all duration-500 shadow-2xl shadow-[#e91e6254]">
                <h3 class="text-lg md:text-xl font-semibold text-center text-gray-800 mt-6">
                    Riwayat Status Laporan
                </h3>
                <div class="relative mt-8 md:mt-16">
                    <div class="border-l-4 border-gray-300 ml-4 pl-4">
                        @php
                            $urut = 1;
                            $warna = 'pink';
                        @endphp
                        @foreach ($logs as $data)
                            @php
                                if ($urut > 1) {
                                    $warna = 'gray';
                                }
                            @endphp
                            <div class="mb-6 md:mb-8 flex items-start pt-2">
                                <div
                                    class="w-5 h-5 md:w-6 md:h-6 rounded-full flex-shrink-0 flex items-center justify-center bg-{{ $warna }}-500">
                                    <div class="w-2 h-2 md:w-3 md:h-3 rounded-full bg-white"></div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-{{ $warna }}-500 font-semibold text-sm md:text-md leading-tight"
                                        style="margin-bottom: 10px;">
                                        {{ Illuminate\Support\Facades\Crypt::decryptString($data->status_laporan) }}
                                    </p>
                                    <p class="text-{{ $warna }}-500 font-semibold text-sm md:text-md leading-tight"
                                        style="margin-bottom: 10px;">
                                        {{ Illuminate\Support\Facades\Crypt::decryptString($data->deskripsi_laporan) }}
                                    </p>
                                    <p class="text-xs md:text-sm text-gray-500" style="margin-bottom: 10px;">Tanggal Proses
                                        {{ date('d, F Y', strtotime($data->tanggal_diubah)) }}</p>
                                    <p class="text-xs md:text-sm text-gray-500">
                                        Batas Proses
                                        @if ($data->tgl_batas_proses)
                                            {{ date('d, F Y', strtotime($data->tgl_batas_proses)) }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                            @php $urut++; @endphp
                        @endforeach
                    </div>
                </div>
            </div>
            @php
                $sta = Illuminate\Support\Facades\Crypt::decryptString($first->status_laporan)
            @endphp
            @if ($sta == "Ditolak")
                @elseif ($sta == "Selesai")
                @else
                <form method="POST" action="{{ url('kirim_chat') }}"
                class="space-y-4 max-w-4xl w-full bg-white text-gray-900 px-8 py-12 my-10 mx-auto shadow-2xl shadow-[#e91e6254] rounded-2xl">
                @csrf
                <h3 class="text-lg md:text-xl font-semibold text-center text-gray-800">
                    Chat Ke Admin
                </h3>
                <div class="space-y-4 max-h-[500px] overflow-y-auto">
                    @foreach ($chat as $row)
                        @if ($row->status == 'Admin')
                            <div class="flex justify-start">
                                <div class="bg-gray-300  text-white p-4 rounded-lg max-w-full">
                                    <p class="text-sm" style="color: black;font-size: 18px">{!! $row->pesan !!}</p>
                                    <small style="color: black">{{ date("d, F Y H:i",strtotime($row->created_at)) }}</small>
                                </div>
                            </div>
                        @else
                            <div class="flex justify-end">
                                <div class="text-gray-900 bg-blue-500 p-4 rounded-lg max-w-full" style="max-width:  80%">
                                    <p class="text-sm" style="color: white;font-size: 18px">{!! $row->pesan !!}</p>
                                    <small style="color: white">{{ date("d, F Y H:i",strtotime($row->created_at)) }}</small>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <input type="hidden" required class="" value="{{ $ids }}" name="id">
                @error('id')
                    <small>{{ $message }}</small>
                @enderror
                <div class="mt-6 flex items-center">
                    <textarea required name="pesan"
                        class="w-full p-3 border rounded-lg border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Ketik pesan...">{{ old('pesan') }}</textarea>
                    <button class="ml-4 bg-blue-500 text-white p-3 rounded-lg" type="submit">
                        <i class="fa-solid fa-paper-plane"></i>
                    </button>
                </div>
                @error('pesan')
                    <small>{{ $message }}</small>
                @enderror
            </form>
            @endif
        </div>
    </div>
@endsection