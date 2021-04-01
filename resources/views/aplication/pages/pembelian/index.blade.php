@extends('aplication.layouts')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item active">{{ $title }}</li>
@endsection

@section('style')
    <link href="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-3">
                <ol class="breadcrumb">
                    <i class="fas fa-home mt-0_5 breadcrumb-item"></i>
                    <li class="breadcrumb-item"> <a class="text-decoration-none" href=""> Home </a> </li>
                    <div aria-label="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page"> Pembelian </li>
                </ol>
            </div>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between py-3">
                <h6 class="m-0 font-weight-bold text-primary">DAFTAR PEMBELIAN</h6>

                {{-- <a class="btn-primary btn-sm" href="{{ route('pembelian.form') }}"><i class="fas fa-plus"></i></a> --}}
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-supplier">
                    <i class="fas fa-plus"></i>
                </button>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Penangung jawab</th>
                                <th>jumlah harga</th>
                                <th>diskon</th>
                                <th>total bayar</th>
                                <th>tanggal beli</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1?>
                            @foreach ($Kulakan as $kulakan)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $kulakan->user->name }}</td>
                                    <td>{{ $kulakan->jumlah_harga }}</td>
                                    <td>{{ $kulakan->diskon }}%</td>
                                    <td>{{ $kulakan->bayar }}</td>
                                    <td>{{ $kulakan->created_at }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('pembelian.show', $kulakan->id) }}" method="get">
                                            <button type="submit" class="btn btn-success"><i
                                                    class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end">
                        {{-- {{$User->links()}} --}}
                    </div>
                </div>
            </div>
        </div>

        @include('aplication.components.modal.supplier')

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
