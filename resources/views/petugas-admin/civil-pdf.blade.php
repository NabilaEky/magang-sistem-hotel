<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        .title {
            text-align: center;
        }

        .title h2 {
            margin: 0;
        }

        .title p {
            margin: 2px;
            font-size: 11px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table th {
            background: #2563eb;
            color: white;
            padding: 6px;
            border: 1px solid #000;
        }

        table td {
            padding: 6px;
            border: 1px solid #000;
            text-align: center;
        }

        .ket {
            text-align: left;
        }

        img {
            width: 70px;
        }
    </style>

</head>

<body>

    <div class="title">

        <h2>CIVIL REPAIR MAINTENANCE</h2>

        <p>PATRA SEMARANG HOTEL & CONVENTION</p>

        <p>
            {{ $month 
        ? strtoupper(\Carbon\Carbon::parse($month)->format('F Y')) 
        : strtoupper(date('F Y')) 
    }}
        </p>

    </div>

    <table>

        <thead>

            <tr>

                <th>NO</th>
                <th>TGL</th>
                <th>LOKASI</th>
                <th>PEKERJAAN</th>
                <th>TEMUAN</th>
                <th>PROGRESS</th>
                <th>SELESAI</th>
                <th>KETERANGAN</th>
                <th>PETUGAS</th>

            </tr>

        </thead>

        <tbody>

            @foreach($data as $item)

            <tr>

                <td>{{ $loop->iteration }}</td>

                <td>
                    {{ \Carbon\Carbon::parse($item->tgl)->format('d-m-Y') }}
                </td>

                <td>{{ $item->lokasi }}</td>

                <td>{{ $item->pekerjaan }}</td>

                <td>
                    @if($item->gambar_temuan)
                    <img src="{{ public_path('storage/'.$item->gambar_temuan) }}">
                    @endif
                </td>

                <td>
                    @if($item->gambar_progress)
                    <img src="{{ public_path('storage/'.$item->gambar_progress) }}">
                    @endif
                </td>

                <td>
                    @if($item->gambar_selesai)
                    <img src="{{ public_path('storage/'.$item->gambar_selesai) }}">
                    @endif
                </td>

                <td class="ket">
                    {{ $item->keterangan }}
                </td>

                <td>
                    {{ $item->petugas }}
                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

</body>

</html>