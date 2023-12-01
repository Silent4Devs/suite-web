<?php

namespace App\Http\Livewire;

use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class CheckifmailexistsComponent extends Component
{
    use LivewireAlert;

    public $email;

    public $empleadoemail;

    public $disponiblemessage = '';

    public $isEmailRegistered = false;

    protected $rules = [
        'empleadoemail' => 'required|email',
    ];

    public function mount($empleadoemail)
    {
        $this->empleadoemail = $empleadoemail;
    }

    public function updatedEmail()
    {
        $this->isEmailRegistered = User::where('email', $this->email)->first();

        if ($this->isEmailRegistered) {
            $this->alert('info', 'Este email ya existe en el sistema', [
                'position' => 'center',
                'timer' => '5000',
                'toast' => false,
                'timerProgressBar' => true,
                'showConfirmButton' => true,
                'onConfirmed' => '',
                'confirmButtonText' => 'lo cambiare',
                'text' => 'Cambie a un correo diferente',
            ]);

            $this->reset(['email']);
            $this->disponiblemessage = 'Este email no esta disponible';
        } else {
            $this->disponiblemessage = 'Este email esta disponible';
        }
    }

    public function render()
    {
        return view('livewire.checkifmailexists-component');
    }
}
