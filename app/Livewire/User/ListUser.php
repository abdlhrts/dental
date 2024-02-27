<?php

namespace App\Livewire\User;

use App\Models\User;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Livewire\Component;

class ListUser extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(User::query())
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('email')
                    ->searchable(),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                // ...
                Action::make('edit')
                    ->url(fn (User $record): string => route('user.edit', $record)),
                Action::make('delete')
                    ->color('red')
                    ->requiresConfirmation()
                    ->action(fn (Post $record) => $record->delete())
            ])
            ->bulkActions([
                // ...
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public function render(): View
    {
        return view('livewire.user.list-user');
    }
}
