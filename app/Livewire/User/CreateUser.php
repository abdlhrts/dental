<?php

namespace App\Livewire\User;

use Filament\Forms;
use App\Models\User;
use Livewire\Component;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\MarkdownEditor;
use Illuminate\Validation\ValidationException;
use Filament\Forms\Concerns\InteractsWithForms;

class CreateUser extends Component implements HasForms
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
                TextInput::make('name')
                    ->autocomplete(false)
                    ->required(),
                TextInput::make('email')
                    ->autocomplete(false)
                    ->email()
                    ->required(),
                Forms\Components\DatePicker::make('email_verified_at'),
                TextInput::make('password')
                    ->autocomplete(false)
                    ->password()
                    ->revealable()
                    ->required(),
                // ...
            ])
            ->columns(2)
            ->statePath('data');
    }

    protected function onValidationError(ValidationException $exception): void
    {
        Notification::make()
            ->title($exception->getMessage())
            ->danger()
            ->send();
    }

    public function create(): void
    {
        User::create([
            'name'      => $this->form->getState()['name'],
            'email'     => $this->form->getState()['email'],
            'password'  => Hash::make($this->form->getState()['password']),
        ]);
        Notification::make()
            ->title('Saved successfully')
            ->success()
            ->send();
        redirect()->route('user.index');
    }

    public function render()
    {
        return view('livewire.user.create-user');
    }
}