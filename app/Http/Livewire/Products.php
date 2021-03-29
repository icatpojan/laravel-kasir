<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Product;
use Livewire\WithPagination;

class Products extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $name, $harga_beli, $harga_jual, $stock, $product_id;
    public $updateMode = false;
    public $paginate = 5;
    public function render()
    {
        $products = Product::latest()->paginate($this->paginate);
        return view('livewire.products.products', compact('products'));
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
        $this->harga_jual = '';
        $this->harga_beli = '';
    }

    public function store()
    {
        $validatedDate = $this->validate([
            'name' => 'required',
            'harga_jual' => 'required',
            'harga_beli' => 'required',
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
            'harga_jual' => 'required',
            'harga_beli' => 'required',
        ]);

        if ($this->product_id) {
            $product = Product::find($this->product_id);
            $product->update([
                'name' => $this->name,
                'stock' => $this->stock,
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
