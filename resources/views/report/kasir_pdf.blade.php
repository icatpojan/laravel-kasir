<!DOCTYPE html>
<html>

<head>
    <title>Laporan keuangan Amanah Mart</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 9pt;
        }

        h1 {
            text-align: center
        }

    </style>

</head>

<body>
    <h1>NOTA PEMBELIAN</h1>
    <img src="{{ asset('img\banner-bg.jpg') }}" alt="">
    <table class='table table-bordered'>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Debit</th>
                <th>Kredit</th>
                <th>Saldo</th>
            </tr>
        </thead>
        <tbody>
            @php $i=1 @endphp
            @foreach ($Cart as $p)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $p->created_at }}</td>
                    <td>{{ $p->keterangan }}</td>
                    <td>{{ $p->debit }}</td>
                    <td>{{ $p->kredit }}</td>
                    <td>{{ $p->saldo }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
