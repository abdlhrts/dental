<?php

namespace App\Livewire\MasterData;

use App\Models\Diagnosa;
use Livewire\Component;
use Filament\Forms;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions;
use Illuminate\Contracts\View\View;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Illuminate\Database\Eloquent\Collection;

class ListDiagnosa extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(Diagnosa::query())
            ->columns([
                Tables\Columns\TextColumn::make('diagnosa_code')
                    ->label('Code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('diagnosa_name')
                    ->label('Diagnosa')
                    ->searchable(),
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
                Actions\Action::make('createDiagnosa')
                    ->label('Add data')
                    ->form([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('diagnosa_code')
                                    ->label('Code')
                                    ->required(),
                                Forms\Components\TextInput::make('diagnosa_name')
                                    ->label('Diagnosa')
                                    ->required(),
                            ])
                    ])
                    ->action(function (array $data): void {
                        $record = Diagnosa::create($data);

                        $this->form->model($record)->saveRelationships();

                        Notification::make()
                            ->title('Saved successfully')
                            ->success()
                            ->send();
                    })
            ])
            ->actions([
                //
                Actions\Action::make('update')
                    ->icon('heroicon-o-pencil')
                    ->color('info')
                    ->mountUsing(fn (Forms\ComponentContainer $form, Diagnosa $record) => $form->fill($record->attributesToArray()))
                    ->action(function (Diagnosa $record, array $data): void {
                        // $record->author()->associate($data['authorId']);
                        // $record->save();
                        $record->update($data);
                        Notification::make()
                            ->title('Update successfully')
                            ->success()
                            ->send();
                    })
                    ->form([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('diagnosa_code')
                                    ->label('Code')
                                    ->required(),
                                Forms\Components\TextInput::make('diagnosa_name')
                                    ->label('Diagnosa')
                                    ->required(),
                            ])
                    ]),
                Actions\Action::make('delete')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->action(
                        function (Diagnosa $record) {
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
                    Actions\BulkAction::make('delete')
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
        return view('livewire.master-data.list-diagnosa');
    }
}
