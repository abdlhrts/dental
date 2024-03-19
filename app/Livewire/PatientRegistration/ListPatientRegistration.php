<?php

namespace App\Livewire\PatientRegistration;

use App\Models\PatientRegistration;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Forms;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;

class ListPatientRegistration extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(PatientRegistration::query())
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label("New Registration")
                    ->color('success')
                    ->icon('heroicon-o-plus-circle')
                    ->form([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('registration_number'),
                                Forms\Components\Select::make('patient_id')
                                    ->relationship(name: 'patient', titleAttribute: 'name')
                                    ->searchable()
                                    ->preload()
                            ])
                    ]),
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //
                ]),
            ]);
    }

    public function render(): View
    {
        return view('livewire.patient-registration.list-patient-registration');
    }
}
