<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Create
</button>

<!-- Modal -->
<div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Supplier Baru</h5>
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
                        <label for="exampleFormControlInput2">Address</label>
                        <input type="text" class="form-control" id="exampleFormControlInput2"
                            placeholder="Enter address" wire:model="address">
                        @error('address') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput3">Nomor Telpon</label>
                        <input type="number" class="form-control" id="exampleFormControlInput3"
                            placeholder="Enter phone_number" wire:model="phone_number">
                        @error('phone_number') <span class="text-danger error">{{ $message }}</span>@enderror
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
