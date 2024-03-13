<?php

namespace App\Livewire\Patient;

use App\Models\Patient;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;
use Illuminate\Contracts\View\View;

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
                Forms\Components\Fieldset::make('Data Pasien')
                    ->schema([
                        Forms\Components\TextInput::make('medical_record_number')
                            ->label('No. RM'),
                        Forms\Components\TextInput::make('name')
                            ->label('Nama')
                            ->required(),
                        Forms\Components\TextInput::make('nik'),
                        Forms\Components\TextInput::make('phone_number'),
                        Forms\Components\TextInput::make('birth_place'),
                        Forms\Components\TextInput::make('birth_date'),
                        Forms\Components\Select::make('gender')
                            ->options([
                                'male'      => 'Laki - laki',
                                'female'    => 'Perempuan'
                            ]),
                        Forms\Components\Textarea::make('address'),
                    ]),
            ])
            ->statePath('data')
            ->model(Patient::class);
    }

    public function create(): void
    {
        $data = $this->form->getState();

        $record = Patient::create($data);

        $this->form->model($record)->saveRelationships();
    }

    public function render(): View
    {
        return view('livewire.patient.create-patient');
    }
}
