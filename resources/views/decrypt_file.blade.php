@extends('layouts.apptailwind')

@section('title', 'Dekripsi File')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-50 pt-20">
    <form class="space-y-4 bg-white text-gray-900 px-8 py-12 w-full max-w-md mx-auto shadow-2xl shadow-[#e91e6254] rounded-2xl" action="{{ route('decrypt.process') }}" method="POST">
        @csrf
        <h2 class="text-3xl font-bold text-center mb-8">Dekripsi File</h2>
        
        @if (session('error'))
            <div class="mb-4 p-4 bg-red-100 text-red-700 border border-red-400 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 border border-green-400 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <input type="hidden" name="file_path" value="{{ request('file_path') }}">
        <input type="hidden" name="model_id" value="{{ request('model_id') }}">
        <input type="hidden" name="model_type" value="{{ request('model_type') }}">
        
        <div class="form-group">
            <label class="block mb-2 text-sm font-medium text-gray-900">Password Enkripsi File</label>
            <input class="bg-gray-100 text-gray-900 text-sm rounded-lg outline-none focus:ring-[#fa87ad] focus:border-[#fa87ad] block w-full px-2.5 py-4" type="password" name="password_file" required placeholder="Masukkan password dekripsi">
        </div>

        <button type="submit" class="w-full text-white bg-[#fa87ad] hover:bg-[#e07598] font-medium rounded-lg text-sm px-5 py-4 text-center cursor-pointer">
            Dekripsi & Download
        </button>
    </form>
</div>
@endsection
