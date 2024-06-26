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
use Livewire\Attributes\On;

class CreateAnamnesa extends Component implements HasForms, HasActions
{
    use InteractsWithActions;
    use InteractsWithForms;

    #[On('createActionAnamnesa-clicked')]
    public function handleCreateActionAnamnesa()
    {
        // $this->createAction();
        $this->mountAction('createActionAnamnesa');
    }

    public function createActionAnamnesa(): Actions\Action
    {
        return Actions\CreateAction::make('createAnamnesa')
            ->icon('heroicon-m-pencil-square')
            ->iconButton()
            ->color('success')
            ->form([
                Forms\Components\Textarea::make('anamnesa')
                    ->autofocus(),
            ]);
    }

    public function render()
    {
        return view('livewire.medical-record.create-anamnesa');
    }
}
