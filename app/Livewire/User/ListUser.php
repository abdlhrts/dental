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
use Filament\Tables\Columns\ImageColumn;
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
                ImageColumn::make('profile.image'),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('email')
                    ->searchable(),
                TextColumn::make('profile.phone_number')
                    ->label('No. Telepon')
                    ->searchable()
                    ->prefix('+62'),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                // ...
                Action::make('edit')
                    ->icon('heroicon-o-pencil')
                    ->color('info')
                    ->url(fn (User $record): string => route('user.edit', $record)),
                Action::make('delete')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->action(fn (User $record) => $record->delete())
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
