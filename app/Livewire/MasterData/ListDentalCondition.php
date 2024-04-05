<?php

namespace App\Livewire\MasterData;

use Filament\Tables;
use Filament\Forms;
use Livewire\Component;
use Filament\Tables\Table;
use App\Models\DentalCondition;
use Illuminate\Contracts\View\View;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Actions;

class ListDentalCondition extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(DentalCondition::query())
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                //
                Actions\Action::make('update')
                    ->icon('heroicon-o-pencil')
                    ->color('info')
                    ->mountUsing(fn (Forms\ComponentContainer $form, DentalCondition $record) => $form->fill($record->attributesToArray()))
                    ->action(function (DentalCondition $record, array $data): void {
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
                                Forms\Components\TextInput::make('code')
                                    ->label('Code')
                                    ->required(),
                                Forms\Components\TextInput::make('name')
                                    ->label('Diagnosa')
                                    ->required(),
                            ])
                    ]),
                Actions\Action::make('delete')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->action(
                        function (DentalCondition $record) {
                            $record->delete();
                            Notification::make()
                                ->title('Delete successfully')
                                ->success()
                                ->send();
                        }
                    )
            ])
            ->headerActions([
                Actions\Action::make('createDentalCondition')
                    ->label('Add data')
                    ->form([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('code')
                                    ->label('Code')
                                    ->required(),
                                Forms\Components\TextInput::make('name')
                                    ->label('Name')
                                    ->required(),
                            ])
                    ])
                    ->action(function (array $data): void {
                        $record = DentalCondition::create($data);

                        $this->form->model($record)->saveRelationships();

                        Notification::make()
                            ->title('Saved successfully')
                            ->success()
                            ->send();
                    })
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
        return view('livewire.master-data.list-dental-condition');
    }
}
