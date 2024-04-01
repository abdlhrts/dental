<?php

namespace App\Livewire\MedicalRecord;

use App\Models\Treatment;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Actions;
use Filament\Forms;
use Filament\Support\Enums\ActionSize;
use Livewire\Component;
use Livewire\Attributes\On;

class CreateTreatment extends Component implements HasForms, HasActions
{
    use InteractsWithActions;
    use InteractsWithForms;

    #[On('createActionTreatment-clicked')]
    public function handleCreateActionTreatment()
    {
        // $this->createAction();
        $this->mountAction('createActionTreatment');
    }

    public function createActionTreatment(): Actions\Action
    {
        return Actions\CreateAction::make('createTreatment')
            ->icon('heroicon-m-arrow-up-on-square')
            ->iconButton()
            ->color('success')
            ->form([
                Forms\Components\Select::make('treatment')
                    ->options(Treatment::all()->pluck('treatment_name', 'id'))
                    ->searchable()
                    ->preload()
                    ->multiple()
                    ->autofocus(),
            ]);
    }

    public function render()
    {
        return view('livewire.medical-record.create-treatment');
    }
}
