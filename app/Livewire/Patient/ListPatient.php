<?php

namespace App\Livewire\Patient;

use App\Models\Patient;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;

class ListPatient extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(Patient::query())
            ->columns([
                //
                Tables\Columns\TextColumn::make('medical_record_number'),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nik')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone_number')
                    ->searchable()
                    ->prefix('+62'),
                Tables\Columns\TextColumn::make('gender'),
            ])
            ->filters([
                //
            ])
            ->actions([
                //
                Tables\Actions\Action::make('edit')
                    ->icon('heroicon-o-pencil')
                    ->color('info')
                    ->url(fn (Patient $record): string => route('patient.edit', $record))
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //
                ]),
            ]);
    }

    public function render(): View
    {
        return view('livewire.patient.list-patient');
    }
}
