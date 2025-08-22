@extends('web_version_2.layout')

@section('content')
    <section class="section-top"
        style="background-image: url({{ asset('img/promotion-bg.jpg') }});  background-size:cover; background-position: center center;">
        <div class="container">
            <div class="col-lg-12 col-sm-12 col-xs-12 text-center">
                <div class="section-top-title">
                    <h1>Status Laporan</h1>
                </div><!-- //.HERO-TEXT -->
            </div><!--- END COL -->
        </div><!--- END CONTAINER -->
    </section>

    <section class="feature section-padding">
        <div class="container">
            <div class="section-title text-center wow zoomIn">
                <h2>Status Laporan Anda </h2>
            </div>
            <div class="row as_box">
                <div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
                    <div class="about_single wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.1s"
                        data-wow-offset="0">
                        <div>
                            <b>ID Laporan </b>
                            <br>
                            <span>{{ $first->id }}</span>
                        </div>
                        <div class="mt-4">
                            <b>Kode Laporan </b>
                            <br>
                            <span>{{ $first->kode_laporan }}</span>
                        </div>
                        <div class="mt-4">
                            <b>Jenis Kelamin </b>
                            <br>
                            <span>{{ Illuminate\Support\Facades\Crypt::decryptString($first->jenis_kelamin) }}</span>
                        </div>
                        <div class="mt-4">
                            <b>Lokasi Kejadian </b>
                            <br>
                            <span>{{ Illuminate\Support\Facades\Crypt::decryptString($first->lokasi_kejadian) }}</span>
                        </div>
                        <div class="mt-4">
                            <b>No Identitas </b>
                            <br>
                            <span>{{ Illuminate\Support\Facades\Crypt::decryptString($first->no_identitas) }}</span>
                        </div>
                        <div class="mt-4">
                            <b>Email </b>
                            <br>
                            <span>{{ Illuminate\Support\Facades\Crypt::decryptString($first->email) }}</span>
                        </div>
                        @if ($first->instansi_bekerja)
                            <div class="mt-4">
                                <b>Instansi Bekerja </b>
                                <br>
                                <span>{{ Illuminate\Support\Facades\Crypt::decryptString($first->instansi_bekerja) }}</span>
                            </div>
                        @endif
                        @if ($first->universitas)
                            <div class="mt-4">
                                <b>Perguruan Tinggi </b>
                                <br>
                                <span>{{ $universitas->nama }}</span>
                            </div>
                        @endif
                        @if ($first->upload_identitas)
                            <div class="mt-4">
                                <b>Dokumen Identitas </b>
                                <br>
                                <a target="_blank" download=""
                                    href="{{ asset(Illuminate\Support\Facades\Crypt::decryptString($first->upload_identitas)) }}"
                                    class="btn btn-success btn-sm"><i class="fas fa-download"></i></a>
                            </div>
                        @endif
                        @if ($first->upload_identitas)
                            <div class="mt-4">
                                <b>Dokumen Bukti </b>
                                <br>
                                <a target="_blank" download=""
                                    href="{{ asset(Illuminate\Support\Facades\Crypt::decryptString($first->upload_bukti)) }}"
                                    class="btn btn-success btn-sm"><i class="fas fa-download"></i></a>
                            </div>
                        @endif
                        @if ($first->ket)
                            <div class="mt-4">
                                <b>Catatan Kenapa Laporan Tidak Sesuai:</b>
                                <br>
                                <span>{{ Illuminate\Support\Facades\Crypt::decryptString($first->ket) }}</span>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
                    <div class="about_single wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.1s"
                        data-wow-offset="0">
                        <div>
                            <b>Nama </b>
                            <br>
                            <span>{{ Illuminate\Support\Facades\Crypt::decryptString($first->nama) }}</span>
                        </div>
                        <div class="mt-4">
                            <b>Kategori </b>
                            <br>
                            <span>{{ Illuminate\Support\Facades\Crypt::decryptString($first->kategori) }}</span>
                        </div>
                        <div class="mt-4">
                            <b>No Hp </b>
                            <br>
                            <span>{{ Illuminate\Support\Facades\Crypt::decryptString($first->no_hp) }}</span>
                        </div>
                        <div class="mt-4">
                            <b>Pelapor </b>
                            <br>
                            <span>{{ Illuminate\Support\Facades\Crypt::decryptString($first->pelapor) }}</span>
                        </div>
                        <div class="mt-4">
                            <b>Tanggal Kejadian </b>
                            <br>
                            @if ($first->tanggal_kejadian)
                                @php
                                    $as = Illuminate\Support\Facades\Crypt::decryptString($first->tanggal_kejadian);
                                @endphp
                                <span>
                                    {{ Carbon\Carbon::parse($as)->locale('id')->diffForHumans() }}
                                </span>
                            @endif
                        </div>
                        <div class="mt-4">
                            <b>Jenis Kekerasan </b>
                            <br>
                            <span>{{ $jenis_kekerasan->tipe_kekerasan }}</span>
                        </div>
                        @if ($first->nama_pendamping)
                            <div class="mt-4">
                                <b>Nama Pendamping </b>
                                <br>
                                <span>{{ Illuminate\Support\Facades\Crypt::decryptString($first->nama_pendamping) }}</span>
                            </div>
                        @endif
                        @if ($first->no_wa_pendamping)
                            <div class="mt-4">
                                <b>No Wa Pendamping </b>
                                <br>
                                <span>{{ Illuminate\Support\Facades\Crypt::decryptString($first->no_wa_pendamping) }}</span>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="mt-4 pl-5 pr-5 pb-4">
                    <b>Kronologi Kejadian </b>
                    <br>
                    <p>{!! Illuminate\Support\Facades\Crypt::decryptString($first->kronologi_kejadian) !!}
                    </p>
                </div>
            </div><!--- END ROW -->
        </div><!--- END CONTAINER -->
    </section>

    <section class="feature section-padding"  id="chat-box">
        <div class="container">
            <div class="section-title text-center wow zoomIn">
                <h2>Progress Laporan </h2>
            </div>
            <div class="row as_box">
                <div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
                    <div class="about_single wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.1s"
                        data-wow-offset="0">
                        <h4 class="text-lg md:text-xl font-semibold text-center text-gray-800 mt-6">
                            Riwayat Status Laporan
                        </h4>
                        @php
                            $urut = 1;
                            $warna = 'pink';
                        @endphp
                        <div class="mytimeline-container">
                            <div class="mytimeline">
                                @foreach ($logs as $data)
                                    <div class="mytimeline-item">
                                        <div class="mytimeline-point"></div>
                                        <div class="mytimeline-content">
                                            <div class="mytimeline-title">Status:
                                                {{ Illuminate\Support\Facades\Crypt::decryptString($data->status_laporan) }}
                                            </div>
                                            <div class="mytimeline-description">
                                                {{ Illuminate\Support\Facades\Crypt::decryptString($data->deskripsi_laporan) }}
                                            </div>
                                            <div class="mytimeline-date">Tanggal Proses:
                                                {{ date('d, F Y', strtotime($data->tanggal_diubah)) }}</div>
                                            <div class="mytimeline-date">Batas Proses: @if ($data->tgl_batas_proses)
                                                    {{ date('d, F Y', strtotime($data->tgl_batas_proses)) }}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
                    <div class="about_single wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.1s"
                        data-wow-offset="0">
                        @php
                            $sta = Illuminate\Support\Facades\Crypt::decryptString($first->status_laporan);
                        @endphp
                        @if ($sta == 'Ditolak')
                        @elseif ($sta == 'Selesai')
                        @else
                            <form method="POST" action="{{ url('kirim_chat') }}">
                                @csrf
                                <h4 class="text-lg md:text-xl font-semibold text-center text-gray-800">
                                    Chat Ke Admin
                                </h4>
                                <div class="space-y-4 max-h-[500px] overflow-y-auto">
                                    @foreach ($chat as $row)
                                        @if ($row->status == 'Admin')
                                            <div class="d-flex " style="justify-content: start;margin-top: 10px;margin-bottom: 10px;">
                                                <div class="bg-secondary  text-white p-4 rounded-lg max-w-full">
                                                    <p class="text-sm" style="font-size: 18px">
                                                        {!! $row->pesan !!}</p>
                                                    <small >{{ date('d, F Y H:i', strtotime($row->created_at)) }}</small>
                                                </div>
                                            </div>
                                        @else
                                            <div class="d-flex" style="justify-content: end;margin-top: 10px;margin-bottom: 10px;">
                                                <div class="text-gray-900 bg-primary p-4 rounded-lg max-w-full"
                                                    style="max-width:  80%">
                                                    <p class="text-sm" style="color: white;font-size: 18px">
                                                        {!! $row->pesan !!}</p>
                                                    <small
                                                        style="color: white">{{ date('d, F Y H:i', strtotime($row->created_at)) }}</small>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <input type="hidden" required class="" value="{{ $ids }}" name="id">
                                @error('id')
                                    <small>{{ $message }}</small>
                                @enderror
                                <div class="mt-6 d-flex align-items-stretch gap-2">
                                    <textarea required name="pesan" class="form-control" placeholder="Ketik pesan..." style="height: 50px; resize: none;">{{ old('pesan') }}</textarea>

                                    <button type="submit" class="btn contact_btn" title="Kirim Pesan"
                                        style="height: 50px;">
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
            </div><!--- END ROW -->
        </div><!--- END CONTAINER -->
    </section>

@endsection
