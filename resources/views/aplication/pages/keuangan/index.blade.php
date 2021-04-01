@extends('aplication.layouts')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item active">{{ $title }}</li>
@endsection
@section('css')
    @include('aplication.css.datatable')
@endsection
@section('content')
<div class="container-fluid">
    @include('aplication.pages.keuangan.card')
    @include('aplication.pages.keuangan.card-penjualan')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between py-3">
            <h6 class="m-0 font-weight-bold text-primary">KEUANGAN PERUSAHAAN </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead  class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Keterangan</th>
                            <th>debit</th>
                            <th>Kredit</th>
                            <th>Saldo</th>
                            <th>Laba</th>
                            <th>Dibuat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1 ?>
                        @foreach ($Keuangan as $value)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $value->keterangan }}</td>
                                <td>{{ number_format($value->debit, 0, ',', '.') }}</td>
                                <td>{{ number_format($value->kredit, 0, ',', '.') }}</td>
                                <td>{{ number_format($value->saldo, 0, ',', '.') }}</td>
                                <td>{{ number_format($value->laba, 0, ',', '.') }}</td>
                                <td>{{ $value->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $Keuangan->links() }}
            </div>
            <a href="{{ route('cetak.keuangan') }}" class="btn btn-outline-primary" target="_blank">CETAK LAPORAN</a>
        </div>
    </div>
    @include('aplication.pages.keuangan.card-laporan')
</div>

@endsection

@section('script')
    <script type="text/javascript">
        window.livewire.on('productStore', () => {
            $('#exampleModal').modal('hide');
        });
    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    {{-- @include('aplication.script.animasi') --}}
    @include('aplication.script.datatable')
@endsection
