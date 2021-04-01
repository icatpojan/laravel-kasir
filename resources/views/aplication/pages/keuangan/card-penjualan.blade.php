<div class="card shadow mb-4">
    <div class="card-header d-flex justify-content-between py-3">
        <h6 class="m-0 font-weight-bold text-primary">PENJUALAN PER CATEGORY</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <form action="{{ route('keuangan.per') }}" method="get">
                <div class="row">
                    <div class="col">
                        <input type="date" name="awal" class="form-control mt-2 mb-2" required>
                    </div>
                    <div class="col">
                        <input type="date" name="akhir" class="form-control mt-2 mb-2" required>
                    </div>
                    <div class="col mt-2">
                        <select class="form-control" id="category_id" name="category_id">
                            @foreach ($Category as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-outline-warning mb-2">Tampilkan</button>

            </form>
        </div>
    </div>
