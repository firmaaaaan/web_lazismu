<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <title>Laporan PDF</title>
        <style>
        /* Tulis style CSS Anda di sini */
            body {
                font-family: Arial, sans-serif;
            }
            table {
                border-color: black;
                width: 100%;
            }
            th, td {
                text-align: left;
                padding: 8px;
            }
            /* tr:nth-child(even){background-color: #f2f2f2} */
            /* th {
                background-color: #4CAF50;
                color: white;
            } */
            h2{
                text-align: center;
            }
            thead{
                border: 1px
            }
        </style>
    </head>
    <body>
        <!-- Tulis konten HTML Anda di sini -->
        <h3 style="text-align: center">LAPORAN ZAKAT</h3>
        <table class="">
            <thead class="bordered">
                <tr>
                    <th>No.</th>
                    <th>Nama Lengkap</th>
                    <th>Jumlah (Rp)</th>
                    <th>Jumlah (Kg)</th>
                    <th>Jenis Zakat</th>
                    <th>Status Penyaluran</th>
                </tr>
            </thead>
            @php
                $no=1;
            @endphp
            <tbody>
            @foreach ($zakat as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $item->user->name }}</td>
                    <td>{{ $item->nominal }}</td>
                    <td>{{ $item->nominal_beras }}</td>
                    <td>{{ $item->jenis_zakat }}</td>
                    <td>
                        @if ($item->status_penyaluran =='Belum Tersalurkan')
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
