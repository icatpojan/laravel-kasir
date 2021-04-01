<div class="modal fade" id="modal-supplier" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="supp">Daftar Suppliert</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>alamat</th>
                            <th>nomor telpon</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Supplier as $supplier)
                            <tr>
                                <td>{{ $supplier->name }}</td>
                                <td>{{ $supplier->address }}</td>
                                <td>{{ $supplier->phone_number }}</td>
                                <td class="text-center">
                                    <form action="{{ route('pembelian.form') }}" method="get">
                                        <input type="hidden" value="{{ $supplier->id }}" name="id">
                                        <button type="submit" class="btn btn-outline-primary btn">
                                            HIYA<a type="button" data-dismiss="modal"></a>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Understood</button>
            </div>
        </div>
    </div>
</div>
