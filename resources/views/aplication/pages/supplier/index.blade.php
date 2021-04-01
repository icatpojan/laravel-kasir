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
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-header">
                        <h3 class="card-title">User CRUD</h3>
                    </div>
                    <div class="card-body">
                        @livewire('suppliers')
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        window.livewire.on('supplierStore', () => {
            $('#exampleModal').modal('hide');
        });
    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    {{-- @include('aplication.script.animasi') --}}
    @include('aplication.script.datatable')
@endsection
