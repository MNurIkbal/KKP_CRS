
<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Layanan Pengaduan CRS Satgas PPKPT LLDIKTI wilayah III')</title>

    <!-- Tailwind CSS -->

    <script src="https://cdn.tailwindcss.com"></script>

    @yield('css')



</head>

<body class="font-sans antialiased">
    <div id="root">
        <div>
            <div class="flex flex-col ml-0 transition-all duration-300 flex-1" >
                <nav class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 bg-white">
                    <div class="container mx-auto flex justify-between items-center p-4 sm:px-6 w-full max-w-screen-xl">
                        <div class="text-lg font-semibold flex items-center">
                            <a class="text-gray-800 flex items-center" href="/">
                                <img src="{{ asset('img/Logo-ADIA.png') }}" alt="Logo BL" class="w-12 h-12 mr-2" style="width: 80px;height: 80px;">
                            </a>
                        </div>
                        <div class="md:hidden">
                            <button id="menu-btn" class="focus:outline-none text-gray-800">
                                <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                        d="M5 7h14M5 12h14M5 17h10"></path>
                                </svg>
                            </button>
                        </div>
                        @php
                            $set = App\Models\PengaturanModel::orderby('id','DESC')->first();
                        @endphp
                        <div class="hidden md:flex space-x-6">
                            <a class="text-gray-800 hover:bg-gray-200 rounded-lg px-4 py-2 text-sm font-medium"
                                href="{{ url('/') }}">Beranda</a>
                            <a class="text-gray-800 hover:bg-gray-200 rounded-lg px-4 py-2 text-sm font-medium"
                                href="{{ url('/laporan/form') }}">Buat Laporan</a>
                            <a class="text-gray-800 hover:bg-gray-200 rounded-lg px-4 py-2 text-sm font-medium"
                                href="{{ url('/laporan/status') }}">Cek Status Laporan</a>
                            <a class="text-gray-800 hover:bg-gray-200 rounded-lg px-4 py-2 text-sm font-medium"
                                href="{{ url('informasi') }}">Informasi</a>
                            <a class="text-gray-800 hover:bg-gray-200 rounded-lg px-4 py-2 text-sm font-medium"
                                href="{{ asset($set->manual_book) }}" target="_blank">Buku Panduan</a>
                            <a class="text-gray-800 hover:bg-gray-200 rounded-lg px-4 py-2 text-sm font-medium"
                                href="{{ url('kontak') }}">Kontak</a>
                        </div>
                    </div>
                    <div id="overlay" class="hidden fixed inset-0 bg-black bg-opacity-50"></div>
                    <div id="mobile-menu"
                        class="hidden fixed top-0 left-0 w-3/4 h-full bg-white shadow-md p-4 md:hidden z-50">
                        <button id="close-menu" class="absolute top-2 right-2 text-gray-800 focus:outline-none">
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                        <a class="block text-gray-800 hover:bg-gray-200 px-4 py-2 text-sm font-medium rounded-md"
                            href="{{ url('/') }}">Beranda</a>
                        <a class="block text-gray-800 hover:bg-gray-200 px-4 py-2 text-sm font-medium rounded-md"
                            href="{{ url('/laporan/form') }}">Buat Laporan</a>
                        <a class="block text-gray-800 hover:bg-gray-200 px-4 py-2 text-sm font-medium rounded-md mt-2"
                            href="{{ url('/laporan/status') }}">Cek Status Laporan</a>
                        <a class="block text-gray-800 hover:bg-gray-200 px-4 py-2 text-sm font-medium rounded-md mt-2"
                            href="{{ url('informasi') }}">Informasi</a>
                        <a class="block text-gray-800 hover:bg-gray-200 px-4 py-2 text-sm font-medium rounded-md mt-2"
                            href="{{ asset($set->manual_book) }}" target="_blank">Buku Panduan</a>
                        <a class="block text-gray-800 hover:bg-gray-200 px-4 py-2 text-sm font-medium rounded-md mt-2"
                            href="{{ url('kontak') }}">Kontak</a>
                    </div>
                </nav>

            </div>

            <script>
                document.getElementById('menu-btn').addEventListener('click', function() {
                    document.getElementById('mobile-menu').classList.toggle('hidden');
                    document.getElementById('overlay').classList.toggle('hidden');
                });
                document.getElementById('overlay').addEventListener('click', function() {
                    document.getElementById('mobile-menu').classList.add('hidden');
                    this.classList.add('hidden');
                });
                document.getElementById('close-menu').addEventListener('click', function() {
                    document.getElementById('mobile-menu').classList.add('hidden');
                    document.getElementById('overlay').classList.add('hidden');
                });
            </script>

            @yield('content')



            <footer class="bg-gray-900 px-4 sm:px-6 lg:px-12">

                <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">

                    <div class="md:flex md:justify-between">

                        <div class="mb-6 md:mb-0">

                            <a href="#" class="flex items-center">

                                <div class="text-lg font-semibold flex items-center"></div>

                                <span
                                    class="self-center text-2xl font-semibold whitespace-nowrap text-white mr-40">Satgas
                                    PPKS LLDIKTI Wilayah III</span>

                            </a>

                        </div>



                        <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">

                            <div>

                                <h2 class="mb-6 text-sm font-semibold uppercase text-white">Lokasi</h2>

                                <ul class=" text-gray-400 font-medium">

                                    <li class="mb-4">{{ $set->alamat }}</li>

                                </ul>

                            </div>

                            <div>

                                <h2 class="mb-6 text-sm font-semibold uppercase text-white">Ikuti Kami</h2>

                                <ul class=" text-gray-400 font-medium">

                                    <li class="mb-4">

                                        <a href="{{ $set->ig }}"
                                            class="hover:underline "> Instagram</a>

                                    </li>

                                </ul>

                            </div>

                            <div>

                                <h2 class="mb-6 text-sm font-semibold uppercase text-white">Legal</h2>

                                <ul class=" text-gray-400 font-medium">

                                    <li class="mb-4">

                                        <a href="#" class="hover:underline">Kebijakan Privasi</a>

                                    </li>

                                    <li>

                                        <a href="#" class="hover:underline">Syarat &amp; Ketentuan</a>

                                    </li>

                                </ul>

                            </div>

                        </div>

                    </div>

                    <hr class="my-6 sm:mx-auto border-gray-700 lg:my-8">

                    <div class="sm:flex sm:items-center sm:justify-between">

                        <span class="text-sm sm:text-center text-gray-400">© 2025

                            <a href="#" class="hover:underline">CRS Satgas PPKPT LLDIKTI wilayah III</a>.

                            All Rights Reserved. Developed by Universitas Budi Luhur</span>

                        <div class="flex mt-4 sm:justify-center sm:mt-0">

                            <a href="https://wa.me/{{ $set->no_wa }}" class="text-gray-500 hover:text-white">

                                <svg width="20px" height="20px" viewBox="0 0 448 512" fill="currentColor"
                                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">

                                    <path
                                        d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z">
                                    </path>

                                </svg>

                                <span class="sr-only">Whatsapp</span>

                            </a>

                            <a href="https://www.instagram.com/swyc_budiluhur/"
                                class="text-gray-500 hover:text-white ms-5">

                                <svg width="16px" height="16px" viewBox="0 0 24 24" fill="currentColor"
                                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">

                                    <path
                                        d="M12 2.163c3.204 0 3.584.012 4.85.07 1.17.055 1.96.24 2.417.513a4.92 4.92 0 0 1 1.804 1.805c.274.457.457 1.246.514 2.417.058 1.267.07 1.647.07 4.851 0 3.204-.012 3.584-.07 4.85-.055 1.17-.24 1.96-.513 2.417a4.92 4.92 0 0 1-1.805 1.804c-.457.274-1.246.457-2.417.514-1.267.058-1.647.07-4.851.07-3.204 0-3.584-.012-4.85-.07-1.17-.055-1.96-.24-2.417-.513a4.92 4.92 0 0 1-1.804-1.805c-.274-.457-.457-1.246-.514-2.417-.058-1.267-.07-1.647-.07-4.851 0-3.204.012-3.584.07-4.85.055-1.17.24-1.96.513-2.417a4.92 4.92 0 0 1 1.805-1.804c.457-.274 1.246-.457 2.417-.514C8.416 2.175 8.796 2.163 12 2.163zm0-2.163C8.688 0 8.273.014 7.052.072 5.838.129 4.864.322 4.06.709c-.877.399-1.613.934-2.342 1.664A7.643 7.643 0 0 0 .71 4.06C.322 4.864.129 5.838.072 7.052.014 8.273 0 8.688 0 12c0 3.313.014 3.727.072 4.948.057 1.214.25 2.188.638 2.992.399.877.934 1.613 1.664 2.342.729.729 1.465 1.264 2.342 1.664.804.387 1.778.58 2.992.638 1.221.058 1.635.072 4.948.072 3.313 0 3.727-.014 4.948-.072 1.214-.057 2.188-.25 2.992-.638.877-.399 1.613-.934 2.342-1.664.729-.729 1.264-1.465 1.664-2.342.387-.804.58-1.778.638-2.992.058-1.221.072-1.635.072-4.948 0-3.313-.014-3.727-.072-4.948-.057-1.214-.25-2.188-.638-2.992-.399-.877-.934-1.613-1.664-2.342-.729-.729-1.465-1.264-2.342-1.664-.804-.387-1.778-.58-2.992-.638C15.727.014 15.313 0 12 0zm0 5.838a6.163 6.163 0 1 0 0 12.326 6.163 6.163 0 0 0 0-12.326zm0 10.163a3.999 3.999 0 1 1 0-7.998 3.999 3.999 0 0 1 0 7.998zm6.406-11.845a1.44 1.44 0 1 1 0-2.88 1.44 1.44 0 0 1 0 2.88z">
                                    </path>

                                </svg>

                                <span class="sr-only">Instagram</span>

                            </a>

                        </div>

                    </div>

                </div>

            </footer>

        </div>

    </div>

    @yield('js')



</body>

</html>
