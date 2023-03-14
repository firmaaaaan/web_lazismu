<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <title>Laporan PDF</title>
        <style>
            body {
            color: #001028;
            background: #FFFFFF;
            font-family: Arial, sans-serif;
            font-size: 12px;
            font-family: Arial;
            }
            #transaksi {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            }

            #transaksi th {
            border: 1px solid #ddd;
            padding: 8px;
            }

            #transaksi tr:nth-child(even){background-color: #f2f2f2;}

            #transaksi tr:hover {background-color: #ddd;}

            #transaksi th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
            }
            #notices {
                color: #5d6975;
                margin-top: 4px;
            }
            p {
                margin-bottom: 3px; /* mengatur padding bawah paragraf sebesar 20 piksel */
                display: flex; /* mengatur display paragraf menjadi flex */
                align-items: center; /* mengatur align-items paragraf menjadi center */
                text-align: right; /* mengatur text-align elemen strong menjadi right */
                margin-right: 10px; /* mengatur margin-right elemen strong menjadi 10 piksel */
            }
        </style>
    </head>
    <body>
        <!-- Tulis konten HTML Anda di sini -->
        <h6 style="text-align: center">REKAPITULASI ZIS</h4>
        <h6 style="text-align: center">KANTOR LAYANAN LAZISMU BANGUNTAPAN SELATAN</h6>
        <p style="text-align: left">Jenis Program<strong>             {{ $programDonasi->nama_program }}</strong></p>
        <p style="text-align: left">Dari Tanggal<strong>              {{ \Carbon\Carbon::parse($tglAwal)->format('d M Y') }}</strong></p>
        <p style="text-align: left">Sampai Tanggal<strong>            {{ \Carbon\Carbon::parse($tglAkhir)->format('d M Y') }}</strong></p>
        <table class="" id="transaksi">
            <thead class="bordered">
                <tr>
                    <th>No.</th>
                    <th>Nama Donatur</th>
                    <th>Progam Donasi</th>
                    <th>Tanggal Donasi</th>
                    <th>Status Penyaluran</th>
                    <th>Keterangan</th>
                    <th>Jumlah Donasi (Rp)</th>
                </tr>
            </thead>
            @php
                $no=1;
            @endphp
            <tbody>
            @foreach ($cetakProgramDanAkunPertanggal as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>
                        @if ($item->user_id)
                            {{ $item->user->name }}
                        @else
                            {{ $item->nama_donatur }}
                        @endif
                    </td>
                    <td>{{ $item->programDonasi->nama_program }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>
                        @if ($item->status_penyaluran=='Belum Tersalurkan')
                            <td>{{ $item->status_penyaluran }}</td>
                        @else
                            <td>{{ $item->status_penyaluran }}</td>
                        @endif
                        <td>{!! $item->keterangan !!}</td>
                    <td>{{ number_format($item->jml_donasi, 0,',','.') }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="6"><b>SUBTOTAL(Rp)</b></td>
                <td class="total">{{ number_format($totalDonationForProgram, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="6"><b>PENGELUARAN(Rp)</b></td>
                <td class="total">{{ number_format($programDonasi->tersalurkan, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="6" class="grand total"><b>TOTAL(Rp)</b></td>
                <td class="grand total">{{ number_format($programDonasi->jumlah_donasi_program , 0, ',', '.') }}</td>
            </tr>
            </tbody>
        </table>
        <div  class="mt-3" id="notices">
        <div>CATATAN:</div>
            <div class="notice">
                Jika nominal total berbeda dengan nominal subtotal dengan pengeluaran 0 maka perhatikan pada menu log transaksi, bisa jadi anda telah melakukan perpindahan saldo
            </div>
        </div>
    </body>
</html>
