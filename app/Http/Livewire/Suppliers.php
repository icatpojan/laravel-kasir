<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Model\Supplier;
use Livewire\WithPagination;

class Suppliers extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $name,$address,$phone_number, $supplier_id;
    public $updateMode = false;
    public $paginate = 5;
    public function render()
    {
        $suppliers = Supplier::latest()->paginate($this->paginate);
        return view('livewire.suppliers.suppliers', compact('suppliers'));
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
    }

    public function store()
    {
        $validatedDate = $this->validate([
            'name' => 'required',
            'address' => 'required',
            'phone_number' => 'required',
        ]);
        Supplier::create($validatedDate);
        $this->peringatan('berhasil menambah supplier');
        $this->resetInputFields();
        $this->emit('supplierStore'); // Close model to using to jquery

    }

    public function edit($id)
    {
        $this->updateMode = true;
        $supplier = Supplier::where('id', $id)->first();
        $this->supplier_id = $id;
        $this->name = $supplier->name;
        $this->address = $supplier->address;
        $this->phone_number = $supplier->phone_number;
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
            'address' => 'required',
            'phone_number' => 'required',
        ]);

        if ($this->supplier_id) {
            $supplier = Supplier::find($this->supplier_id);
            $supplier->update([
                'name' => $this->name,
                'address' => $this->address,
                'phone_number' => $this->phone_number,
            ]);
            $this->updateMode = false;
            $this->peringatan('berhasil mengupdate supplier');
            $this->resetInputFields();
        }
    }

    public function delete($id)
    {
        if ($id) {
            Supplier::where('id', $id)->delete();
            $this->peringatan('berhasil menghapus supplier');
        }
    }
}
