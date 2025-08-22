@extends('layouts.apptailwind')



@section('title', 'Status Laporan')



@section('content')

<div class="min-h-screen flex flex-col pt-[165px] items-center bg-white">
    <div class="bg-white p-10 rounded-3xl shadow-2xl shadow-[#e91e6254] text-center max-w-3xl transform transition-all duration-500 hover:scale-105"><div class="flex justify-center"><svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-green-500" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.707a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 10-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg></div><h2 class="text-3xl font-bold text-gray-800 mb-4">Terima kasih telah melapor!</h2><p class="text-lg text-gray-600">Kami telah mengirimkan ID Laporan Melalui Email<br><span class="font-bold">{{ maskEmail($email) }}</span> </p><p class="text-sm text-gray-500 mt-4">Pastikan untuk memeriksa folder spam jika email tidak muncul di kotak masuk utama Anda.</p></div>

</div>

@endsection

