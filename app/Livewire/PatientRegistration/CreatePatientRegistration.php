<?php

namespace App\Livewire\PatientRegistration;

use Filament\Forms;
use Filament\Forms\Form;
use App\Models\User;
use Livewire\Component;
use Filament\Forms\Contracts\HasForms;
use Filament\Actions\Contracts\HasActions;
use Filament\Actions\Action;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Actions\Concerns\InteractsWithActions;

class CreatePatientRegistration extends Component implements HasForms, HasActions
{
    use InteractsWithActions;
    use InteractsWithForms;

    public function createAction(): Action
    {
        return Action::make('createPatientRegistration')
            ->form([
                Forms\Components\TextInput::make('name'),
            ])
            ->action(function (array $data): void {
                $record = Diagnosa::create($data);

                $this->form->model($record)->saveRelationships();

                Notification::make()
                    ->title('Saved successfully')
                    ->success()
                    ->send();
            });
    }

    public function render()
    {
        return view('livewire.patient-registration.create-patient-registration');
    }
}
