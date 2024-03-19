<?php

namespace App\Livewire\User;

use Filament\Forms;
use App\Models\User;
use Livewire\Component;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Forms\Concerns\InteractsWithForms;

class EditUser extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public $record;

    public function mount(User $record): void
    {
        $this->record = $record;
        $this->form->fill($this->record->attributesToArray());
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
                                    ->dehydrated(fn (?string $state): bool => filled($state)),
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
                                    ->options([
                                        'Super Admin' => 'Super Admin',
                                        'Doctor' => 'Doctor',
                                        'Nurse' => 'Nurse',
                                        'Employee' => 'Employee',
                                        'User' => 'User',
                                    ]),
                                Forms\Components\TextInput::make('phone_number')
                                    ->prefix('+62')
                                    ->tel(),
                                Forms\Components\Textarea::make('address'),
                                Forms\Components\Textarea::make('description'),
                            ]),
                    ])
            ])
            ->statePath('data')
            ->model($this->record);
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $this->record->update($data);
        Notification::make()
            ->title('Saved successfully')
            ->success()
            ->send();
    }

    public function render(): View
    {
        return view('livewire.user.edit-user');
    }
}
