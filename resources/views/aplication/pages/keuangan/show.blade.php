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
                            <th>no</th>
                            <th>tanggal</th>
                            <th>jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1 ?>
                        @foreach ($row as $value)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $value->tanggal }}</td>
                                <td>{{ number_format($value->penjualan, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- {{ $row->links() }} --}}
                <form action="{{route ('keuangan.index')}}" method="get">
                    <button class="btn btn-outline-warning"type="submit">BALI</button>
                </form>
            </div>
        </div>
    </div>
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
