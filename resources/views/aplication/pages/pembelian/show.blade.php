@extends('layouts.admin', ['title' => "Daftar Produk - Amanah.com"])

@section('style')
    <link href="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-3">
            <div aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <i class="fas fa-home mt-0_5 breadcrumb-item"></i>
                    <li class="breadcrumb-item"> <a class="text-decoration-none" href=""> Home </a> </li>
                    <li class="breadcrumb-item active" aria-current="page"> <a class="text-decoration-none" href="{{route('pembelian.index')}}"> Pembelian</a> </li>
                    <li class="breadcrumb-item active" aria-current="page">Show</li>
                </ol>
            </div>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between py-3">
                <h6 class="m-0 font-weight-bold text-primary">DAFTAR PEMBELIAN</h6>
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
                                <th>merek</th>
                                <th>tanggal</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>nama</th>
                                <th>barcode</th>
                                <th>jumlah produk</th>
                                <th>harga</th>
                                <th>merek</th>
                                <th>tanggal</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($Pembelian as $pembelian)
                                <tr>

                                    <td>{{ $pembelian->name }}</td>
                                    <td>{{ $pembelian->barcode }}</td>
                                    <td>{{ $pembelian->jumlah_product }}</td>
                                    <td>{{ $pembelian->harga }}%</td>
                                    <td>{{ $pembelian->merek }}</td>
                                    <td>{{ $pembelian->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <form action="{{route ('pembelian.index')}}" method="get">
                        <button class="btn btn-warning"type="submit">BALI</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

@endsection

@section('script')

    <script src="{{ asset('template/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/datatables.js') }}"></script>

    {{-- jquery --}}
    <script src="{{ asset('js/script.js') }}"></script>

@endsection
