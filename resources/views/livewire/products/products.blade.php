<div>
    @include('livewire.products.update')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">@include('livewire.products.create')</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            @include('livewire.components.paginate')
            <table id="example1" class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>barcode</th>
                        <th>stock</th>
                        <th>Katagori</th>
                        <th>Harga Jual</th>
                        <th>Harga Beli</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    @foreach ($products as $value)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->barcode }}</td>
                            <td>{{ $value->stock }}</td>
                            <td>{{ $value->category->name }}</td>
                            <td>{{ $value->harga_jual }}</td>
                            <td>{{ $value->harga_beli }}</td>
                            <td>
                                <button data-toggle="modal" data-target="#updateModal"
                                    wire:click="edit({{ $value->id }})" class="btn btn-primary btn-sm">Edit</button>
                                <button wire:click="delete({{ $value->id }})"
                                    class="btn btn-danger btn-sm">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-2">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
