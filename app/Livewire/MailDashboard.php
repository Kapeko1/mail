<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class MailDashboard extends Component
{
    public $showComposePopup = false;

    #[On('closePopup')]
    public function toggleComposePopup()
    {
        $this->showComposePopup = !$this->showComposePopup;
    }

    public function render()
    {
        return view('livewire.mail-dashboard');
    }
}
