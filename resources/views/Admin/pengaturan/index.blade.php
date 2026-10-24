@extends('layouts.Admin.adm')
@section('content')
    <div id="content" class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                @include('components.alert')
                            </div>
                            <div class="d-flex" style="justify-content: space-between;margin-bottom: 20px;">
                                <div>
                                    <h4 id="pages_title">Pengaturan</h4>
                                </div>
                            </div>
                        </div>
                        <form action="{{ url('adm/update_pengaturan') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card mb-4 border" style="border-radius: 14px; background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%);">
                                <div class="card-body p-3 p-md-4">
                                    <div class="d-flex align-items-center gap-2 mb-2">
                                        <i class="fas fa-shield-halved text-primary fs-5"></i>
                                        <h5 class="fw-bold text-dark mb-0">Pengaturan Algoritma Kriptografi Berkas</h5>
                                    </div>
                                    <p class="text-muted mb-3" style="font-size: 13px;">
                                        Pilih spesifikasi algoritma AES yang digunakan saat pelapor mengunggah berkas dokumen identitas dan berkas bukti kekerasan.
                                    </p>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="form-check p-3 border rounded-3 h-100" style="background: {{ ($pengaturan->aes_algorithm ?? 'AES-128') == 'AES-128' ? '#eff6ff; border-color: #3b82f6 !important;' : '#ffffff;' }}">
                                                <input class="form-check-input ms-0 me-2" type="radio" name="aes_algorithm" id="algo_aes_128" value="AES-128" {{ ($pengaturan->aes_algorithm ?? 'AES-128') == 'AES-128' ? 'checked' : '' }}>
                                                <label class="form-check-label fw-bold text-dark" for="algo_aes_128">
                                                    AES-128 bit <span class="badge bg-primary ms-1">10 Putaran</span>
                                                </label>
                                                <div class="text-muted mt-1" style="font-size: 12px;">
                                                    Kunci 16 bytes (128-bit), 10 Round. Komputasi sangat cepat dan efisien untuk berkas dokumen standar.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check p-3 border rounded-3 h-100" style="background: {{ ($pengaturan->aes_algorithm ?? '') == 'AES-256' ? '#eff6ff; border-color: #3b82f6 !important;' : '#ffffff;' }}">
                                                <input class="form-check-input ms-0 me-2" type="radio" name="aes_algorithm" id="algo_aes_256" value="AES-256" {{ ($pengaturan->aes_algorithm ?? '') == 'AES-256' ? 'checked' : '' }}>
                                                <label class="form-check-label fw-bold text-dark" for="algo_aes_256">
                                                    AES-256 bit <span class="badge bg-success ms-1">14 Putaran (Standar Militer)</span>
                                                </label>
                                                <div class="text-muted mt-1" style="font-size: 12px;">
                                                    Kunci 32 bytes (256-bit SHA-256), 14 Round FIPS 197. Tingkat keamanan enkripsi tertinggi dan tahan komputasi kuantum.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="">Whatsapp <span class="text-danger">*</span>
</label>
                                <input type="number" class="form-control" required placeholder="Whatsapp" name="no_wa"
                                    value="{{ $pengaturan->no_wa }}">
                                @error('no_wa')
                                    <small>{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="">Instagram <span class="text-danger">*</span>
</label>
                                <input type="text" class="form-control" required placeholder="Instagram" name="ig"
                                    value="{{ $pengaturan->ig }}">
                                @error('ig')
                                    <small>{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="">Email <span class="text-danger">*</span>
</label>
                                <input type="email" class="form-control" required placeholder="Email" name="email"
                                    value="{{ $pengaturan->email }}">
                                @error('email')
                                    <small>{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="">Manual Book</label>
                                <input type="file" class="form-control" placeholder="file" name="file" accept=".pdf"
                                    id="upload_pdf">
                                <small>File yang boleh di upload .png .jpeg .zip .jpg dan maksimal file 2 MB</small>
                                <br>
                                <small id="error_message_dua" style="color: red;">
                                </small>
                                @error('file')
                                    <small>{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="">Alamat <span class="text-danger">*</span>
</label>
                                <textarea name="alamat" class="form-control" required placeholder="Alamat" id="" cols="30"
                                    rows="10">{{ $pengaturan->alamat }}</textarea>
                                @error('alamat')
                                    <small>{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="">Maps <span class="text-danger">*</span>
</label>
                                <textarea name="maps" class="form-control" required placeholder="Maps" id="" cols="30" rows="10">{{ $pengaturan->maps }}</textarea>
                                @error('maps')
                                    <small>{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="">Informasi <span class="text-danger">*</span>
</label>
                                <textarea name="informasi" class="form-control" placeholder="informasi" id="informasi" cols="30" rows="30">{{ $pengaturan->informasi }}</textarea>
                                @error('informasi')
                                    <small>{{ $message }}</small>
                                @enderror
                            </div>
                            <button class="btn btn-success">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <footer class="footer">

        <div class="container-fluid">

            <div class="row">

                <div class="text-center">

                    <script>
                        document.write(new Date().getFullYear())
                    </script> © Aplikasi CRS LLDIKTI Wilayah III

                </div>


            </div>

        </div>

    </footer>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/super-build/ckeditor.js"></script>

    <script>
        document.getElementById('upload_pdf').addEventListener('change', function(event) {
            const allowedTypes = ['application/pdf'];
            const maxFiles = 5;
            const maxSize = 2 * 1024 * 1024; // 2MB

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
                    errorMessage.textContent = 'Hanya file PDF yang diperbolehkan.';
                    event.target.value = '';
                    return;
                }

                // Cek ukuran file
                if (file.size > maxSize) {
                    errorMessage.textContent = `Ukuran file "${file.name}" melebihi 2 MB.`;
                    event.target.value = '';
                    return;
                }
            }

            // Semua valid
            errorMessage.textContent = '';
        });

        CKEDITOR.ClassicEditor.create(document.getElementById("informasi"), {

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
