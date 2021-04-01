<?php

namespace App\Http\Livewire;

use App\Model\Pengeluaran;
use Livewire\Component;
use Livewire\WithPagination;

class Pengeluarans extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $keterangan, $kredit;
    public $paginate = 5;
    public function render()
    {
        $pengeluarans = Pengeluaran::latest()->paginate($this->paginate);
        return view('livewire.pengeluarans.pengeluarans', compact('pengeluarans'));
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
        $this->keterangan = '';
        $this->kredit = '';
    }

    public function store()
    {
        $validatedDate = $this->validate([
            'keterangan' => 'required',
            'kredit' => 'required',
        ]);
        Pengeluaran::create($validatedDate);
        $this->peringatan('berhasil menambah pengeluaran');
        $this->resetInputFields();
        $this->emit('pengeluaranStore'); // Close model to using to jquery

    }

    public function delete($id)
    {
        if ($id) {
            Pengeluaran::where('id', $id)->delete();
            $this->peringatan('berhasil menghapus product');
        }
    }
}
