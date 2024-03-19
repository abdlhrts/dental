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
                Forms\Components\Grid::make(3)
                    ->schema([
                        Forms\Components\Fieldset::make('Informasi User')
                            ->columnSpan(2)
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
                            ]),
                        Forms\Components\Fieldset::make('profile')
                            ->label('Profile')
                            ->relationship('profile')
                            ->columnSpan(1)
                            ->columns(1)
                            ->schema([
                                Forms\Components\FileUpload::make('image')
                                    ->directory('profile-picture')
                                    ->image()
                                    ->avatar()
                                    ->circleCropper(),
                                Forms\Components\Select::make('title')
                                    ->required()
                                    ->options([
                                        'Super Admin' => 'Super Admin',
                                        'Doctor' => 'Doctor',
                                        'Nurse' => 'Nurse',
                                        'Employee' => 'Employee',
                                        'User' => 'User',
                                    ]),
                                Forms\Components\TextInput::make('phone_number')
                                    ->prefix('+62')
                                    ->tel()
                                    ->required(),
                                Forms\Components\Textarea::make('address'),
                                Forms\Components\Textarea::make('description'),
                            ]),
                    ])
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
