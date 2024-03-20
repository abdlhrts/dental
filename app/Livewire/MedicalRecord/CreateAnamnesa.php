<?php

namespace App\Livewire\MedicalRecord;

use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Actions;
use Filament\Forms;
use Filament\Support\Enums\ActionSize;
use Livewire\Component;

class CreateAnamnesa extends Component implements HasForms, HasActions
{
    use InteractsWithActions;
    use InteractsWithForms;

    public function createAction(): Actions\Action
    {
        return Actions\CreateAction::make('create')
            ->icon('heroicon-m-pencil-square')
            ->iconButton()
            ->color('success')
            ->form([
                Forms\Components\TextInput::make('anamnesa'),
            ]);
    }

    public function render()
    {
        return view('livewire.medical-record.create-anamnesa');
    }
}
