<?php

namespace App\Livewire\MedicalRecord;

use App\Models\MedicalRecord;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;
use Illuminate\Contracts\View\View;

class EditMedicalRecord extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public $record;

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

    public function mount($record): void
    {
        $this->record = $record;
        $this->form->fill($this->record->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('patient_registration.patient.name'),
                Forms\Components\Fieldset::make('Patient Registration')
                    ->relationship('patient_registration')
                    ->schema([
                        Forms\Components\TextInput::make('patient.name'),
                    ])
            ])
            ->statePath('data')
            ->model($this->record);
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $this->record->update($data);
    }

    public function render(): View
    {
        return view('livewire.medical-record.edit-medical-record');
    }
}
