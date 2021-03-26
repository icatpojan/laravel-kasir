<div>
    <form wire:submit.prevent="update">
        <input type="hidden" wire:model="userId">
        <div class="form-group">
            <div class="form-row">
                <div class="col">
                    <input type="text" class="form-control @error('name')
                    is-invalid  @enderror" wire:model="name" placeholder="name" >
                    @error('name')
                    <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col">
                    <input type="text" class="form-control @error('email')
                    is-invalid  @enderror" wire:model="email" placeholder="email">
                    @error('email')
                    <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-sm btn-primary mb-3">Submit
            </button>
    </form>
</div>
