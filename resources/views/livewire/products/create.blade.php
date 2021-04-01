<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Create
</button>

<!-- Modal -->
<div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Product Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Name</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter Name"
                            wire:model="name">
                        @error('name') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Barcode</label>
                        <input type="number" class="form-control" id="exampleFormControlInput1"
                            placeholder="Enter barcode" wire:model="barcode">
                        @error('barcode') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput6">katagori</label>
                        <select class="form-control" id="category_id" wire:model="category_id">
                            @foreach ($Category as $category)
                                <option value="{{ $category->id }}" selected>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput3">Harga Beli</label>
                        <input type="number" class="form-control" id="exampleFormControlInput3" wire:model="harga_beli"
                            placeholder="beli berapa">
                        @error('harga_beli') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput2">Harga Jual</label>
                        <input type="number" class="form-control" id="exampleFormControlInput2" wire:model="harga_jual"
                            placeholder="Jual berapa">
                        @error('harga_jual') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="store()" class="btn btn-primary close-modal">Save
                    changes</button>
            </div>
        </div>
    </div>
</div>
