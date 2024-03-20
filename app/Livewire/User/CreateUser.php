<?php

namespace App\Livewire\User;

use Filament\Forms;
use App\Models\User;
use Livewire\Component;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Contracts\HasForms;
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
                //
                Forms\Components\Tabs::make('Tabs')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Informasi User')
                            ->schema([
                                Forms\Components\Fieldset::make('Informasi User')
                                    ->schema([
                                        Forms\Components\TextInput::make('name')
                                            ->required()
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('email')
                                            ->email()
                                            ->required()
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('password')
                                            ->password()
                                            ->revealable()
                                            ->dehydrateStateUsing(fn (string $state): string => Hash::make($state))
                                            ->required(),
                                        Forms\Components\DatePicker::make('email_verified_at'),
                                        Forms\Components\Select::make('roles')
                                            ->multiple()
                                            ->relationship('roles', 'name')
                                            ->preload(),
                                    ]),
                            ]),
                        Forms\Components\Tabs\Tab::make('User Profile')
                            ->schema([
                                Forms\Components\Fieldset::make('profile')
                                    ->label('Profile')
                                    ->relationship('profile')
                                    ->columns(2)
                                    ->schema([
                                        Forms\Components\FileUpload::make('image')
                                            ->directory('profile-picture')
                                            ->image()
                                            ->avatar()
                                            ->circleCropper()
                                            ->columnSpan(2),
                                        Forms\Components\TextInput::make('title')
                                            ->required(),
                                        Forms\Components\TextInput::make('phone_number')
                                            ->prefix('+62')
                                            ->tel()
                                            ->required(),
                                        Forms\Components\Textarea::make('address'),
                                        Forms\Components\Textarea::make('description'),
                                    ]),
                            ])
                    ]),

            ])
            ->statePath('data')
            ->model(User::class);
    }

    public function create(): void
    {
        $data = $this->form->getState();

        $record = User::create($data);

        $this->form->model($record)->saveRelationships();

        Notification::make()
            ->title('Saved successfully')
            ->success()
            ->send();
    }

    public function render(): View
    {
        return view('livewire.user.create-user');
    }
}
