<?php

namespace App\Http\Livewire\user;

use App\User;
use Livewire\Component;

class UserCreate extends Component
{
    public $name;
    public $email;
     /**
     * Render view user create
     */
    public function render()
    {
        return view('livewire.user.user-create');
    }
     /**
     * Save the newly created user resource in storage..
     * @return event listeners
     */
    public function store()
    {
        $this->validate([
            'name' => 'required|max:8',
            'email' => 'required|email|unique:users|min:5',
        ]);
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt('password'),
        ]);
        $this->resetInput();
        $this->emit('userStored', $user);
    }
     /**
     * Reset form input.
     */
    public function resetInput()
    {
        $this->name = null;
        $this->email = null;
    }
}
