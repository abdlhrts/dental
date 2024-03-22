<?php

namespace App\Livewire\MedicalRecord;

use App\Models\MedicalRecord;
use App\Models\PatientRegistration;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Builder;

class ListMedicalRecord extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(MedicalRecord::query()->whereHas('patient_registration', function ($query) {
                $query->where(['registration_status' => 'waiting', 'user_id' => auth()->user()->id]);
            }))
            ->columns([
                //
                Tables\Columns\TextColumn::make('patient_registration.registration_number'),
                Tables\Columns\TextColumn::make('patient_registration.patient.name'),
                Tables\Columns\TextColumn::make('patient_registration.user.name')
                    ->label('Doctor'),
                Tables\Columns\TextColumn::make('patient_registration.registration_status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'waiting' => 'warning',
                    }),
            ])
            ->filters([
                //
            ])
            ->actions([
                //
                Action::make('edit')
                    ->icon('heroicon-o-pencil')
                    ->color('info')
                    ->url(fn (MedicalRecord $record): string => route('medical-record.edit', $record)),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //
                ]),
            ]);
    }

    public function render(): View
    {
        return view('livewire.medical-record.list-medical-record');
    }
}
