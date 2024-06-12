<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  </head>
  <body>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Kode Pemesanan</th>
                <th scope="col">Nama Pemesan</th>
                <th scope="col">Tanggal Transaksi</th>
                <th scope="col">Pemasukan</th>
            </tr>
        </thead>
        @foreach ($pemesanans as $index => $tf)
            <tr>
                <td>{{ $index+1 }}</td>
                <td>{{ $tf->kode }}</td>
                <td>{{ $tf->user->name }}</td>
                <td>{{ $tf->tanggal_pesan }}</td>
                <td style="text-align: right;">
                    <span>Rp {{ number_format($tf->kamar->tipe_kamar->harga,2,',','.') }}</span>
                </td>
            </tr>
        @endforeach
    </table>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>
