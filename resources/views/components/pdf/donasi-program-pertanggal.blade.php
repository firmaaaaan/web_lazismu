<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <title>Laporan PDF</title>
        <style>
            #transaksi {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            }

            #transaksi td, #transaksi th {
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
        </style>
    </head>
    <body>
        <!-- Tulis konten HTML Anda di sini -->
        <h3 style="text-align: center">LAPORAN DONASI PERTANGGAL</h3>
        <h4 style="text-align: center">{{ $programDonasi->nama_program }}</h4>
        <table class="" id="transaksi">
            <thead class="bordered">
                <tr>
                    <th>No.</th>
                    <th>Nama Customer</th>
                    <th>Progam Donasi</th>
                    <th>No. Rekening</th>
                    <th>Jumlah Donasi</th>
                    <th>Status Penyaluran</th>
                </tr>
            </thead>
            @php
                $no=1;
            @endphp
            <tbody>
            @foreach ($donasi as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $item->user->name }}</td>
                    <td>{{ $item->programDonasi->nama_program }}</td>
                    <td>{{ $item->no_rek }}</td>
                    <td>{{ $item->jml_donasi }}</td>
                        @if ($item->status_penyaluran=='Belum Tersalurkan')
                            <div>{{ $item->status_penyaluran }}</div>
                        @else
                            <div>{{ $item->status_penyaluran }}</div>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </body>
</html>
