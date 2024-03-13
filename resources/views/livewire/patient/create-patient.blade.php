<div>
    <form wire:submit="create">
        {{ $this->form }}

        <x-primary-button type="submit" class="mt-5">Submit</x-primary-button>
        <x-secondary-button>
            <a href="{{ route('patient.index') }}">Cancel</a>
        </x-secondary-button>
    </form>

    <x-filament-actions::modals />
</div>