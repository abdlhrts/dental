<?php

namespace App\Livewire\User;

use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;
use Illuminate\Contracts\View\View;

class EditUser extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public $record;

    public function mount($record): void
    {
        $this->record = $record;
        $this->form->fill($this->record->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\Fieldset::make('Profile')
                    ->relationship('profile')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->image()
                            ->avatar()
                            ->directory('profile-picture')
                    ]),
                Forms\Components\Fieldset::make('Informasi User')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                    ]),
                Forms\Components\Fieldset::make('Profile')
                    ->relationship('profile')
                    ->schema([
                        Forms\Components\TextInput::make('phone_number')
                            ->prefix('+62')
                            ->tel(),
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
        return view('livewire.user.edit-user');
    }
}
