<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utransaction-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Invoice {{ $now->format('d-m-Y') }}</title>
  </head>
  <body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h4 class="text-secondary"><u>{{ $now->format('d-m-Y') }}</u></h4>
            </div>
        </div>
        <hr class="mb-3">
        <div class="row">
            <div class="col-md-12">
                <div style="text-align: center;">
                    <div>
                        <strong>Rincian Tagihan Pemesanan </strong>
                        @if ($transaction->status == "Sukses")
                        <p>Simpan Struk dan Bawa Saat Datang ke Kos</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row my-3">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table border="1" width="100%" cellspacing="0" cellpadding="10" class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col" colspan="4"><strong>#</strong>
                                    {{ $transaction->kode }}
                                </th>
                                <th scope="col" colspan="4">
                                    {{ $now->format('d-m-Y') }}
                                </th>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <b>Penyewa: </b>
                                    <p>{{ $transaction->user->name }}<br>
                                        {{ $transaction->user->no_hp }}<br>
                                        {{ $transaction->user->email }}<br>
                                    </p>
                                </td>
                                <td colspan="4">
                                    <b>Kamar: </b>
                                    <p>{{ $transaction->kamar->tipe_kamar->nama }}
                                    {{ $transaction->kamar->nomor_kamar }}</p>
                                        <p>Tanggal Order :
                                            <?php
                                                $date = new DateTime($transaction->tanggal_pesan);
                                                echo $date->format('d F Y H:i:s');
                                            ?>
                                        </p>
                                        <p>Durasi sewa : {{ $transaction->durasi }} Bulan</p>
                                        <p>Tanggal Masuk :
                                            <?php
                                                $date = new DateTime($transaction->tanggal_masuk);
                                                echo $date->format('d F Y');
                                            ?>
                                        <p>Tanggal Keluar :
                                            <?php
                                                $date = new DateTime($transaction->tanggal_keluar);
                                                echo $date->format('d F Y');
                                            ?>
                                        </p>
                                </td>
                            </tr>
                        </thead>
                        @if($transaction->status == "Sukses")
                        <tbody>
                            <tr>
                                <th scope="col" colspan="4">Status Pemesanan</th>
                                <th scope="col" colspan="4">
                                    <span class="badge badge-success">Sukses</span>
                                </th>
                            </tr>
                        </tbody>
                        @endif
                        <tfoot>
                            <tr>
                                <th scope="col" colspan="4">Total Bayar</th>
                                <td colspan="4">
                                Rp {{ number_format($transaction->total_harga,2,',','.') }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
  </body>
</html>
