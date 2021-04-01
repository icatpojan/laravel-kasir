{{-- @extends('application.admin', ['title' => "Pembelian - Amanah.com"]) --}}
@extends('aplication.layouts', ['title' => "Pembelian - Amanah.com"])

@section('style')
    <link href="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        th {
            text-align: center;
        }

    </style>
@endsection

@section('content')

    <div class="container-fluid">
        <div class="card mb-2">
            <div class="card-header">
                <h3>SUPPLIER</h3>
            </div>
            <div class="card-body">
                Nama : {{ $Supplier->name }}
                <br>
                Alamat : {{ $Supplier->address }}
                <br>
                Nomor telpon : {{ $Supplier->phone_number }}
                <form action="{{ route('pembelian.kembali') }}" method="get">
                    <button type="submit" class="btn btn-outline-warning">kembali</button>
                </form>
            </div>
        </div>
        {{-- card form --}}
        <div class="card shadow mb-4">
            <div class="d-block card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">KULAKAN BARANG</h6>
                <div class="row">
                    <div class="col-md-11">
                        <div class="form-group">
                            <form action="{{ route('pembelian.store') }}" method="POST">
                                @csrf
                                <input onfocus="this.value=''" type="number" name="barcode" class="form-control"
                                    placeholder="Enter Barcode" id="barcode" autofocus>
                                <input type="hidden" value="{{ $Supplier->id }}" name="supplier_id">
                            </form>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-outline-success btn" data-toggle="modal"
                            data-target="#exampleModal">
                            <i class="fa fa-cart-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-9">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id='userTable' width="100%" cellspacing="0">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>no</th>
                                        <th>Name</th>
                                        <th>jumlah</th>
                                        <th>harga</th>
                                        <th>total harga</th>
                                        <th>aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    @foreach ($Pembelian as $pembelian)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $pembelian->name }}</td>
                                            <td style="width: 3cm">
                                                <form action="{{ route('pembelian.update', $pembelian->id) }}"
                                                    method="post">
                                                    @csrf
                                                    <input style="text-align: center" class="form-control" type="number"
                                                        name="jumlah_product" value="{{ $pembelian->jumlah_product }}"
                                                        name="umlah_product">
                                                </form>
                                            </td>
                                            <td>{{ $pembelian->harga }}</td>
                                            <td>{{ $pembelian->jumlah_harga }}</td>
                                            <td style="text-align: center">
                                                <form action="{{ route('pembelian.destroy', $pembelian->id) }}"
                                                    method="post">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-danger"><i
                                                            class="fas fa-trash-alt"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <table class="table table-bordered table-dark" id='kulakanTable' width="100%" cellspacing="0">
                            <thead class="thead-dark">
                                <tr>
                                    <td style="text-align: center">
                                        {{ $Kulakan->jumlah_harga ?? 'Jumlah Harga' }}
                                    </td>
                                </tr>
                            </thead>
                        </table>
                        <form action="{{ route('pembelian.diskon') }}" method="post">
                            @csrf
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">DISKON</span>
                                </div>
                                <input name="diskon" type="number" value="{{ $Kulakan->diskon ?? 'diskon' }}"
                                placeholder="diskon" class="form-control">
                            </div>
                        </form>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">DIBAYAR</span>
                            </div>
                            <input type="text" placeholder="bayar" value="{{ $Kulakan->bayar ?? 'Bayar' }}" disabled
                                class="form-control">
                        </div>
                        <form action="{{ route('pembelian.confirm') }}" method="POST">
                            @csrf
                            <button type="submit">terima</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
    @include('aplication.components.modal.product')
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> <!-- jQuery CDN -->

    <script src="{{ asset('template/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('template/js/demo/datatables-demo.js') }}"></script>

    {{-- jquery --}}
    <script src="{{ asset('js/script.js') }}"></script>
    {{-- @include('script.pembelian') --}}
@endsection
<!-- Button trigger modal -->
