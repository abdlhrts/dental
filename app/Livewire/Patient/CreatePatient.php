<?php

namespace App\Livewire\Patient;

use Filament\Forms;
use App\Models\Patient;
use Livewire\Component;
use Filament\Forms\Form;
use Filament\Actions;
use Illuminate\Contracts\View\View;
use Filament\Forms\Contracts\HasForms;
use Filament\Actions\Contracts\HasActions;
use Filament\Notifications\Notification;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Actions\Concerns\InteractsWithActions;

class CreatePatient extends Component implements HasForms, HasActions
{
    use InteractsWithActions;
    use InteractsWithForms;

    public function createAction()
    {
        return Actions\CreateAction::make('create')
            ->label('New Patient')
            ->icon('heroicon-o-users')
            ->color('success')
            ->model(Patient::class)
            ->steps([
                Forms\Components\Wizard\Step::make('Data Pasien')
                    ->description('Deskripsi')
                    ->schema([
                        Forms\Components\Fieldset::make('Data Pasien')
                            ->columns(2)
                            ->columnSpan(1)
                            ->schema([
                                Forms\Components\TextInput::make('medical_record_number')
                                    ->label('No. RM')
                                    ->required(),
                                Forms\Components\TextInput::make('name')
                                    ->label('Nama')
                                    ->required(),
                                Forms\Components\TextInput::make('nik')
                                    ->required(),
                                Forms\Components\TextInput::make('phone_number')
                                    ->prefix('+62')
                                    ->tel()
                                    ->required(),
                                Forms\Components\TextInput::make('birth_place')
                                    ->required(),
                                Forms\Components\DatePicker::make('birth_date')
                                    ->maxDate(now())
                                    ->required(),
                                Forms\Components\Select::make('gender')
                                    ->options([
                                        'male'      => 'Laki - laki',
                                        'female'    => 'Perempuan'
                                    ])
                                    ->required(),
                                Forms\Components\Textarea::make('address')
                                    ->required(),
                            ]),
                    ]),
                Forms\Components\Wizard\Step::make('Medical Record')
                    ->description('Medical Record')
                    ->schema([
                        Forms\Components\Fieldset::make('Data Medik')
                            ->relationship('medical_data')
                            ->columns(2)
                            ->schema([
                                Forms\Components\Select::make('blood_type')
                                    ->options([
                                        'A' => 'A',
                                        'B' => 'B',
                                        'AB' => 'AB',
                                        'O' => 'O',
                                    ]),
                                Forms\Components\TextInput::make('blood_pressure'),
                                Forms\Components\Select::make('heart_desease')
                                    ->options([
                                        'yes' => 'Yes',
                                        'no' => 'No',
                                    ]),
                                Forms\Components\Select::make('diabetes')
                                    ->options([
                                        'yes' => 'Yes',
                                        'no' => 'No',
                                    ]),
                                Forms\Components\Select::make('haemopilia')
                                    ->options([
                                        'yes' => 'Yes',
                                        'no' => 'No',
                                    ]),
                                Forms\Components\Select::make('hepatitis')
                                    ->options([
                                        'yes' => 'Yes',
                                        'no' => 'No',
                                    ]),
                                Forms\Components\Select::make('gastring')
                                    ->options([
                                        'yes' => 'Yes',
                                        'no' => 'No',
                                    ]),
                                Forms\Components\TextInput::make('other_desease'),
                                Forms\Components\TextInput::make('drug_allergies'),
                                Forms\Components\TextInput::make('food_allergies'),

                            ])
                    ])
            ])
            ->action(function (array $data): void {
                $record = Patient::create($data);

                $this->form->model($record)->saveRelationships();

                Notification::make()
                    ->title('Saved successfully')
                    ->success()
                    ->send();
            });
    }

    public function render(): View
    {
        return view('livewire.patient.create-patient');
    }
}
