<style>
    table {
        border: 1px solid black;
    }
    
    tr td,
    tr,
    th {
        border: 1px solid black;

    }


</style>
<h1 style="text-align: center">LAPORAN MASUK CRS</h1>
<h4 style="text-align: center">Laporan CRS mulai dari {{ $mulai }} sampai {{ $akhir }}</h4>
<table style="border: 1px solid black">
    <thead>
        <tr>
            <th>ID</th>
            <th>Kode Laporan</th>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>Email</th>
            <th>Universitas</th>
            <th>No Hp</th>
            <th>Jenis Identitas</th>
            <th>No Identitas</th>
            <th>Tanggal Kejadian</th>
            <th>Lokasi Kejadian</th>
            <th>Jenis Kekerasan</th>
            <th>Pelapor</th>
            <th>Kategori</th>
            <th>Nama Pendamping</th>
            <th>No Wa Pendamping</th>
            <th>Status</th>
            <th>Deskripsi Laporan</th>
            <th>Kronologi Kejadian</th>
            <th>Tanggal Dibuat</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($laporan as $index => $item)
            @php
                $jenis_identitas = App\Models\DokumenIdentitas::where('id', $item->jenis_identitas)->first();
                $jenis_kekerasan = App\Models\Kekerasan::where('id', $item->jenis_kekerasan)->first();
            @endphp
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->kode_laporan }}</td>
                @if ($item->nama)
                    <td>{{ Crypt::decryptString($item->nama) }}</td>
                @else
                    <td></td>
                @endif

                @if ($item->jenis_kelamin)
                    <td>{{ Crypt::decryptString($item->jenis_kelamin) }}</td>
                @else
                    <td></td>
                @endif

                @if ($item->email)
                    <td>{{ Crypt::decryptString($item->email) }}</td>
                @else
                    <td></td>
                @endif
                

                @if ($item->universitasRel)
                    <td>{{ $item->universitasRel->nama }}</td>
                @else
                    <td></td>
                @endif
                

                @if ($item->no_hp)
                    <td>{{ Crypt::decryptString($item->no_hp) }}</td>
                @else
                    <td></td>
                @endif

                @if ($jenis_identitas)
                    <td>{{ $jenis_identitas->jenis_identitas }}</td>
                @else
                    <td></td>
                @endif

                @if ($item)
                    <td>{{  Crypt::decryptString($item->no_identitas) }}</td>
                @else
                    <td></td>
                @endif


                @if ($item->tanggal_kejadian)
                    <td>{{ Crypt::decryptString($item->tanggal_kejadian) }}</td>
                @else
                    <td></td>
                @endif

                @if ($item->lokasi_kejadian)
                    <td>{{ Crypt::decryptString($item->lokasi_kejadian) }}</td>
                @else
                    <td></td>
                @endif

                
                @if ($jenis_kekerasan)
                    <td>{{  $jenis_kekerasan->tipe_kekerasan }}</td>
                @else
                    <td></td>
                @endif

                @if ($item->pelapor)
                    <td>{{ Crypt::decryptString($item->pelapor) }}</td>
                @else
                    <td></td>
                @endif

                @if ($item->kategori)
                    <td>{{ Crypt::decryptString($item->kategori) }}</td>
                @else
                    <td></td>
                @endif

                @if ($item->nama_pendamping)
                    <td>{{ Crypt::decryptString($item->nama_pendamping) }}</td>
                @else
                    <td></td>
                @endif

                @if ($item->no_wa_pendamping)
                    <td>{{ Crypt::decryptString($item->no_wa_pendamping) }}</td>
                @else
                    <td></td>
                @endif

                @if ($item->status_laporan)
                    <td>{{ Crypt::decryptString($item->status_laporan) }}</td>
                @else
                    <td></td>
                @endif

                @if ($item->deskripsi_laporan)
                    <td>{{ Crypt::decryptString($item->deskripsi_laporan) }}</td>
                @else
                    <td></td>
                @endif

                @if ($item->kronologi_kejadian)
                    <td>{!! Crypt::decryptString($item->kronologi_kejadian) !!}</td>
                @else
                    <td></td>
                @endif
                  @if ($item->created_at)
                    <td>{{$item->created_at }}</td>
                @else
                    <td></td>
                @endif
            </tr>
        @endforeach
        
    </tbody>
</table>
