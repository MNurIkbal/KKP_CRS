<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Layanan Pengaduan CRS Satgas PPKPT LLDIKTI wilayah III</title>
    <link rel="icon" href="{{ asset('img/Logo-ADIA.png') }}">

    <!-- Tailwind CSS -->

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* Custom Styles */
        .hero {
            background: url('https://via.placeholder.com/1920x600') no-repeat center center/cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
        }
    </style>



</head>

<body class="font-sans antialiased">
    
    <div id="root">
        <div>
            <div class="flex flex-col ml-0 transition-all duration-300 flex-1">
                <nav class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 bg-white">
                    <div class="container mx-auto flex justify-between items-center p-4 sm:px-6 w-full max-w-screen-xl">
                        <div class="text-lg font-semibold flex items-center">
                            <a class="text-gray-800 flex items-center" href="/">
                                <img src="https://ppks.wahyupramusinto.com/img/logoUBL.png" alt="Logo BL"
                                    class="w-12 h-12 mr-2">
                                <img src="https://ppks.wahyupramusinto.com/img/logosatgasppks.png" alt="Logo Satgas"
                                    class="w-12 h-12 mr-2">
                                <img src="https://ppks.wahyupramusinto.com/img/logoswyc.jpg" alt="Logo SWYC"
                                    class="w-12 h-12">
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
                        <div class="hidden md:flex space-x-6">
                            <a class="text-gray-800 hover:bg-gray-200 rounded-lg px-4 py-2 text-sm font-medium"
                                href="https://ppks.wahyupramusinto.com">Beranda</a>
                            <a class="text-gray-800 hover:bg-gray-200 rounded-lg px-4 py-2 text-sm font-medium"
                                href="https://ppks.wahyupramusinto.com/laporan/form">Buat Laporan</a>
                            <a class="text-gray-800 hover:bg-gray-200 rounded-lg px-4 py-2 text-sm font-medium"
                                href="https://ppks.wahyupramusinto.com/laporan/status">Cek Status Laporan</a>
                            <a class="text-gray-800 hover:bg-gray-200 rounded-lg px-4 py-2 text-sm font-medium"
                                href="https://ppks.wahyupramusinto.com/informasi">Informasi</a>
                            <a class="text-gray-800 hover:bg-gray-200 rounded-lg px-4 py-2 text-sm font-medium"
                                href="https://ppks.wahyupramusinto.com/uploads/folder_pengaturan/1741149783-Manual-Book-UP-Mobile-for-Parents-3.pdf"
                                target="_blank">Buku Panduan</a>
                            <a class="text-gray-800 hover:bg-gray-200 rounded-lg px-4 py-2 text-sm font-medium"
                                href="https://ppks.wahyupramusinto.com/kontak">Kontak</a>
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
                            href="https://ppks.wahyupramusinto.com">Beranda</a>
                        <a class="block text-gray-800 hover:bg-gray-200 px-4 py-2 text-sm font-medium rounded-md"
                            href="https://ppks.wahyupramusinto.com/laporan/form">Buat Laporan</a>
                        <a class="block text-gray-800 hover:bg-gray-200 px-4 py-2 text-sm font-medium rounded-md mt-2"
                            href="https://ppks.wahyupramusinto.com/laporan/status">Cek Status Laporan</a>
                        <a class="block text-gray-800 hover:bg-gray-200 px-4 py-2 text-sm font-medium rounded-md mt-2"
                            href="https://ppks.wahyupramusinto.com/informasi">Informasi</a>
                        <a class="block text-gray-800 hover:bg-gray-200 px-4 py-2 text-sm font-medium rounded-md mt-2"
                            href="https://ppks.wahyupramusinto.com/uploads/folder_pengaturan/1741149783-Manual-Book-UP-Mobile-for-Parents-3.pdf"
                            target="_blank">Buku Panduan</a>
                        <a class="block text-gray-800 hover:bg-gray-200 px-4 py-2 text-sm font-medium rounded-md mt-2"
                            href="https://ppks.wahyupramusinto.com/kontak">Kontak</a>
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

            <div>
                {{-- <div class="min-w-screen min-h-screen bg-white pt-24">
                    <section class="flex flex-col items-center justify-center py-4 px-4 lg:px-20">
                        <header class="text-center space-y-8 mb-12">
                            <h2 class="text-4xl md:text-5xl font-bold text-gray-800"
                                style="opacity: 1; will-change: auto; transform: none;">Layanan Pengaduan<br>Suhanah
                                Women and Youth Center (SWYC) <br> &amp; Satgas PPKS</h2>
                            <p class="text-gray-500 mt-4 text-base md:text-lg max-w-3xl mx-auto"
                                style="opacity: 1; will-change: auto; transform: none;">Di Suhanah Women and Youth
                                Center (SWYC) &amp; Satgas PPKS, kami menyediakan saluran pengaduan yang aman dan cepat
                                untuk memastikan perlindungan dan kesejahteraan semua pihak.</p>
                            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4 mt-6"
                                style="opacity: 1; will-change: auto; transform: none;">
                                <a class="inline-flex justify-center items-center px-6 py-3 text-white rounded-full bg-[#f84480] hover:bg-[#ff256e] focus:ring-4 focus:ring-pink-300"
                                    href="/laporan/form">Buat Laporan</a>
                                <a class="inline-flex justify-center items-center px-6 py-3 text-[#f84480] rounded-full border border-[#f84480] hover:bg-[#f84480] hover:text-white focus:ring-4 focus:ring-gray-100"
                                    href="/laporan/status">Cek Status Laporan</a>
                            </div>
                        </header>
                    </section>
                    <section class="flex justify-center mb-16">
                        <div class="relative w-full max-w-4xl"><img
                                src="https://ppks.wahyupramusinto.com/img/bannerhome.jpg" alt="Banner"
                                class="w-full h-auto" style="opacity: 1; will-change: auto; transform: none;">
                            <div class="absolute inset-0 pointer-events-none">
                                <div
                                    class="absolute left-0 top-0 h-full w-1/6 bg-gradient-to-r from-white to-transparent">
                                </div>
                                <div
                                    class="absolute right-0 top-0 h-full w-1/6 bg-gradient-to-l from-white to-transparent">
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="mx-auto w-full max-w-screen-xl p-4 sm:px-6">
                        <h1 class="text-center text-3xl font-bold mb-8"
                            style="opacity: 1; will-change: auto; transform: none;">Fitur Dan Layanan Kami</h1>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                            <div style="opacity: 1; will-change: auto; transform: none;">
                                <div
                                    class="flex flex-col items-start text-left bg-white p-6 rounded-xl shadow-lg h-full shadow-pink-50">
                                    <div class="p-3 rounded-full bg-orange-100 flex justify-center items-center">
                                        <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M1.25 12C1.25 6.06294 6.06294 1.25 12 1.25C12.4142 1.25 12.75 1.58579 12.75 2C12.75 2.41421 12.4142 2.75 12 2.75C6.89137 2.75 2.75 6.89137 2.75 12C2.75 17.1086 6.89137 21.25 12 21.25C17.1086 21.25 21.25 17.1086 21.25 12C21.25 11.5858 21.5858 11.25 22 11.25C22.4142 11.25 22.75 11.5858 22.75 12C22.75 17.9371 17.9371 22.75 12 22.75C6.06294 22.75 1.25 17.9371 1.25 12ZM16.7705 2.27591C18.1384 0.908028 20.3562 0.908028 21.7241 2.27591C23.092 3.6438 23.092 5.86158 21.7241 7.22947L15.076 13.8776C14.7047 14.2489 14.4721 14.4815 14.2126 14.684C13.9069 14.9224 13.5761 15.1268 13.2261 15.2936C12.929 15.4352 12.6169 15.5392 12.1188 15.7052L9.21426 16.6734C8.67801 16.8521 8.0868 16.7126 7.68711 16.3129C7.28742 15.9132 7.14785 15.322 7.3266 14.7857L8.29477 11.8812C8.46079 11.3831 8.56479 11.071 8.7064 10.7739C8.87319 10.4239 9.07761 10.0931 9.31605 9.78742C9.51849 9.52787 9.7511 9.29529 10.1224 8.924L16.7705 2.27591ZM20.6634 3.33657C19.8813 2.55448 18.6133 2.55448 17.8312 3.33657L17.4546 3.7132C17.4773 3.80906 17.509 3.92327 17.5532 4.05066C17.6965 4.46372 17.9677 5.00771 18.48 5.51999C18.9923 6.03227 19.5363 6.30346 19.9493 6.44677C20.0767 6.49097 20.1909 6.52273 20.2868 6.54543L20.6634 6.16881C21.4455 5.38671 21.4455 4.11867 20.6634 3.33657ZM19.1051 7.72709C18.5892 7.50519 17.9882 7.14946 17.4193 6.58065C16.8505 6.01185 16.4948 5.41082 16.2729 4.89486L11.2175 9.95026C10.801 10.3668 10.6376 10.532 10.4988 10.7099C10.3274 10.9297 10.1804 11.1676 10.0605 11.4192C9.96337 11.623 9.88868 11.8429 9.7024 12.4017L9.27051 13.6974L10.3026 14.7295L11.5983 14.2976C12.1571 14.1113 12.377 14.0366 12.5808 13.9395C12.8324 13.8196 13.0703 13.6726 13.2901 13.5012C13.468 13.3624 13.6332 13.199 14.0497 12.7825L19.1051 7.72709Z"
                                                fill="#fdba74">
                                            </path>
                                        </svg>
                                    </div>
                                    <h3 class="mt-4 text-lg font-bold text-gray-700">Buat Laporan</h3>
                                    <p class="mt-2 text-sm text-gray-600">Ceritakan keluhanmu dengan jelas agar kami
                                        bisa segera membantu!</p>
                                </div>
                            </div>
                            <div style="opacity: 1; will-change: auto; transform: none;">
                                <div
                                    class="flex flex-col items-start text-left bg-white p-6 rounded-xl shadow-lg h-full shadow-pink-50">
                                    <div class="p-3 rounded-full bg-sky-100 flex justify-center items-center">
                                        <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M9.75684 1.98286C9.76631 2.39697 9.43829 2.74034 9.02418 2.74981C6.20248 2.81432 4.87348 3.09895 3.99627 3.97617C3.42588 4.54656 3.09862 5.31824 2.92655 6.59801C2.75159 7.89936 2.75 9.60936 2.75 11.99C2.75 14.3705 2.75159 16.0805 2.92655 17.3819C3.09862 18.6617 3.42588 19.4333 3.99627 20.0037C4.56666 20.5741 5.33834 20.9014 6.61811 21.0735C7.91946 21.2484 9.62946 21.25 12.0101 21.25C14.3906 21.25 16.1006 21.2484 17.402 21.0735C18.6818 20.9014 19.4534 20.5741 20.0238 20.0037C20.9011 19.1265 21.1857 17.7975 21.2502 14.9758C21.2597 14.5617 21.603 14.2337 22.0171 14.2432C22.4312 14.2526 22.7593 14.596 22.7498 15.0101C22.6866 17.7765 22.4374 19.7115 21.0845 21.0644C20.1889 21.9599 19.048 22.3657 17.6019 22.5601C16.189 22.75 14.3782 22.75 12.0674 22.75H11.9527C9.64191 22.75 7.8311 22.75 6.41824 22.5601C4.97214 22.3657 3.83115 21.9599 2.93561 21.0644C2.04006 20.1689 1.63435 19.0279 1.43993 17.5818C1.24998 16.1689 1.24999 14.3581 1.25 12.0473V11.9326C1.24999 9.62181 1.24998 7.811 1.43993 6.39814C1.63435 4.95204 2.04006 3.81105 2.93561 2.91551C4.2885 1.56262 6.22347 1.31345 8.98989 1.2502C9.404 1.24073 9.74737 1.56875 9.75684 1.98286ZM11.6443 3.15543C14.1849 0.614861 18.304 0.614861 20.8446 3.15543C23.3851 5.69601 23.3851 9.81509 20.8446 12.3557C19.157 14.0432 16.7733 14.6089 14.6209 14.0562C14.5805 14.0458 14.5444 14.047 14.5182 14.0532C14.4935 14.0591 14.4807 14.0684 14.4736 14.0754L11.38 17.1691C10.9539 17.5951 10.3573 17.8044 9.75851 17.7379L8.01802 17.5445C7.6632 17.5051 7.33236 17.346 7.07992 17.0936L6.9064 16.9201C6.65396 16.6676 6.49495 16.3368 6.45553 15.982L6.26214 14.2415C6.1956 13.6427 6.40488 13.0461 6.83091 12.62L9.92432 9.52663C9.93144 9.51952 9.94081 9.50657 9.94673 9.48175C9.95302 9.45541 9.95415 9.41931 9.94383 9.37915C9.3911 7.22674 9.95676 4.84301 11.6443 3.15543ZM19.7839 4.21609C17.8291 2.26131 14.6598 2.26131 12.705 4.21609C11.4077 5.51342 10.9704 7.34603 11.3967 9.00606C11.532 9.53285 11.4227 10.1495 10.985 10.5873L7.89157 13.6807C7.78775 13.7845 7.73675 13.9299 7.75296 14.0758L7.94635 15.8163C7.94816 15.8326 7.95547 15.8478 7.96706 15.8594L8.14058 16.0329C8.15217 16.0445 8.16737 16.0518 8.18367 16.0537L9.92416 16.247C10.0701 16.2633 10.2155 16.2123 10.3193 16.1084L10.8197 15.608L9.89835 14.6967C9.60386 14.4055 9.60124 13.9306 9.89252 13.6361C10.1838 13.3416 10.6587 13.339 10.9532 13.6303L11.8804 14.5473L13.4129 13.0148C13.8509 12.5768 14.4675 12.4681 14.9939 12.6033C16.654 13.0296 18.4866 12.5923 19.7839 11.295C21.7387 9.34022 21.7387 6.17088 19.7839 4.21609ZM14.4578 6.1245C15.4016 5.18073 16.9317 5.18073 17.8755 6.1245C18.8193 7.06826 18.8193 8.59841 17.8755 9.54218C16.9317 10.4859 15.4016 10.4859 14.4578 9.54218C13.5141 8.59841 13.5141 7.06826 14.4578 6.1245ZM16.8148 7.18516C16.4569 6.82718 15.8765 6.82718 15.5185 7.18516C15.1605 7.54314 15.1605 8.12354 15.5185 8.48152C15.8765 8.8395 16.4569 8.8395 16.8148 8.48152C17.1728 8.12354 17.1728 7.54314 16.8148 7.18516Z"
                                                fill="#0ea5e9">
                                            </path>
                                        </svg>
                                    </div>
                                    <h3 class="mt-4 text-lg font-bold text-gray-700">Laporan Terenkripsi</h3>
                                    <p class="mt-2 text-sm text-gray-600">Laporanmu aman. Data terenkripsi dari awal
                                        hingga akhir.</p>
                                </div>
                            </div>
                            <div style="opacity: 1; will-change: auto; transform: none;">
                                <div
                                    class="flex flex-col items-start text-left bg-white p-6 rounded-xl shadow-lg h-full shadow-pink-50">
                                    <div class="p-3 rounded-full bg-teal-100 flex justify-center items-center">
                                        <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12 17.75C12.4142 17.75 12.75 17.4142 12.75 17V11C12.75 10.5858 12.4142 10.25 12 10.25C11.5858 10.25 11.25 10.5858 11.25 11V17C11.25 17.4142 11.5858 17.75 12 17.75Z"
                                                fill="#2dd4bf"></path>
                                            <path
                                                d="M12 7C12.5523 7 13 7.44772 13 8C13 8.55228 12.5523 9 12 9C11.4477 9 11 8.55228 11 8C11 7.44772 11.4477 7 12 7Z"
                                                fill="#2dd4bf"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M1.25 12C1.25 6.06294 6.06294 1.25 12 1.25C17.9371 1.25 22.75 6.06294 22.75 12C22.75 17.9371 17.9371 22.75 12 22.75C6.06294 22.75 1.25 17.9371 1.25 12ZM12 2.75C6.89137 2.75 2.75 6.89137 2.75 12C2.75 17.1086 6.89137 21.25 12 21.25C17.1086 21.25 21.25 17.1086 21.25 12C21.25 6.89137 17.1086 2.75 12 2.75Z"
                                                fill="#2dd4bf"></path>
                                        </svg>
                                    </div>

                                    <h3 class="mt-4 text-lg font-bold text-gray-700">Pantau Status</h3>
                                    <p class="mt-2 text-sm text-gray-600">Cek status laporanmu kapan saja dengan mudah.
                                    </p>
                                </div>
                            </div>
                            <div style="opacity: 1; will-change: auto; transform: none;">
                                <div
                                    class="flex flex-col items-start text-left bg-white p-6 rounded-xl shadow-lg h-full shadow-pink-50">
                                    <div class="p-3 rounded-full bg-red-100 flex justify-center items-center">
                                        <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12.75 6C12.75 5.58579 12.4142 5.25 12 5.25C11.5858 5.25 11.25 5.58579 11.25 6V10C11.25 10.4142 11.5858 10.75 12 10.75C12.4142 10.75 12.75 10.4142 12.75 10V6Z"
                                                fill="#f87171"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M4.25004 9C4.25004 4.71979 7.71983 1.25 12 1.25C16.2802 1.25 19.75 4.71979 19.75 9V9.7041C19.75 10.401 19.9563 11.0824 20.3429 11.6622L21.4915 13.3851C22.8246 15.3848 21.8069 18.1028 19.4883 18.7351C18.7327 18.9412 17.9706 19.1155 17.2042 19.2581L17.2023 19.2632C16.4333 21.3151 14.378 22.75 12 22.75C9.62198 22.75 7.56667 21.3151 6.79768 19.2632L6.79578 19.2581C6.02937 19.1155 5.26738 18.9412 4.51177 18.7351C2.19318 18.1028 1.17547 15.3848 2.50856 13.3851L3.65717 11.6622C4.04375 11.0824 4.25004 10.401 4.25004 9.7041V9ZM8.62349 19.5369C10.8664 19.8049 13.1335 19.805 15.3764 19.537C14.6655 20.5585 13.4289 21.25 12 21.25C10.571 21.25 9.33444 20.5585 8.62349 19.5369ZM12 2.75C8.54826 2.75 5.75004 5.54822 5.75004 9V9.7041C5.75004 10.6972 5.45609 11.668 4.90524 12.4943L3.75664 14.2172C2.99147 15.3649 3.57561 16.925 4.90644 17.288C9.5507 18.5546 14.4494 18.5546 19.0936 17.288C20.4245 16.925 21.0086 15.3649 20.2434 14.2172L19.0948 12.4943C18.544 11.668 18.25 10.6972 18.25 9.7041V9C18.25 5.54822 15.4518 2.75 12 2.75Z"
                                                fill="#f87171"></path>
                                        </svg>
                                    </div>

                                    <h3 class="mt-4 text-lg font-bold text-gray-700">Notifikasi Update</h3>
                                    <p class="mt-2 text-sm text-gray-600">Kami akan beri tahu setiap perkembangan
                                        terbaru laporanmu.</p>
                                </div>
                            </div>
                            <div style="opacity: 1; will-change: auto; transform: none;">
                                <div
                                    class="flex flex-col items-start text-left bg-white p-6 rounded-xl shadow-lg h-full shadow-pink-50">
                                    <div class="p-3 rounded-full bg-violet-100 flex justify-center items-center"><svg
                                            width="24px" height="24px" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M12 2.75C11.3423 2.75 10.6951 2.96164 9.08062 3.5143L8.5078 3.71037C6.99521 4.22814 5.8921 4.60605 5.11759 4.92069C4.731 5.07774 4.4509 5.20935 4.25429 5.32353C4.15722 5.3799 4.09034 5.42642 4.04567 5.46273C4.0078 5.49351 3.99336 5.51095 3.99129 5.51349C3.98936 5.51663 3.97693 5.5374 3.95943 5.58654C3.93944 5.64265 3.91729 5.72309 3.89571 5.83506C3.85204 6.06169 3.81894 6.37301 3.79608 6.79292C3.75028 7.63411 3.75 8.80833 3.75 10.4167V11.9914C3.75 17.1665 7.6199 19.7135 10.1988 20.84C10.5703 21.0023 10.7848 21.0941 11.0236 21.1552C11.2517 21.2136 11.53 21.25 12 21.25C12.47 21.25 12.7483 21.2136 12.9764 21.1552C13.2152 21.0941 13.4297 21.0023 13.8012 20.84C16.3801 19.7135 20.25 17.1665 20.25 11.9914V10.4167C20.25 8.80833 20.2497 7.63411 20.2039 6.79292C20.1811 6.37301 20.148 6.06169 20.1043 5.83506C20.0827 5.72309 20.0606 5.64265 20.0406 5.58654C20.0231 5.53737 20.0106 5.5166 20.0087 5.51348C20.0066 5.51092 19.9922 5.49349 19.9543 5.46273C19.9097 5.42642 19.8428 5.3799 19.7457 5.32353C19.5491 5.20935 19.269 5.07774 18.8824 4.92069C18.1079 4.60605 17.0048 4.22814 15.4922 3.71037L14.9194 3.5143C13.3049 2.96164 12.6577 2.75 12 2.75ZM8.72339 2.05112C10.1673 1.55658 11.0625 1.25 12 1.25C12.9375 1.25 13.8327 1.55658 15.2766 2.05112C15.319 2.06563 15.3618 2.0803 15.4052 2.09514L16.004 2.30013C17.4854 2.8072 18.6286 3.19852 19.447 3.53099C19.8592 3.69846 20.2136 3.86067 20.499 4.02641C20.7737 4.1859 21.0492 4.38484 21.2364 4.65154C21.4214 4.91516 21.5171 5.23924 21.5772 5.55122C21.6397 5.87556 21.6774 6.26464 21.7017 6.71136C21.75 7.5984 21.75 8.81361 21.75 10.3898V11.9914C21.75 18.0924 17.142 21.0175 14.4017 22.2146L14.3746 22.2264C14.0348 22.3749 13.7154 22.5144 13.3484 22.6084C12.9609 22.7076 12.5493 22.75 12 22.75C11.4507 22.75 11.0391 22.7076 10.6516 22.6084C10.2846 22.5144 9.96523 22.3749 9.62543 22.2264L9.59833 22.2146C6.85803 21.0175 2.25 18.0924 2.25 11.9914V10.3899C2.25 8.81365 2.25 7.59841 2.2983 6.71136C2.32262 6.26464 2.36031 5.87556 2.42281 5.55122C2.48293 5.23924 2.5786 4.91516 2.76363 4.65154C2.95082 4.38484 3.22634 4.1859 3.50098 4.02641C3.78637 3.86067 4.14078 3.69846 4.55303 3.53099C5.37141 3.19852 6.51463 2.8072 7.99596 2.30013L8.59483 2.09514C8.63817 2.0803 8.68101 2.06563 8.72339 2.05112ZM12 7.90049C11.8811 8.07699 11.7345 8.33717 11.5164 8.72853L11.3853 8.96367C11.3755 8.98113 11.3655 8.99937 11.3551 9.01826C11.2465 9.21556 11.099 9.48359 10.8555 9.66849C10.6074 9.85681 10.3082 9.92266 10.0944 9.96974C10.0741 9.97421 10.0545 9.97851 10.0359 9.98273L9.78133 10.0403C9.31615 10.1456 9.02625 10.2129 8.83146 10.281C8.9519 10.462 9.15408 10.701 9.48204 11.0845L9.65557 11.2874C9.66833 11.3024 9.68164 11.3178 9.69537 11.3337C9.84312 11.5047 10.0397 11.7322 10.1305 12.0244C10.2204 12.3135 10.19 12.6126 10.1667 12.8412C10.1645 12.8626 10.1624 12.8833 10.1605 12.9034L10.1343 13.1741C10.0874 13.6577 10.0585 13.9706 10.0593 14.1919C10.2516 14.1238 10.5148 14.0042 10.9166 13.8192L11.1549 13.7095C11.1725 13.7014 11.1908 13.6928 11.21 13.6839C11.4078 13.5913 11.6885 13.4599 12 13.4599C12.3115 13.4599 12.5922 13.5913 12.79 13.6839C12.8092 13.6928 12.8275 13.7014 12.8451 13.7095L13.0834 13.8192C13.4852 14.0042 13.7484 14.1238 13.9407 14.1919C13.9415 13.9706 13.9126 13.6577 13.8657 13.1741L13.8395 12.9034C13.8376 12.8833 13.8355 12.8626 13.8333 12.8412C13.81 12.6126 13.7796 12.3135 13.8695 12.0244C13.9603 11.7322 14.1569 11.5047 14.3046 11.3337C14.3184 11.3178 14.3317 11.3024 14.3444 11.2874L14.518 11.0845C14.8459 10.701 15.0481 10.462 15.1685 10.281C14.9737 10.2129 14.6838 10.1456 14.2187 10.0403L13.9641 9.98273C13.9455 9.97851 13.9259 9.97421 13.9056 9.96974C13.6918 9.92266 13.3926 9.85681 13.1445 9.66849C12.901 9.48359 12.7535 9.21557 12.6449 9.01827C12.6345 8.99937 12.6245 8.98113 12.6147 8.96367L12.4836 8.72853C12.2655 8.33717 12.1189 8.07699 12 7.90049ZM14.1529 14.2502C14.1541 14.2502 14.1546 14.2503 14.1547 14.2503L14.1529 14.2502ZM9.84533 14.2503C9.84534 14.2503 9.84594 14.2502 9.84707 14.2502L9.84533 14.2503ZM10.8831 6.88484C11.0988 6.60321 11.451 6.25 12 6.25C12.549 6.25 12.9012 6.60321 13.1169 6.88484C13.3245 7.15603 13.5371 7.53751 13.7683 7.95239C13.7768 7.9676 13.7853 7.98287 13.7938 7.99817L13.9249 8.23332C13.9617 8.29933 13.9902 8.35037 14.0155 8.39411C14.0324 8.42352 14.0458 8.44573 14.0565 8.46286C14.0733 8.46751 14.0946 8.47303 14.1219 8.47967C14.1689 8.49111 14.2235 8.50351 14.2952 8.51971L14.5497 8.5773C14.5671 8.58123 14.5844 8.58514 14.6016 8.58905C15.0485 8.69009 15.4657 8.78439 15.7807 8.90852C16.1219 9.04302 16.5343 9.28543 16.6932 9.79638C16.8496 10.2992 16.6571 10.7332 16.4626 11.0421C16.2799 11.3323 15.9979 11.662 15.6916 12.0201C15.6804 12.0332 15.6692 12.0463 15.658 12.0594L15.4844 12.2623C15.4357 12.3193 15.3981 12.3633 15.3662 12.4018C15.3401 12.4334 15.322 12.4562 15.309 12.4734C15.3107 12.5291 15.3179 12.6075 15.3325 12.7587L15.3637 13.0803C15.4102 13.5596 15.4526 13.997 15.4373 14.3415C15.4213 14.6994 15.3369 15.1785 14.9114 15.5015C14.4737 15.8337 13.9847 15.7689 13.6378 15.6695C13.3132 15.5765 12.9231 15.3969 12.5049 15.2042C12.4886 15.1967 12.4724 15.1892 12.4561 15.1817L12.2177 15.072C12.1507 15.0411 12.0994 15.0175 12.0548 14.9979C12.0329 14.9882 12.0149 14.9805 12 14.9744C11.9851 14.9805 11.9671 14.9882 11.9452 14.9979C11.9006 15.0175 11.8493 15.0411 11.7823 15.072L11.5439 15.1817C11.5276 15.1892 11.5114 15.1967 11.4951 15.2042C11.0769 15.3969 10.6868 15.5765 10.3622 15.6695C10.0153 15.7689 9.52629 15.8337 9.08858 15.5015C8.66311 15.1785 8.57866 14.6994 8.56272 14.3415C8.54737 13.997 8.58982 13.5596 8.63631 13.0804C8.63796 13.0634 8.6396 13.0465 8.64125 13.0294L8.66749 12.7587C8.68214 12.6075 8.68928 12.5291 8.69097 12.4734C8.67803 12.4562 8.65995 12.4334 8.63378 12.4018C8.60187 12.3633 8.56431 12.3193 8.51557 12.2623L8.34204 12.0594C8.33081 12.0463 8.3196 12.0332 8.30843 12.0201C8.00207 11.662 7.72006 11.3323 7.53738 11.0421C7.34293 10.7332 7.15045 10.2992 7.3068 9.79638C7.46569 9.28543 7.87805 9.04302 8.21935 8.90852C8.53433 8.78439 8.95146 8.69009 9.39836 8.58905C9.41563 8.58514 9.43295 8.58123 9.4503 8.5773L9.70484 8.51971C9.77645 8.50351 9.83113 8.49112 9.87814 8.47967C9.90542 8.47303 9.92669 8.46751 9.94352 8.46287C9.95424 8.44573 9.96756 8.42352 9.98455 8.39411C10.0098 8.35037 10.0383 8.29934 10.0751 8.23332L10.2062 7.99817C10.2147 7.98287 10.2232 7.96761 10.2317 7.95239C10.4629 7.53751 10.6755 7.15603 10.8831 6.88484Z"
                                                fill="#a78bfa"></path>
                                        </svg>
                                    </div>
                                    <h3 class="mt-4 text-lg font-bold text-gray-700">Privasi Terjamin</h3>
                                    <p class="mt-2 text-sm text-gray-600">Privasi dan keamanan datamu adalah prioritas
                                        kami.</p>
                                </div>
                            </div>

                            <div style="opacity: 1; will-change: auto; transform: none;">
                                <div
                                    class="flex flex-col items-start text-left bg-white p-6 rounded-xl shadow-lg h-full shadow-pink-50">
                                    <div class="p-3 rounded-full bg-slate-100 flex justify-center items-center">
                                        <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M18.1437 3.63083C16.9737 3.83896 15.3964 4.36262 13.1827 5.10051L8.17141 6.77094C6.39139 7.36428 5.1021 7.79468 4.19146 8.182C3.23939 8.58693 2.90071 8.86919 2.79071 9.0584C2.45191 9.64118 2.45191 10.361 2.79071 10.9437C2.90071 11.1329 3.23939 11.4152 4.19146 11.8201C5.1021 12.2075 6.39139 12.6379 8.17141 13.2312C8.19952 13.2406 8.22727 13.2498 8.25468 13.2589C8.74086 13.4206 9.11881 13.5464 9.44395 13.764C9.75719 13.9737 10.0263 14.2428 10.236 14.5561C10.4536 14.8812 10.5794 15.2592 10.7411 15.7453C10.7502 15.7727 10.7594 15.8005 10.7688 15.8286C11.3621 17.6086 11.7925 18.8979 12.1799 19.8085C12.5848 20.7606 12.867 21.0993 13.0563 21.2093C13.639 21.5481 14.3588 21.5481 14.9416 21.2093C15.1308 21.0993 15.4131 20.7606 15.818 19.8085C16.2053 18.8979 16.6357 17.6086 17.2291 15.8286L18.8995 10.8173C19.6374 8.60363 20.161 7.02627 20.3692 5.85629C20.5783 4.68074 20.4185 4.1814 20.1185 3.88146C19.8186 3.58152 19.3193 3.42171 18.1437 3.63083ZM17.8746 2.11797C19.1768 1.88632 20.3496 1.93941 21.2051 2.79491C22.0606 3.65041 22.1137 4.82322 21.882 6.12542C21.6518 7.41975 21.0903 9.10415 20.3794 11.2367L18.6745 16.3515C18.096 18.0869 17.6465 19.4354 17.232 20.41C16.8322 21.35 16.3882 22.1457 15.7139 22.5377C14.6537 23.1541 13.3442 23.1541 12.284 22.5377C11.6096 22.1457 11.1657 21.35 10.7658 20.41C10.3513 19.4354 9.90184 18.0869 9.32338 16.3515L9.31105 16.3145C9.10838 15.7065 9.04661 15.5416 8.95909 15.4109C8.86114 15.2646 8.73545 15.1389 8.58913 15.0409C8.4584 14.9534 8.29348 14.8916 7.68549 14.689L7.64845 14.6766C5.91306 14.0982 4.56463 13.6487 3.59005 13.2342C2.64996 12.8343 1.85431 12.3904 1.46228 11.716C0.845907 10.6558 0.845908 9.34634 1.46228 8.28611C1.85431 7.61177 2.64996 7.16781 3.59005 6.76797C4.56464 6.35345 5.91309 5.90397 7.64852 5.3255L12.7633 3.62057C14.8959 2.9097 16.5803 2.34822 17.8746 2.11797ZM17.6807 6.32532C17.9791 6.62702 17.9764 7.11348 17.6747 7.41185L13.5771 11.4643C13.2754 11.7627 12.7889 11.76 12.4905 11.4583C12.1921 11.1566 12.1948 10.6701 12.4965 10.3718L16.5942 6.3193C16.8959 6.02092 17.3823 6.02362 17.6807 6.32532Z"
                                                fill="#94a3b8"></path>
                                        </svg>
                                    </div>
                                    <h3 class="mt-4 text-lg font-bold text-gray-700">Feedback</h3>
                                    <p class="mt-2 text-sm text-gray-600">Berikan saran dan masukanmu untuk membantu
                                        kami menjadi lebih baik!</p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <a href="https://wa.me/6281219103436"
                        class="fixed bottom-8 right-8 bg-green-500 hover:bg-green-600 text-white p-4 rounded-full shadow-lg transition-all duration-300"
                        target="_blank" rel="noopener noreferrer">
                        <svg width="40px" height="40px" viewBox="0 0 448 512" fill="#ffffff"
                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path
                                d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z">
                            </path>
                        </svg>
                    </a>
                </div> --}}
				@yield('content')
            </div>
        </div>
    </div>



    </div>
    </div>
    </div>
    </div>
    </section>
    </div>
    </div>



    <footer class="bg-gray-900 px-4 sm:px-6 lg:px-12">

        <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">

            <div class="md:flex md:justify-between">

                <div class="mb-6 md:mb-0">

                    <a href="https://swyc.budiluhur.ac.id/" class="flex items-center">

                        <div class="text-lg font-semibold flex items-center"></div>

                        <span class="self-center text-2xl font-semibold whitespace-nowrap text-white mr-40">Satgas
                            PPKS LLDIKTI Wilayah III</span>

                    </a>

                </div>



                <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">

                    <div>

                        <h2 class="mb-6 text-sm font-semibold uppercase text-white">Lokasi</h2>

                        <ul class=" text-gray-400 font-medium">

                            <li class="mb-4">Jl. SMA 14 Cawang, Jakarta 13630</li>

                        </ul>

                    </div>

                    <div>

                        <h2 class="mb-6 text-sm font-semibold uppercase text-white">Ikuti Kami</h2>

                        <ul class=" text-gray-400 font-medium">

                            <li class="mb-4">

                                <a href="https://www.instagram.com/swyc_budiluhur/"
                                    class="hover:underline ">Instagram</a>

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

                    <a href="#" class="hover:underline">Satgas PPKS LLDIKTI Wilayah III</a>.

                    All Rights Reserved. Developed by Universitas Budi Luhur</span>

                <div class="flex mt-4 sm:justify-center sm:mt-0">

                    <a href="https://wa.me/6281219103436" class="text-gray-500 hover:text-white">

                        <svg width="20px" height="20px" viewBox="0 0 448 512" fill="currentColor"
                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">

                            <path
                                d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z">
                            </path>

                        </svg>

                        <span class="sr-only">Whatsapp</span>

                    </a>

                    <a href="https://www.instagram.com/swyc_budiluhur/" class="text-gray-500 hover:text-white ms-5">

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




</body>

</html>
