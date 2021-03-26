<?php

namespace App\Http\Livewire\user;

use App\User;
use Livewire\Component;

class UserUpdate extends Component
{
    public $name;
    public $email;
    public $userId;
    protected $listeners = [
        'getUser' => 'showUser'
    ];
    /**
     * Render view user update
     */
    public function render()
    {
        return view('livewire.user.user-update');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return event listeners
     */
    public function showUser($user)
    {
        $this->title = $user['name'];
        $this->description = $user['email'];
        $this->userId = $user['id'];
    }
    /**
     * update the newly created user resource in storage..
     * @return event listeners
     */
    public function update()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|min:5',
        ]);
        if ($this->userId) {
            $user = User::findOrFail($this->userId);
            $user->update([
                'name' => $this->name,
                'email' => $this->email,
            ]);
            $this->resetInput();
            $this->emit('userUpdate', $user);
        }
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
