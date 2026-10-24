@extends('layouts.apptailwind')

@section('title', 'Dekripsi File')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-slate-50 pt-24 pb-16 px-4">
    <div class="w-full max-w-lg bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">
        <!-- Header Banner -->
        <div class="bg-gradient-to-r from-indigo-600 via-indigo-700 to-purple-700 px-8 py-8 text-white text-center relative overflow-hidden">
            <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>
            <div class="w-16 h-16 bg-white/10 backdrop-blur-md rounded-2xl flex items-center justify-center mx-auto mb-4 border border-white/20 shadow-inner">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
            </div>
            <h2 class="text-2xl font-bold tracking-tight">Dekripsi Dokumen CRS</h2>
            <p class="text-indigo-100 text-xs mt-1 font-medium">Buka Berkas Aman yang Terenkripsi dengan Standar AES-256</p>
        </div>

        <!-- Form Body -->
        <form class="p-8 space-y-6" action="{{ route('decrypt.process') }}" method="POST">
            @csrf
            
            @if (session('error'))
                <div class="p-4 bg-red-50 text-red-700 border border-red-200 rounded-2xl text-sm flex items-start space-x-3">
                    <svg class="w-5 h-5 text-red-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @if (session('success'))
                <div class="p-4 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-2xl text-sm flex items-start space-x-3">
                    <svg class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- Info Keamanan Dokumen -->
            <div class="p-4 bg-slate-50 rounded-2xl border border-slate-200/80 space-y-2">
                <div class="flex items-center space-x-2 text-xs font-semibold text-slate-700">
                    <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    <span>Keamanan Berkas Rahasia</span>
                </div>
                <p class="text-xs text-slate-500 leading-relaxed">
                    Berkas ini dilindungi enkripsi AES-256. Masukkan password enkripsi dokumen yang dibuat saat pelaporan untuk mengunduh dan membaca berkas asli.
                </p>
            </div>

            <input type="hidden" name="file_path" value="{{ request('file_path') }}">
            <input type="hidden" name="model_id" value="{{ request('model_id') }}">
            <input type="hidden" name="model_type" value="{{ request('model_type') }}">
            
            <div class="space-y-2">
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Password Enkripsi Berkas <span class="text-rose-500">*</span></label>
                <div class="relative">
                    <input class="bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:bg-white block w-full pl-4 pr-11 py-3.5 outline-none transition-all" 
                        type="password" 
                        name="password_file" 
                        id="passFileDecrypt"
                        required 
                        placeholder="Ketik password enkripsi file...">
                    <button type="button" onclick="togglePassVisibility()" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 focus:outline-none">
                        <svg id="eyeIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </button>
                </div>
            </div>

            <button type="submit" class="w-full text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 font-semibold rounded-xl text-sm px-6 py-4 text-center cursor-pointer shadow-lg shadow-indigo-500/25 transition-all duration-200 flex items-center justify-center space-x-2">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                </svg>
                <span>Dekripsi & Download Berkas Asli</span>
            </button>
        </form>
    </div>
</div>

<script>
    function togglePassVisibility() {
        const input = document.getElementById('passFileDecrypt');
        const icon = document.getElementById('eyeIcon');
        if (input.type === 'password') {
            input.type = 'text';
            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/>';
        } else {
            input.type = 'password';
            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>';
        }
    }
</script>
@endsection
