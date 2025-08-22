@extends('web_version_2.layout')

@section('content')
    <style>
        .ck-placeholder,
        .ck-powered-by {
            display: none
        }

        .ck-restricted-editing_mode_standard {
            min-height: 80px
        }

        .select_multi {
            width: 100%;
        }
    </style>
    <section class="section-top"
        style="background-image: url({{ asset('img/promotion-bg.jpg') }});  background-size:cover; background-position: center center;">
        <div class="container">
            <div class="col-lg-12 col-sm-12 col-xs-12 text-center">
                <div class="section-top-title">
                    <h1>Buat Laporan</h1>
                </div><!-- //.HERO-TEXT -->
            </div><!--- END COL -->
        </div><!--- END CONTAINER -->
    </section>

    <section class="feature section-padding">

        <form action="{{ route('submitlaporan') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="section-title text-center wow zoomIn">
                <h2>Form Pengaduan Online CRS Satgas PPKPT LLDIKTI wilayah III</h2>
            </div>
            @if ($errors->any())
                <div class="container">
                    <div class="alert alert-danger">

                        <ul class="list-disc pl-5">

                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>

                    </div>
                </div>
            @endif
            <div class="container as_box">
                <div class="row ">
                    <div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
                        <div class="about_single wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.1s"
                            data-wow-offset="0">
                            <div class="form-group">
                                <label for="text-field" class="form-label">Nama Lengkap <span class="text-danger">*</span>
                                </label>

                                <input
                                    class="form-control @error('nama')
                                        is-invalid
                                    @enderror"
                                    type="text" name="nama" placeholder="Masukkan nama" required=""
                                    value="{{ old('nama') }}">

                                @error('nama')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group select_multi">
                                <label for="text-field" class="form-label">Pelapor <span class="text-danger">*</span>
                                </label>

                                <select name="pelapor"
                                    class="form-control @error('pelapor')
                                        is-invalid
                                    @enderror pelapors"
                                    required style="width: 100% !important">
                                    <option value="">Pilih</option>
                                    <option value="Saksi" @if (old('pelapor') == 'Saksi') selected @endif>Saksi</option>
                                    <option value="Korban" @if (old('pelapor') == 'Korban') selected @endif>Korban</option>
                                </select>
                                @error('pelapor')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="text-field" class="form-label">Jenis Identitas
                                     <span class="text-danger">*</span>
                                </label>

                                <select name="jenis_identitas"
                                    class="form-control pelapors @error('jenis_identitas')
                                        is-invalid
                                    @enderror"
                                    required style="width: 100% !important">
                                    <option value="">Pilih</option>
                                    @foreach ($identitas as $dataidentitas)
                                        <option value="{{ $dataidentitas->id }}"
                                            {{ old('jenis_identitas') == $dataidentitas->id ? 'selected' : '' }}>
                                            {{ $dataidentitas->jenis_identitas }}</option>
                                    @endforeach
                                </select>
                                @error('jenis_identitas')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="text-field" class="form-label">NIK/NIP/NIM <span class="text-danger">*</span>
                                </label>

                                <input
                                    class="form-control @error('no_identitas')
                                        is-invalid
                                    @enderror"
                                    type="number" name="no_identitas" placeholder="Masukkan NIK/NIP/NIM" required=""
                                    value="{{ old('no_identitas') }}">

                                @error('no_identitas')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="text-field" class="form-label">Nomor Telepon <span class="text-danger">*</span>
                                </label>

                                <input
                                    class="form-control @error('no_hp')
                                        is-invalid
                                    @enderror"
                                    type="number" name="no_hp" placeholder="Masukkan nomor telepon" required=""
                                    value="{{ old('no_hp') }}">

                                @error('no_hp')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="text-field" class="form-label">Upload Identitas
                                </label>

                                <input
                                    class="form-control @error('upload_identitas')
                                        is-invalid
                                    @enderror"
                                    id="upload_identitas" type="file" name="upload_identitas"
                                    accept=".png,.jpg,.jpeg,.zip" value="{{ old('upload_identitas') }}">
                                <small>File yang boleh di upload .png .jpeg .zip .jpg dan maksimal file 1 MB</small>
                                <br>
                                <small id="error_message_dua" style="color: red;">
                                </small>

                                @error('upload_identitas')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="text-field" class="form-label">Upload Bukti Kejadian
                                </label>

                                <input
                                    class="form-control @error('upload_bukti')
                                        is-invalid
                                    @enderror"
                                    id="upload_bukti" type="file" name="upload_bukti" accept=".png,.jpg,.jpeg,.zip"
                                    value="{{ old('upload_bukti') }}">
                                <small>File yang boleh di upload .png .jpeg .zip .jpg dan maksimal file 1 MB</small>
                                <br>
                                <small id="error_message" style="color: red;"></small>


                                @error('upload_bukti')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
                        <div class="about_single wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.1s"
                            data-wow-offset="0">
                            <div class="form-group">
                                <label for="text-field" class="form-label">Kategori <span class="text-danger">*</span>
                                </label>

                                <select name="kategori" onchange="ganti_kategori(this.value)"
                                    class="form-control pelapors @error('kategori')
                                        is-invalid
                                    @enderror"
                                    style="width: 100% !important" required id="kategori">
                                    <option value="">Pilih</option>
                                    <option value="Mahasiswa" {{ old('kategori') == 'Mahasiswa' ? 'selected' : '' }}>
                                        Mahasiswa</option>
                                    <option value="Dosen/Tenaga Pendidik"
                                        {{ old('kategori') == 'Dosen/Tenaga Pendidik' ? 'selected' : '' }}>Dosen/Tenaga
                                        Pendidik</option>
                                    <option value="Mitra" {{ old('kategori') == 'Mitra' ? 'selected' : '' }}>Mitra
                                    </option>

                                </select>
                                @error('kategori')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <div class="form-group" id="instansiBekerja">
                                    <label for="text-field" class="form-label">Instansi Bekerja
                                         <span class="text-danger">*</span>
                                    </label>

                                    <input
                                        class="form-control @error('bekerja')
                                        is-invalid
                                    @enderror"
                                        type="text" name="bekerja" placeholder="Instansi Bekerja"
                                        value="{{ old('bekerja') }}">

                                    @error('bekerja')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group" id="universitas">
                                    <label for="text-field" class="form-label">Perguruan Tinggi
                                         <span class="text-danger">*</span>
                                    </label>

                                    <select name="universitas"
                                        class="form-control pelapors @error('universitas')
                                        is-invalid
                                    @enderror" style="width: 100% !important">
                                        <option value="">Pilih</option>
                                        @foreach ($universitas as $datauniv)
                                            <option value="{{ $datauniv->id }}"
                                                {{ old('universitas') == $datauniv->id ? 'selected' : '' }}>
                                                {{ $datauniv->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('universitas')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="text-field" class="form-label">Jenis Kelamin 
                                    <span class="text-danger">*</span>
                                </label>
                                <br>

                                <input
                                    class=" @error('jenis_kelamin')
                                        is-invalid
                                    @enderror"
                                    type="radio" @if (old('jenis_kelamin') == 'Laki-Laki') checked @endif name="jenis_kelamin"
                                    value="Laki-Laki" required id="lk">
                                <label for="lk">Laki-Laki</label>
                                <br>
                                <input
                                    class=" @error('jenis_kelamin')
                                        is-invalid
                                    @enderror"
                                    type="radio" @if (old('jenis_kelamin') == 'Perempuan') checked @endif name="jenis_kelamin"
                                    value="Perempuan" required id="pr">
                                <label for="pr">Perempuan</label>

                                @error('jenis_kelamin')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="text-field" class="form-label">Email <span class="text-danger">*</span>
                                </label>

                                <input
                                    class="form-control @error('email')
                                        is-invalid
                                    @enderror"
                                    type="email" name="email" placeholder="Masukkan alamat email" required=""
                                    value="{{ old('email') }}">

                                @error('email')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="text-field" class="form-label">Tanggal Kejadian 
                                    <span class="text-danger">*</span>
                                </label>

                                <input
                                    class="form-control @error('tanggal_kejadian')
                                        is-invalid
                                    @enderror"
                                    type="date" name="tanggal_kejadian" required="" id="tanggal_kejadian"
                                    value="{{ old('tanggal_kejadian') }}">

                                @error('tanggal_kejadian')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="text-field" class="form-label">Lokasi Kejadian
                                     <span class="text-danger">*</span>
                                </label>

                                <input
                                    class="form-control @error('lokasi_kejadian')
                                        is-invalid
                                    @enderror"
                                    type="text" name="lokasi_kejadian" placeholder="Lokasi Kejadian" required=""
                                    id="lokasi_kejadian" value="{{ old('lokasi_kejadian') }}">

                                @error('lokasi_kejadian')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="text-field" class="form-label">Jenis Kekerasan 
                                    <span class="text-danger">*</span>
                                </label>

                                <select name="jenis_kekerasan"
                                    class="form-control pelapors @error('jenis_kekerasan')
                                        is-invalid
                                    @enderror"
                                    style="width: 100% !important" required>
                                    <option value="">Pilih</option>
                                    @foreach ($kekerasan as $datakekerasan)
                                        <option value="{{ $datakekerasan->id }}"
                                            {{ old('jenis_kekerasan') == $datakekerasan->id ? 'selected' : '' }}>
                                            {{ $datakekerasan->tipe_kekerasan }}</option>
                                    @endforeach
                                </select>
                                @error('jenis_kekerasan')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row pl-4 pr-4">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="form-group">
                            <label for="text-field" class="form-label">Kronologi Kejadian 
                                <span class="text-danger">*</span>
                            </label>

                            <textarea name="kronologi_kejadian"
                                class="form-control @error('kronologi_kejadian')
                                        is-invalid
                                    @enderror"
                                id="keluhan" cols="30" placeholder="Ceritakan Kronologi Kejadian" rows="10">{{ old('kronologi_kejadian') }}</textarea>

                            @error('kronologi_kejadian')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group p-4 row">
                    <div class="col-12">
                        <span id="captcha-img" style="display:inline-block; transform: scale(2); transform-origin: left;">
                            {!! captcha_img('math') !!}
                        </span>
                        <br>
                        <br>
                        <button type="button" class="btn btn-secondary btn-sm" id="refresh-captcha"
                            title="Refresh Captcha">
                            <i class="fa fa-refresh"></i>
                        </button>
                        <br>
                        <br>
                        <div class="form-group">
                            <label for="" class="form-label">Kode Captcha
                                 <span class="text-danger">*</span>
                            <input type="number"
                                class="form-control w-100  @error('captcha')
                            is-invalid
                        @enderror"
                                name="captcha" placeholder="Masukan Captcha" required>
                        </div>
                        @error('captcha')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="py-6 p-4 font-medium text-gray-900">

                    <p style="text-align: justify">Kami akan memproses data yang dikumpulkan dengan pengawasan. Anda
                        mempunyai hak akses, perbaikan,
                        portabilitas data, penghapusan data pribadi Anda, hak untuk membatasi pemrosesan, serta hak
                        untuk
                        menolak pemrosesan data Anda. Anda juga berhak mengirimkan kepada kami instruksi khusus mengenai
                        nasib data pribadi Anda setelah kematian Anda dan mengajukan keluhan kepada otoritas pengawas
                        yang
                        berwenang. Untuk mengetahui lebih lanjut tentang pemrosesan data pribadi Anda, hak-hak Anda, dan
                        cara menggunakannya.

                    </p>

                    <div class="d-flex" style="justify-content: end">
                        <button type="submit" id="submitButton" class="btn mt-3 btn-lg contact_btn"
                            title="Kirim!">Kirim Laporan</button>
                    </div>
                </div>
            </div><!--- END CONTAINER -->
        </form>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $('#refresh-captcha').click(function() {
            $.ajax({
                type: 'GET',
                url: "{{ url('capcha') }}",
                success: function(data) {
                    $('#captcha-img').html(data.captcha);
                }
            });
        });
        // In your Javascript (external .js resource or <script> tag)
        $('.pelapors').select2();
    </script>
    <script>
        document.getElementById('upload_bukti').addEventListener('change', function(event) {
            const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'application/zip'];

            const maxFiles = 5;
            const maxSize = 1 * 1024 * 1024; // 1MB

            const files = event.target.files;
            const errorMessage = document.getElementById('error_message');
            errorMessage.textContent = '';

            // Cek jumlah file
            if (files.length > maxFiles) {
                errorMessage.textContent = 'Maksimal upload 5 file saja.';
                event.target.value = ''; // reset input
                return;
            }

            for (let i = 0; i < files.length; i++) {
                const file = files[i];

                // Cek tipe file
                if (!allowedTypes.includes(file.type)) {
                    errorMessage.textContent = 'Hanya file JPG, JPEG,PNG atau PDF yang diperbolehkan.';
                    event.target.value = '';
                    return;
                }

                // Cek ukuran file
                if (file.size > maxSize) {
                    errorMessage.textContent = `Ukuran file "${file.name}" melebihi 1 MB.`;
                    event.target.value = '';
                    return;
                }
            }

            // Semua valid
            errorMessage.textContent = '';
        });
        document.getElementById('upload_identitas').addEventListener('change', function(event) {
            const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'application/zip'];
            const maxFiles = 5;
            const maxSize = 1 * 1024 * 1024; // 1MB

            const files = event.target.files;
            const errorMessage = document.getElementById('error_message_dua');
            errorMessage.textContent = '';

            // Cek jumlah file
            if (files.length > maxFiles) {
                errorMessage.textContent = 'Maksimal upload 5 file saja.';
                event.target.value = ''; // reset input
                return;
            }

            for (let i = 0; i < files.length; i++) {
                const file = files[i];

                // Cek tipe file
                if (!allowedTypes.includes(file.type)) {
                    errorMessage.textContent = 'Hanya file JPG, JPEG,PNG atau PDF yang diperbolehkan.';
                    event.target.value = '';
                    return;
                }

                // Cek ukuran file
                if (file.size > maxSize) {
                    errorMessage.textContent = `Ukuran file "${file.name}" melebihi 1 MB.`;
                    event.target.value = '';
                    return;
                }
            }

            // Semua valid
            errorMessage.textContent = '';
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            let today = new Date().toISOString().split("T")[0]; // Ambil tanggal hari ini dalam format YYYY-MM-DD

            document.getElementById("tanggal_kejadian").setAttribute("max", today);

        });
    </script>
    <script>
        function ganti_kategori(val) {
            const instansiBekerja = document.getElementById('instansiBekerja');
            const universitas = document.getElementById('universitas');

            if (val === "Mitra") {
                instansiBekerja.style.display = 'block';
                universitas.style.display = 'none';
            } else if (val === "Mahasiswa" || val === "Dosen/Tenaga Pendidik") {
                instansiBekerja.style.display = 'none';
                universitas.style.display = 'block';
            } else {
                instansiBekerja.style.display = 'none';
                universitas.style.display = 'none';
            }
        }

        // Panggil saat pertama kali halaman dimuat (untuk old value dari Blade)
        window.addEventListener("load", function() {
            const kategoriSelect = document.getElementById('kategori');
            ganti_kategori(kategoriSelect.value);
        });

    </script>

    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/super-build/ckeditor.js"></script>

    <script>
        CKEDITOR.ClassicEditor.create(document.getElementById("keluhan"), {

            toolbar: {
                items: [
                    'exportPDF', 'exportWord', '|',
                    'findAndReplace', 'selectAll', '|',
                    'heading', '|',
                    'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript',
                    'removeFormat', '|',
                    'bulletedList', 'numberedList', 'todoList', '|',
                    'outdent', 'indent', '|',
                    'undo', 'redo',
                    '-',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                    'alignment', '|',
                    'link', 'uploadImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed',
                    '|',
                    'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                    'textPartLanguage', '|',
                    'sourceEditing'
                ],
                shouldNotGroupWhenFull: true
            },
            // Changing the language of the interface requires loading the language file using the <script> tag.
            // language: 'es',
            list: {
                properties: {
                    styles: true,
                    startIndex: true,
                    reversed: true
                }
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
            heading: {
                options: [{
                        model: 'paragraph',
                        title: 'Paragraph',
                        class: 'ck-heading_paragraph'
                    },
                    {
                        model: 'heading1',
                        view: 'h1',
                        title: 'Heading 1',
                        class: 'ck-heading_heading1'
                    },
                    {
                        model: 'heading2',
                        view: 'h2',
                        title: 'Heading 2',
                        class: 'ck-heading_heading2'
                    },
                    {
                        model: 'heading3',
                        view: 'h3',
                        title: 'Heading 3',
                        class: 'ck-heading_heading3'
                    },
                    {
                        model: 'heading4',
                        view: 'h4',
                        title: 'Heading 4',
                        class: 'ck-heading_heading4'
                    },
                    {
                        model: 'heading5',
                        view: 'h5',
                        title: 'Heading 5',
                        class: 'ck-heading_heading5'
                    },
                    {
                        model: 'heading6',
                        view: 'h6',
                        title: 'Heading 6',
                        class: 'ck-heading_heading6'
                    }
                ]
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
            placeholder: 'Welcome to CKEditor 5!',
            // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
            fontFamily: {
                options: [
                    'default',
                    'Arial, Helvetica, sans-serif',
                    'Courier New, Courier, monospace',
                    'Georgia, serif',
                    'Lucida Sans Unicode, Lucida Grande, sans-serif',
                    'Tahoma, Geneva, sans-serif',
                    'Times New Roman, Times, serif',
                    'Trebuchet MS, Helvetica, sans-serif',
                    'Verdana, Geneva, sans-serif'
                ],
                supportAllValues: true
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
            fontSize: {
                options: [10, 12, 14, 'default', 18, 20, 22],
                supportAllValues: true
            },
            // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
            // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
            htmlSupport: {
                allow: [{
                    name: /.*/,
                    attributes: true,
                    classes: true,
                    styles: true
                }]
            },

            htmlEmbed: {
                showPreviews: true
            },

            link: {
                decorators: {
                    addTargetToExternalLinks: true,
                    defaultProtocol: 'https://',
                    toggleDownloadable: {
                        mode: 'manual',
                        label: 'Downloadable',
                        attributes: {
                            download: 'file'
                        }
                    }
                }
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
            mention: {
                feeds: [{
                    marker: '@',
                    feed: [
                        '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes',
                        '@chocolate', '@cookie', '@cotton', '@cream',
                        '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread',
                        '@gummi', '@ice', '@jelly-o',
                        '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding',
                        '@sesame', '@snaps', '@soufflé',
                        '@sugar', '@sweet', '@topping', '@wafer'
                    ],
                    minimumCharacters: 1
                }]
            },
            // The "superbuild" contains more premium features that require additional configuration, disable them below.
            // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
            removePlugins: [
                // These two are commercial, but you can try them out without registering to a trial.
                // 'ExportPdf',
                // 'ExportWord',
                'AIAssistant',
                'CKBox',
                'CKFinder',
                'EasyImage',
                // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
                // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
                // Storing images as Base64 is usually a very bad idea.
                // Replace it on production website with other solutions:
                // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
                // 'Base64UploadAdapter',
                'MultiLevelList',
                'RealTimeCollaborativeComments',
                'RealTimeCollaborativeTrackChanges',
                'RealTimeCollaborativeRevisionHistory',
                'PresenceList',
                'Comments',
                'TrackChanges',
                'TrackChangesData',
                'RevisionHistory',
                'Pagination',
                'WProofreader',
                // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
                // from a local file system (file://) - load this site via HTTP server if you enable MathType.
                'MathType',
                // The following features are part of the Productivity Pack and require additional license.
                'SlashCommand',
                'Template',
                'DocumentOutline',
                'FormatPainter',
                'TableOfContents',
                'PasteFromOfficeEnhanced',
                'CaseChange'
            ]
        });
    </script>
@endsection
