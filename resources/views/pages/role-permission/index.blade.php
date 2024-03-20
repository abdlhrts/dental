<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Role & Permission') }}
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
                            <a href="{{ route('role-permission.create') }}"
                                class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-2 -ml-1"
                                    viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path
                                        d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z" />
                                </svg>
                                Add new user
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-7xl">
                    @livewire('role-permission.list-role')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>