<!DOCTYPE html>
<html>
<head>
    <title>Laporan Arsip Preparasi</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        h2 {
            text-align: center;
            margin-bottom: 5px;
        }

        .sub {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 6px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .footer {
            margin-top: 20px;
            font-size: 11px;
        }
    </style>
</head>
<body>

    <h2>LAPORAN ARSIP LAB PREPARASI</h2>

   @if($bulan && $tahun)
    <div class="sub">
        Periode: 
        {{ \Carbon\Carbon::createFromDate($tahun, (int)$bulan, 1)->translatedFormat('F Y') }}
    </div>
@endif
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nomor Sample</th>
                <th>Nama Sample</th>
                <th>Lab</th>
                <th>Tanggal Masuk</th>
                <th>Stok</th>
            </tr>
        </thead>
        <tbody>
            @forelse($samples as $key => $sample)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $sample->nomor_sample }}</td>
                <td>{{ $sample->nama_sample }}</td>
                <td>{{ $sample->lab_tujuan }}</td>
                <td>{{ \Carbon\Carbon::parse($sample->tanggal_masuk)->format('d-m-Y') }}</td>
                <td>{{ $sample->stok }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6">Tidak ada data pada periode ini</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Total Sampel: {{ $samples->count() }}
        <br>
        Dicetak pada: {{ now()->format('d-m-Y H:i') }}
    </div>

</body>
</html>