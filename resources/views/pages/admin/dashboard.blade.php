@extends('layouts.dashboard')

@section('title')
    Admin Dashboard
@endsection

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <a style="text-decoration: none;" href="{{ route('user') }}">
                        <div class="card-icon bg-primary" style="width: 70px">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total User</h4>
                            </div>
                            <div class="card-body">
                                {{ $user }}
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <a style="text-decoration: none;" href="{{ route('tipe.index') }}">
                        <div class="card-icon bg-danger" style="width: 70px">
                            <i class="fas fa-bed"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Kamar Kosong</h4>
                            </div>
                            <div class="card-body">
                                {{ $kamar_kosong }}
                            </div>
                            <p style="color:black;">Dari total {{ $kamar }} kamar</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <a style="text-decoration: none;" href="{{ route('transaksi') }}">
                        <div class="card-icon bg-warning" style="width: 70px">
                            <i class="fas fa-money-bill"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Jumlah Transaksi</h4>
                            </div>
                            <div class="card-body">
                                {{ $bookings }}
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <a style="text-decoration: none;" href="{{ route('pemasukan') }}">
                        <div class="card-icon bg-info" style="width: 70px">
                            <i class="fas fa-wallet"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Pemasukan</h4>
                            </div>
                            <div class="card-body">
                                Rp{{ number_format($total_harga,2,',','.') }}
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success" style="width: 70px">
                        <i class="fas fa-money-bill-alt"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Keuntungan</h4>
                        </div>
                        <div class="card-body">
                            Rp{{ number_format($keuntungan,2,',','.') }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <a style="text-decoration: none;" href="{{ route('pengeluaran.index') }}">
                        <div class="card-icon bg-danger" style="width: 70px">
                            <i class="fas fa-money-bill"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Pengeluaran</h4>
                            </div>
                            <div class="card-body">
                                Rp{{ number_format($pengeluaran,2,',','.') }}
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-md-8 col-8 col-sm-8">
                <div class="card">
                    <div class="card-header">
                    <h4>Statistik Jumlah Transaksi Setiap Bulan</h4>
                    </div>
                    <div class="card-body">
                    <canvas id="myChart" height="100"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-4 col-sm-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Kamar Kosong</h4>
                    </div>
                    <div class="card-body">
                        @foreach ($tipe_kamar as $tipe)
                            @php $arrayTipe = array(); @endphp
                            @foreach ($tipe->kamars->where('status',"Kosong") as $t)
                                @php $arrayTipe[] = $t @endphp
                            @endforeach
                                @php $jum = count($arrayTipe); @endphp
                                <p>{{ $tipe->nama }} : <strong>{{ $jum }}</strong> yang kosong</p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@push('prepend-script')
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($label); ?>,
            datasets: [{
                borderWidth: 3,
                label: 'Jumlah transaksi',
                backgroundColor: [
                    'rgba(229, 229, 229,1)',
                ],
                borderColor: [
                    'rgba(229,229,229,1)',
                ],
                pointBackgroundColor: '#ffffff',
                data: <?php echo json_encode($jumlah_transactions); ?>
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                    }
                }],

            }
        }
    });
</script>
@endpush
