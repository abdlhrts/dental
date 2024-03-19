<?php

namespace App\Livewire\WebsiteSetting;

use App\Models\WebsiteSetting;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;

class EditWebsiteSetting extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public $record;

    public function mount(): void
    {
        $this->record = WebsiteSetting::where(['name' => 'website'])->firstOrCreate(['name' => 'website']);
        $this->form->fill($this->record->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('name')
                    ->hidden()
                    ->readOnly()
                    ->required(),
                Forms\Components\Section::make('Setting Value')
                    ->statePath('setting_value')
                    ->schema([
                        Forms\Components\TextInput::make('application_name'),
                        Forms\Components\FileUpload::make('logo')
                            ->image()
                            ->avatar()
                            ->imageEditor()
                            ->circleCropper()
                            ->directory('website-setting')
                    ])
            ])
            ->statePath('data')
            ->model($this->record);
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $this->record->update($data);

        Notification::make()
            ->title('Saved successfully')
            ->success()
            ->send();
    }

    public function render(): View
    {
        return view('livewire.website-setting.edit-website-setting');
    }
}
