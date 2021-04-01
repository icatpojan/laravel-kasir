<div class="card shadow mb-4">
    <div class="card-header d-flex justify-content-between py-3">
        <h6 class="m-0 font-weight-bold text-primary">PRODUK TERJUAL</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <form action="{{ route('laporan.index') }}" method="get">
                <div class="row">
                    <div class="col">
                        <input type="date" name="awal" class="form-control mt-2 mb-2" required>
                    </div>
                    <div class="col">
                        <input type="date" name="akhir" class="form-control mt-2 mb-2" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-outline-warning mb-2">Tampilkan</button>
            </form>
            <table id="example2" class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>tanggal</th>
                        <th>produk terjual</th>
                        <th>hasil penjualan(kotor)</th>
                        <th>laba</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($row != null)
                        @foreach ($row as $value)
                            <tr>
                                <td>{{ $value->tanggal }}</td>
                                <td>{{ number_format($value->penjualan, 0, ',', '.') }}</td>
                                <td>{{ number_format($value->pembelian, 0, ',', '.') }}</td>
                                <td>{{ number_format($value->laba, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="window.print()"><i
                class="fas fa-download fa-sm text-white-50"></i> CETAK LAPORAN</a>
        {{-- <a href="{{ route('cetak.keuangan') }}" class="btn btn-success mt-3" target="_blank">CETAK LAPORAN</a> --}}
    </div>
</div>
