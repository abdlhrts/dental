<?php

namespace App\Livewire\Patient;

use Filament\Forms;
use App\Models\Patient;
use Livewire\Component;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Forms\Concerns\InteractsWithForms;

class CreatePatient extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\Grid::make([
                    'lg' => 2
                ])
                    ->schema([
                        Forms\Components\Fieldset::make('Data Pasien')
                            ->columns(1)
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
                        Forms\Components\Fieldset::make('Data Medik')
                            ->relationship('medical_data')
                            ->columns(1)
                            ->columnSpan(1)
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
            ->statePath('data')
            ->model(Patient::class);
    }

    public function create(): void
    {
        $data = $this->form->getState();

        $record = Patient::create($data);

        $this->form->model($record)->saveRelationships();

        Notification::make()
            ->title('Update successfully')
            ->success()
            ->send();
    }

    public function render(): View
    {
        return view('livewire.patient.create-patient');
    }
}
