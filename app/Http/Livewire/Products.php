<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Product;
use App\Model\Category;
use Livewire\WithPagination;

class Products extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $name, $harga_beli, $barcode, $harga_jual, $stock, $product_id, $category_id = 1;
    public $updateMode = false;
    public $paginate = 5;
    public function render()
    {
        $Category = Category::all();
        $products = Product::latest()->paginate($this->paginate);
        return view('livewire.products.products', compact('products', 'Category'));
    }
    public function peringatan($message)
    {
        $this->alert('success', $message, [
            'position' =>  'top-end',
            'timer' =>  3000,
            'toast' =>  true,
            'text' =>  '',
            'confirmButtonText' =>  'Ok',
            'cancelButtonText' =>  'Cancel',
            'showCancelButton' =>  true,
            'showConfirmButton' =>  false,
        ]);
    }
    private function resetInputFields()
    {
        $this->name = '';
        $this->stock = '';
        $this->barcode = '';
        $this->category_id = '1';
        $this->harga_jual = '';
        $this->harga_beli = '';
    }

    public function store()
    {
        $validatedDate = $this->validate([
            'name' => 'required',
            'barcode' => 'required|unique:products',
            'harga_jual' => 'required',
            'harga_beli' => 'required',
            'category_id' => 'required',
        ]);
        Product::create($validatedDate);
        $this->peringatan('berhasil menambah product');
        $this->resetInputFields();
        $this->emit('productStore'); // Close model to using to jquery

    }

    public function edit($id)
    {
        $this->updateMode = true;
        $product = Product::where('id', $id)->first();
        $this->product_id = $id;
        $this->name = $product->name;
        $this->category_id = $product->category_id;
        $this->barcode = $product->barcode;
        $this->stock = $product->stock;
        $this->harga_beli = $product->harga_beli;
        $this->harga_jual = $product->harga_jual;
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function update()
    {
        $validatedDate = $this->validate([
            'name' => 'required',
            'barcode' => 'required',
            'harga_jual' => 'required',
            'harga_beli' => 'required',
            'category_id' => 'required',
        ]);

        if ($this->product_id) {
            $product = Product::find($this->product_id);
            $product->update([
                'name' => $this->name,
                'barcode' => $this->barcode,
                'stock' => $this->stock,
                'category_id' => $this->category_id,
                'harga_beli' => $this->harga_beli,
                'harga_jual' => $this->harga_jual,
            ]);
            $this->updateMode = false;
            $this->peringatan('berhasil mengupdate product');
            $this->resetInputFields();
        }
    }

    public function delete($id)
    {
        if ($id) {
            Product::where('id', $id)->delete();
            $this->peringatan('berhasil menghapus product');
        }
    }
}
