<div>
    <form wire:submit="save">
        {{ $this->form }}

        <x-primary-button type="submit" class="mt-5">Submit</x-primary-button>
        <x-secondary-button>
            <a href="{{ route('user.index') }}">Cancel</a>
        </x-secondary-button>
    </form>

    <x-filament-actions::modals />
</div>