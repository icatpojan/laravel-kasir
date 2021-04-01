@extends('aplication.layouts')

@section('style')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item active">{{ 'show' }}</li>
@endsection

@section('style')
    @include('aplication.css.datatable')
@endsection

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between py-3">
                <h6 class="m-0 font-weight-bold text-primary">DAFTAR PENJUALAN</h6>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>nama</th>
                                <th>barcode</th>
                                <th>jumlah produk</th>
                                <th>harga</th>
                                <th>jumlah harga</th>
                                <th>tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Cart as $cart)
                                <tr>

                                    <td>{{ $cart->name }}</td>
                                    <td>{{ $cart->barcode }}</td>
                                    <td>{{ $cart->jumlah_product }}</td>
                                    <td>{{ $cart->jual }}</td>
                                    <td>{{ $cart->jumlah_harga }}</td>
                                    <td>{{ $cart->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <form action="{{ route('laporan.index') }}" method="get">
                        <button class="btn btn-warning" type="submit">BALI</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

@endsection

@section('script')
    @include('aplication.script.datatable')
    {{-- jquery --}}
    <script src="{{ asset('js/script.js') }}"></script>
@endsection
