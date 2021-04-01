{{-- modal --}}
<div class="modal fade" id="modal-barang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Barcode</th>
                                <th>Nama</th>
                                <th>merek</th>
                                <th>stok</th>
                                <th>harga beli</th>
                                <th>harga_jual</th>
                                <th>diskon</th>
                                <th>kategori</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Product as $produk)
                                <tr>
                                    <td>{{ $produk->barcode }}</td>
                                    <td>{{ $produk->name }}</td>
                                    <td>{{ $produk->merek }}</td>
                                    <td>{{ $produk->stock }}</td>
                                    <td>{{ $produk->harga_beli }}</td>
                                    <td>{{ $produk->harga_jual }}</td>
                                    <td>{{ $produk->diskon }}</td>
                                    <td>{{ $produk->category_id }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('penjualan.store')}}" method="POST">
                                            @csrf
                                            <input  type="hidden" name="barcode"
                                                class="form-control" value="{{ $produk->barcode }}">
                                            <button type="submit" class="btn btn-outline-primary btn">
                                                MASUK<a type="button" data-dismiss="modal"></a>
                                            </button>
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
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- modal --}}
