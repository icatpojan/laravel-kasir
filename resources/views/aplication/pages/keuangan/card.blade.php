<div class="row">
{{-- Total Saldo --}}
    <div class="col-xl-12 col-md-6 mb-4">
        <div class="card border-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-2">
                            Total Saldo</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ 'Rp.' . number_format($saldo) }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-university fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Pemasukan -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-2">
                            penjualan(bulanan kotor)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ 'Rp.' . number_format($jumlah_penjualan) }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-handshake fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Pengeluaran -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-2">
                            Pengeluaran (bulanan)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ 'Rp.' . number_format($jumlah_pengeluaran) }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-university fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-2">
                            Pembelian (bulanan)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ 'Rp.' . number_format($jumlah_pembelian) }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-university fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-2">
                            Laba Bulanan(bulanan)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ 'Rp.' . number_format($bulanan_laba) }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-handshake fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-bottom-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-2">
                            Penjualan (Harian Kotor)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ 'Rp.' . number_format($harian_penjualan) }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-handshake fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Pengeluaran -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-bottom-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-2">
                            Pengeluaran (Harian)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ 'Rp.' . number_format($harian_pengeluaran) }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-university fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Saldo -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-bottom-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-2">
                            Pembelian (Harian)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ 'Rp.' . number_format($harian_pembelian) }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-university fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-2">
                            Laba Harian(harian)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ 'Rp.' . number_format($harian_laba) }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-handshake fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
