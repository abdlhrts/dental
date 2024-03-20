<?php

namespace App\Livewire\RolePermission;

use Filament\Forms;
use Livewire\Component;
use Filament\Forms\Form;
use Spatie\Permission\Models\Role;
use Illuminate\Contracts\View\View;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Forms\Concerns\InteractsWithForms;

class CreateRole extends Component implements HasForms
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
                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required(),
                        Forms\Components\TextInput::make('guard_name'),
                    ])
            ])
            ->statePath('data')
            ->model(Role::class);
    }

    public function create(): void
    {
        $data = $this->form->getState();

        $record = Role::create($data);

        $this->form->model($record)->saveRelationships();

        Notification::make()
            ->title('Saved successfully')
            ->success()
            ->send();
    }

    public function render(): View
    {
        return view('livewire.role-permission.create-role');
    }
}
