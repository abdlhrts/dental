<?php

namespace App\Livewire\MedicalRecord;

use App\Models\MedicalRecord;
use Livewire\Component;

class CreateMedicalRecord extends Component
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

    public function mount($record)
    {
        dd($record);
    }

    public function render()
    {
        return view('livewire.medical-record.create-medical-record');
    }
}
