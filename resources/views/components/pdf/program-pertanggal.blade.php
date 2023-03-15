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
        <h2 style="text-align: center">REKAPITULASI ZIS</h2>
        <h2 style="text-align: center">KANTOR LAYANAN LAZISMU BANGUNTAPAN SELATAN</h2>
        <p style="text-align: left">Dari Tanggal<strong>              {{ \Carbon\Carbon::parse($tglAwal)->format('d M Y') }}</strong></p>
        <p style="text-align: left">Sampai Tanggal<strong>            {{ \Carbon\Carbon::parse($tglAkhir)->format('d M Y') }}</strong></p>
        <table class="" id="transaksi">
            <thead class="bordered">
                <tr>
                    <th>No</th>
                    <th>Nama Program</th>
                    <th>Deskripsi Program</th>
                    <th>Tanggal</th>
                    <th>Tersalurkan (Rp)</th>
                    <th>Sisa Donasi (Rp)</th>
                </tr>
            </thead>
            @php
                $no=1;
            @endphp
            <tbody>
            @foreach ($cetakPertanggalProgramDonasi as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $item->nama_program }}</td>
                    <td>{!! $item->deskripsi !!}</td>
                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>
                    <td>{{ number_format($item->tersalurkan , 0, ',', '.') }}</td>
                    <td>{{ number_format($item->jumlah_donasi_program , 0, ',', '.') }}</td>
                </tr>
            @endforeach
                {{-- <tr>
                    <td colspan="4" class="grand total"><b>TOTAL TERSALURKAN(Rp)</b></td>
                    <td class="grand total">{{ number_format($totalTersalurkan , 0, ',', '.') }}</td>
                </tr> --}}
                <tr>
                    <td colspan="4" class="grand total"><b>TOTAL(Rp)</b></td>
                    <td class="grand total"><b>{{ number_format($totalTersalurkan , 0, ',', '.') }}</b></td>
                    <td class="grand total"><b>{{ number_format($sisaDonasi , 0, ',', '.') }}</b></td>
                </tr>
            </tbody>
        </table>
    </body>
</html>
