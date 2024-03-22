<?php

namespace App\Livewire\MedicalRecord;

use Livewire\Component;

class Index extends Component
{
    public function triggerAnamnesa()
    {
        // dd("ini klik");
        $this->dispatch('createActionAnamnesa-clicked');
    }

    public function triggerTreatment()
    {
        // dd("ini klik");
        $this->dispatch('createActionTreatment-clicked');
    }

    public function render()
    {
        return view('livewire.medical-record.index');
    }
}
