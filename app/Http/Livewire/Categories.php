<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Model\Category;
use Livewire\WithPagination;

class Categories extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $name, $category_id;
    public $updateMode = false;
    public $paginate = 5;
    public function render()
    {
        $categories = Category::latest()->paginate($this->paginate);
        return view('livewire.categories.categories', compact('categories'));
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
        ]);
        Category::create($validatedDate);
        $this->peringatan('berhasil menambah katagori');
        $this->resetInputFields();
        $this->emit('categoryStore'); // Close model to using to jquery

    }

    public function edit($id)
    {
        $this->updateMode = true;
        $category = Category::where('id', $id)->first();
        $this->category_id = $id;
        $this->name = $category->name;
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
        ]);

        if ($this->category_id) {
            $category = Category::find($this->category_id);
            $category->update([
                'name' => $this->name,
            ]);
            $this->updateMode = false;
            $this->peringatan('berhasil mengupdate katagori');
            $this->resetInputFields();
        }
    }

    public function delete($id)
    {
        if ($id) {
            Category::where('id', $id)->delete();
            $this->peringatan('berhasil menghapus katagori');
        }
    }
}
