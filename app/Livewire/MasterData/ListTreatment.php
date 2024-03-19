<?php

namespace App\Livewire\MasterData;

use Filament\Forms;
use Filament\Tables;
use Livewire\Component;
use App\Models\Treatment;
use Filament\Tables\Table;
use Filament\Support\RawJs;
use Illuminate\Contracts\View\View;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class ListTreatment extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(Treatment::query())
            ->columns([
                Tables\Columns\TextColumn::make('treatment_code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('treatment_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('treatment_price')
                    ->numeric()
                    ->prefix('Rp. '),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\Action::make('createTreatment')
                    ->label('Add data')
                    ->form([
                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('treatment_code')
                                    ->label('Code')
                                    ->required(),
                                Forms\Components\TextInput::make('treatment_name')
                                    ->label('Treatment')
                                    ->required(),
                                Forms\Components\TextInput::make('treatment_price')
                                    ->label('Price')
                                    ->prefix('Rp.')
                                    ->numeric()
                                    ->mask(RawJs::make('$money($input)'))
                                    ->stripCharacters(',')
                                    ->minValue(1)
                                    ->required(),
                            ])
                    ])
                    ->action(function (array $data): void {
                        $record = Treatment::create($data);

                        $this->form->model($record)->saveRelationships();

                        Notification::make()
                            ->title('Saved successfully')
                            ->success()
                            ->send();
                    })
            ])
            ->actions([
                //
                Tables\Actions\Action::make('update')
                    ->icon('heroicon-o-pencil')
                    ->color('info')
                    ->mountUsing(fn (Forms\ComponentContainer $form, Treatment $record) => $form->fill($record->attributesToArray()))
                    ->action(function (Treatment $record, array $data): void {
                        $record->update($data);
                        Notification::make()
                            ->title('Update successfully')
                            ->success()
                            ->send();
                    })
                    ->form([
                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('treatment_code')
                                    ->label('Code')
                                    ->required(),
                                Forms\Components\TextInput::make('treatment_name')
                                    ->label('Diagnosa')
                                    ->required(),
                                Forms\Components\TextInput::make('treatment_price')
                                    ->label('Price')
                                    ->prefix('Rp.')
                                    ->numeric()
                                    ->mask(RawJs::make('$money($input)'))
                                    ->stripCharacters(',')
                                    ->minValue(1)
                                    ->required(),
                            ])
                    ]),
                Tables\Actions\Action::make('delete')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->action(
                        function (Treatment $record) {
                            $record->delete();
                            Notification::make()
                                ->title('Delete successfully')
                                ->success()
                                ->send();
                        }
                    )
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //
                    Tables\Actions\BulkAction::make('delete')
                        ->icon('heroicon-o-trash')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->action(
                            function (Collection $records) {
                                $records->each->delete();
                                Notification::make()
                                    ->title('Delete successfully')
                                    ->success()
                                    ->send();
                            }
                        )
                        ->deselectRecordsAfterCompletion()
                ]),
            ]);
    }

    public function render(): View
    {
        return view('livewire.master-data.list-treatment');
    }
}
