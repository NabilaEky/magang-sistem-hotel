<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Daily Work</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .title {
            text-align: center;
            background-color: #1E40AF;
            color: #fff;
            font-weight: bold;
            font-size: 16px;
            padding: 8px;
            border: 1px solid #000;
        }
        .info {
            margin-top: 10px;
            margin-bottom: 10px;
        }
        .info div {
            margin: 4px 0;
            font-weight: bold;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th {
            background-color: #93C5FD;
            font-weight: bold;
            text-align: center;
        }
        td {
            padding: 4px;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="title">Daily Work</div>

    <div class="info">
        <div>ENGINEERING DEPARTMENT</div>
        <div>&nbsp;</div> <!-- spasi -->
        <div>Tanggal Cetak: {{ now()->format('d M Y') }}</div>
        <div>Periode: - &nbsp; Status: -</div>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Jam</th>
                <th>Lokasi</th>
                <th>Problem</th>
                <th>Petugas</th>
                <th>Status</th>
                <th>Material</th>
                <th>Keterangan</th>
                <th>Paraf SPV</th>
            </tr>
        </thead>
        <tbody>
            @foreach($keluhans as $k)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $k->jenis_masalah }}</td>
                <td>{{ $k->created_at?->format('H:i') }}</td>
                <td>{{ $k->lokasi }}</td>
                <td>{{ $k->kategori ?? '-' }}</td>
                <td>{{ $k->petugas }}</td>
                <td>{{ $k->status }}</td>
                <td>-</td>
                <td>{{ $k->prioritas }}</td>
                <td></td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>