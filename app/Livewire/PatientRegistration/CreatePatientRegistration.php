<?php

namespace App\Livewire\PatientRegistration;

use App\Models\PatientRegistration;
use Filament\Forms;
use Filament\Forms\Form;
use App\Models\User;
use Livewire\Component;
use Filament\Forms\Contracts\HasForms;
use Filament\Actions\Contracts\HasActions;
use Filament\Actions;
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
                Forms\Components\Grid::make(2)
                    ->schema([
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
