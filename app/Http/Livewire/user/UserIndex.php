<?php

namespace App\Http\Livewire\user;

use App\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserIndex extends Component
{
    use WithPagination;
    public $statusUpdate = false;
    public $paginate = 5;
    public $search;
    protected $listeners = [
        'userStored' => 'handleStored',
        'userUpdate' => 'handleUpdate',
    ];
    protected $updatesQueryString = ['search'];

    public function mount()
    {
        $this->search = request()->query('search', $this->search);
    }
    /**
     * Render view user index
     */
    public function render()
    {
        return view('livewire.user.user-index', [
            'users' => $this->search === null ? User::latest()->paginate($this->paginate) : User::where('name', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return event listeners
     */
    public function getUser($id)
    {
        $this->statusUpdate = true;
        $user = User::find($id);
        $this->emit('getUser', $user);
    }
    public function peringatan(){
        $this->alert('success', 'Hello World!', [
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
    /**
     * Destroy User.
     *
     * @param  \App\User  $id
     * @return message
     */
    public function destroy($id)
    {
        if ($id) {
            $user = User::findOrFail($id);
            $user->delete();
            $this->peringatan();
        }
    }
    /**
     * Display message store success
     */
    public function handleStored()
    {
        $this->peringatan();
    }
    /**
     * Display message update success
     */
    public function handleUpdate($user)
    {
        $this->peringatan();
    }
}
