<?php

namespace App\Livewire\Doctor;

use App\Models\User;
use App\Models\Doctor;
use Livewire\Component;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Concerns\InteractsWithForms;

class CreateDoctor extends Component implements HasForms
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
                    ->required(),
                TextInput::make('email')
                    ->email()
                    ->required(),
                TextInput::make('password')
                    ->password()
                    ->revealable()
                    ->required(),
                // ...
            ])
            ->columns(2)
            ->statePath('data');
    }

    public function create(): void
    {
        $user = User::create([
            'name'      => $this->form->getState()['name'],
            'email'     => $this->form->getState()['email'],
            'password'  => Hash::make($this->form->getState()['password']),
        ]);
        Doctor::create([
            'user_id'   => $user->id
        ]);
        Notification::make()
            ->title('Saved successfully')
            ->success()
            ->send();
        redirect()->route('doctor.index');
    }

    public function render()
    {
        return view('livewire.doctor.create-doctor');
    }
}
