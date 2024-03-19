<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 mb-5">
            <section class="flex items-center bg-gray-50 dark:bg-gray-900">
                <div class="w-full mx-auto">
                    <!-- Start coding here -->
                    <div class="relative overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
                        <div
                            class="flex-row items-center justify-between p-4 space-y-3 sm:flex sm:space-y-0 sm:space-x-4">
                            <div>
                                <h5 class="mr-3 font-semibold dark:text-white">All Users</h5>
                                <p class="text-gray-500 dark:text-gray-400">Manage all your existing users or
                                    add a new one</p>
                            </div>
                            <div class="flex items-center gap-3">
                                @livewire('patient.create-patient')

                                @livewire('patient-registration.create-patient-registration')
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-7xl">
                    @livewire('patient-registration.list-patient-registration')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>