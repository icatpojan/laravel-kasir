<!-- Modal -->
<div wire:ignore.self class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Suppleir</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" wire:click.prevent="cancel()">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <input type="hidden" wire:model="supplier_id">
                        <label for="exampleFormControlInput1">Name</label>
                        <input type="text" class="form-control" wire:model="name" id="exampleFormControlInput1" placeholder="Enter Name">
                        @error('name') <span class="text-danger">{{ $message }}</span>@enderror
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
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="update()" class="btn btn-primary" data-dismiss="modal">Save changes</button>
            </div>
       </div>
    </div>
</div>
