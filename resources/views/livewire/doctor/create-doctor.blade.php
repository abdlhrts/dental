<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <form wire:submit="create">
        {{ $this->form }}

        <x-primary-button type="submit" class="mt-5">Submit</x-primary-button>
        <x-secondary-button>
            <a href="{{ route('doctor.index') }}">Cancel</a>
        </x-secondary-button>
    </form>

    <x-filament-actions::modals />
</div>