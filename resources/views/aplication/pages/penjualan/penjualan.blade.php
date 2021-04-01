@extends('aplication.layouts')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item active">{{ $title }}</li>
@endsection
@section('style')
    @include('aplication.css.datatable')
@endsection

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">


        @include('aplication.pages.penjualan.card')

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between py-3">
                <h6 class="m-0 font-weight-bold text-primary">PENJUALAN PERUSAHAAN </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>kasir</th>
                                <th>jumlah</th>
                                <th>dibayar</th>
                                <th>Dibuat</th>
                                <th>aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Penjualan as $value)
                                <tr>
                                    <td>{{ $value->id }}</td>
                                    <td>{{ $value->user->name }}</td>
                                    <td>{{ number_format($value->jumlah_harga, 0, ',', '.') }}</td>
                                    <td>{{ number_format($value->dibayar, 0, ',', '.') }}</td>
                                    <td>{{ $value->created_at }}</td>
                                    <td>
                                        <form action="{{ route('laporan.show', $value->id) }}" method="get">
                                            <button type="submit" class="btn btn-outline-warning">Lihat</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <a href="{{ route('cetak.penjualan') }}" class="btn btn-primary mb-2" target="_blank">CETAK LAPORAN</a>
        @include('aplication.pages.penjualan.laporpenjualan')
    </div>
    <!-- /.container-fluid -->

@endsection

@section('script')
{{-- jquery --}}
<script src="{{ asset('js/script.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
@include('aplication.script.datatable')
@endsection
