<?php

namespace App\Livewire\RolePermission;

use Spatie\Permission\Models\Role;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;

class ListRole extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(Role::query())
            ->columns([
                //
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('guard_name'),
                Tables\Columns\TextColumn::make('permissions_count')->counts('permissions')
                    ->badge(),
            ])
            ->filters([
                //
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
        return view('livewire.role-permission.list-role');
    }
}
