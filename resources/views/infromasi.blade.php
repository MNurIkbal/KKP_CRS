@extends('layouts.apptailwind')



@section('title', 'Form Laporan SWYC & Satgas PPK')



@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <div>
        <br>
        <br>
        <br>

        <div class="flex items-start justify-center min-h-screen bg-gray-50 pt-10">
            <div class="space-y-4 max-w-6xl bg-white text-gray-900 px-8 py-12 my-10 mx-auto shadow-2xl shadow-[#e91e6254] rounded-2xl"
                style="width: 100% !important">



                <h2 class="text-3xl font-bold text-center mb-8">Informasi</h2>
                <br>


                <div style="">
                    {!! $set->informasi !!}
                </div>
            </div>

        </div>

        <div class="max-w-6xl bg-white text-gray-900 px-8 py-12 my-10 mx-auto shadow-2xl shadow-[#e91e6254] rounded-2xl">
            <h2 class="text-3xl font-bold text-center mb-8">FAQ</h2>
            <div class="w-full">
                <div class="border border-gray-200 divide-y divide-gray-200 rounded-lg">
                    @foreach ($faq as $item)
                        <details class="group" onclick="closeOthers(this)">
                            <summary class="flex justify-between items-center p-4 cursor-pointer bg-gray-100 transition-all duration-300 ease-in-out">
                                <span class="font-medium">{{ $item->judul }}</span>
                                <svg class="w-5 h-5 text-gray-500 group-open:rotate-180 transition-transform duration-300 ease-in-out"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.23 7.21a.75.75 0 011.06.02L10 11.06l3.71-3.83a.75.75 0 011.08 1.04l-4.24 4.38a.75.75 0 01-1.08 0L5.23 8.25a.75.75 0 01.02-1.06z"
                                        clip-rule="evenodd" />
                                </svg>
                            </summary>
                            <div class="p-4 text-gray-600 transition-all duration-300 ease-in-out max-h-0 overflow-hidden group-open:max-h-40">
                                {{ $item->deskripsi }}
                            </div>
                        </details>
                    @endforeach
                </div>
            </div>
        </div>
        
        <script>
            function closeOthers(selected) {
                document.querySelectorAll("details").forEach(detail => {
                    if (detail !== selected) {
                        detail.removeAttribute("open");
                    }
                });
            }
        </script>
        



    </div>

@endsection
