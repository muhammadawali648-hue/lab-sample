<!DOCTYPE html>
<html>
<head>
    <title>Laporan Arsip Preparasi</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        /* ================= KOP ================= */
        .kop {
            width: 100%;
            margin-bottom: 15px;
        }

        .kop table {
            width: 100%;
            border: none;
        }

        .kop td {
            border: none;
            vertical-align: middle;
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

    <!-- ================= KOP SURAT ================= -->
    <div class="kop">
        <table>
            <tr>
                <td width="12%" style="vertical-align: middle; text-align:center;">
    <img src="{{ public_path('Kemenperin.png') }}" 
         style="height: 55px;px; display:block; margin:auto;">
</td>

                <td style="text-align:center;">
                    <div style="font-size:13px;">
                        <b>BADAN STANDARDISASI DAN KEBIJAKAN JASA INDUSTRI</b><br>
                        <b>BALAI BESAR STANDARDISASI</b><br>
                        <b>DAN PELAYANAN JASA INDUSTRI AGRO</b>
                    </div>

                    <div style="font-size:11px; margin-top:4px;">
                        Jl. Ir. H. Juanda No. 11, Bogor 16122<br>
                        Telp: (0251) 8324080, 8323530 &nbsp; Fax: (0251) 8323330<br>
                        Website: www.bbia.go.id &nbsp; Email: cabi@bbia.go.id
                    </div>
                </td>
            </tr>
        </table>

        <!-- GARIS DOUBLE -->
        <hr style="border:1px solid black; margin-top:8px;">
        <hr style="border:2px solid black; margin-top:2px;">
    </div>

    <!-- ================= JUDUL ================= -->
    <h2>LAPORAN ARSIP LAB PREPARASI</h2>

   @if($bulan && $tahun)
    <div class="sub">
        Periode: 
        {{ \Carbon\Carbon::createFromDate($tahun, (int)$bulan, 1)->translatedFormat('F Y') }}
    </div>
@endif

    <!-- ================= TABEL ================= -->
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

    <!-- ================= FOOTER ================= -->
    <div class="footer">
        Total Sampel: {{ $samples->count() }}
        <br>
        Dicetak pada: {{ now()->format('d-m-Y H:i') }}
    </div>

</body>
</html>