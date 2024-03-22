<?php

namespace App\Livewire\PatientRegistration;

use App\Models\MedicalRecord;
use Filament\Forms;
use App\Models\User;
use Filament\Actions;
use Livewire\Component;
use Filament\Forms\Form;
use App\Models\PatientRegistration;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Actions\Concerns\InteractsWithActions;

class CreatePatientRegistration extends Component implements HasForms, HasActions
{
    use InteractsWithActions;
    use InteractsWithForms;

    public function createAction()
    {
        return Actions\CreateAction::make('create')
            ->model(PatientRegistration::class)
            ->label('New Registration')
            ->icon('heroicon-o-book-open')
            ->form([
                Forms\Components\Grid::make(3)
                    ->schema([
                        Forms\Components\TextInput::make('registration_number')
                            ->required(),
                        Forms\Components\Select::make('patient_id')
                            ->searchable()
                            ->relationship('patient', 'name')
                            ->preload()
                            ->required(),
                        Forms\Components\Select::make('user_id')
                            ->label('Doctor')
                            ->searchable()
                            ->options(User::whereHas('roles', fn ($query) => $query->where('name', 'Doctor'))->pluck('name', 'id'))
                            ->preload()
                            ->required(),
                    ])
            ])
            ->action(function (array $data): void {
                $record = PatientRegistration::create($data);

                MedicalRecord::create([
                    'patient_registration_id' => $record->id
                ]);

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
