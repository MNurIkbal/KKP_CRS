@extends('layouts.apptailwind')



@section('title', 'Status Laporan')



@section('content')

    <div class="min-h-screen flex flex-col pt-[165px] items-center bg-white">

    <div class="w-full px-4 flex items-center justify-center">

        <form class="space-y-8 max-w-3xl w-full bg-white flex flex-col text-gray-900 justify-center px-4 py-8 md:px-8 md:py-12 shadow-2xl shadow-[#e91e6254] rounded-2xl" method="get" action="{{route('cekstatus')}}">

          {{-- @csrf --}}

            <h2 class="text-2xl md:text-3xl font-bold text-center mb-6">Cek Status Laporan</h2>

            @if (session('error'))

    <div class="bg-red-500 text-white px-4 py-3 rounded-md text-center shadow-2xl shadow-[#e91e6254]">

        {{ session('error') }}

    </div>

    @endif





            <div>

                <div class="w-full">

                    <label for="text-field" class="block mb-2 text-sm font-medium text-gray-900">

                        ID Laporan <span class="text-red-500">*</span>

                    </label>

                    <input 

                        class="bg-gray-100 text-gray-900 text-sm rounded-lg outline-none focus:ring-[#fa87ad] focus:border-[#fa87ad] block w-full px-2.5 py-4" name="id" id="id"

                        type="text" 

                        placeholder="Masukkan ID Laporan" 

                        value="" required 

                    >

                </div>

            </div>
            <div class="form-group mb-3 row">



                <div class="col-12">

                    {!! NoCaptcha::renderJs() !!}

                    {!! NoCaptcha::display() !!}

                </div>

            </div>




            <div class="flex justify-center mt-4 space-x-2 md:space-x-4">

                <a 

                    class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-[#adadad] hover:bg-[#838383] focus:ring-4 focus:ring-gray-300 transition duration-300 ease-in-out" 

                    href="/"

                >

                    Kembali

                </a>



                <button 

                    class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-[#f84480] hover:bg-[#ff256e] focus:ring-4 focus:ring-blue-30"

                >

                    Cek

                </button>

            </div>

        </form>

    </div>

</div>

  @isset($logs)

  @if($logs->isNotEmpty())

<div class="w-full px-4 flex justify-center mt-8">

    <div class="bg-white p-6 max-w-3xl w-full rounded-2xl mb-10 transition-all duration-500 shadow-2xl shadow-[#e91e6254]">

        <h3 class="text-lg md:text-xl font-semibold text-center text-gray-800 mt-6">

            Riwayat Status Laporan

        </h3>



        <div class="relative mt-8 md:mt-16">

            <div class="border-l-4 border-gray-300 ml-4 pl-4">

              @php $urut = 1; $warna="pink";@endphp

              @foreach($logs as $data)

              @php if($urut>1) $warna="gray"; ?>



                <div class="mb-6 md:mb-8 flex items-start pt-2">

                    <div class="w-5 h-5 md:w-6 md:h-6 rounded-full flex-shrink-0 flex items-center justify-center bg-{{$warna}}-500">

                        <div class="w-2 h-2 md:w-3 md:h-3 rounded-full bg-white"></div>

                    </div>

                    <div class="ml-4">

                        <p class="text-xs md:text-sm text-gray-500 mb-1">Tanggal {{$data->tanggal_diubah}}</p>

                        <p class="text-{{$warna}}-500 font-semibold text-sm md:text-md leading-tight">

                            {{$data->deskripsi_laporan}}

                        </p>

                         <p class="text-{{$warna}}-500 font-semibold text-sm md:text-md leading-tight">

                        Batas Proses {{$data->tanggal_batas_proses}}

                      </p>

                    </div>

                </div>

                @php $urut++; @endphp

                @endforeach



            </div>

        </div>

    </div>

</div>



@endif

@endif



@endsection

