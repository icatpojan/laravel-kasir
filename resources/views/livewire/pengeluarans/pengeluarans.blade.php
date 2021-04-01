<div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">@include('livewire.pengeluarans.create')</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            @include('livewire.components.paginate')
            <table id="example1" class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>No.</th>
                        <th>Keterangan</th>
                        <th>kredit</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    @foreach ($pengeluarans as $value)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $value->keterangan }}</td>
                            <td>{{ $value->kredit }}</td>
                            <td>
                                <button wire:click="delete({{ $value->id }})"
                                    class="btn btn-danger btn-sm">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-2">
                {{ $pengeluarans->links() }}
            </div>
        </div>
    </div>
</div>
