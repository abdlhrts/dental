<?php

namespace App\Livewire\User;

use App\Models\User;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Filament\Tables;
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
                ImageColumn::make('profile.image')
                    ->label('Profile Picture'),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('email')
                    ->searchable(),
                TextColumn::make('email_verified_at')
                    ->searchable(),
                TextColumn::make('profile.phone_number')
                    ->label('Phone number')
                    ->searchable()
                    ->prefix('+62'),
                TextColumn::make('roles.name')
                    ->label('Role'),
                // TextColumn::make('profile.title')
                //     ->label('Title')
                //     ->badge()
                //     ->color(fn (string $state): string => match ($state) {
                //         'Super Admin' => 'info',
                //         'Doctor' => 'success',
                //         'Nurse' => 'warning',
                //         'Employee' => 'gray',
                //         'User' => 'danger',
                //     }),
            ])
            ->filters([
                // ...
                Tables\Filters\SelectFilter::make('roles')
                    ->multiple()
                    ->relationship('roles', 'name')
                    ->preload(),
                // Tables\Filters\SelectFilter::make('title')
                //     ->options([
                //         'Super Admin' => 'Super Admin',
                //         'Doctor' => 'Doctor',
                //         'Nurse' => 'Nurse',
                //         'Employee' => 'Employee',
                //         'User' => 'User',
                //     ])
                //     ->attribute('profile.title'),
                Tables\Filters\TernaryFilter::make('email_verified_at')
                    ->nullable()
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
                    DeleteBulkAction::make()
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
                        ->deselectRecordsAfterCompletion(),
                ]),
            ]);
    }

    public function render(): View
    {
        return view('livewire.user.list-user');
    }
}
