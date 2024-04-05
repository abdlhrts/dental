<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Master Data') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 mb-5">
            <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab"
                    data-tabs-toggle="#default-tab-content" role="tablist">
                    <li class="me-2" role="presentation">
                        <button class="inline-block p-4 border-b-2 rounded-t-lg" id="diagnosa-tab"
                            data-tabs-target="#diagnosa" type="button" role="tab" aria-controls="diagnosa"
                            aria-selected="false">Diagnosa</button>
                    </li>
                    <li class="me-2" role="presentation">
                        <button
                            class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                            id="treatment-tab" data-tabs-target="#treatment" type="button" role="tab"
                            aria-controls="treatment" aria-selected="false">Treatment</button>
                    </li>
                    <li class="me-2" role="presentation">
                        <button
                            class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                            id="dental-condition-tab" data-tabs-target="#dental-condition" type="button" role="tab"
                            aria-controls="dental-condition" aria-selected="false">Dental Condition</button>
                    </li>
                    <li role="presentation">
                        <button
                            class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                            id="patient-tab" data-tabs-target="#patient" type="button" role="tab"
                            aria-controls="patient" aria-selected="false">Patient</button>
                    </li>

                </ul>
            </div>
            <div id="default-tab-content">
                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="diagnosa" role="tabpanel"
                    aria-labelledby="diagnosa-tab">
                    @livewire('master-data.list-diagnosa')
                </div>
                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="treatment" role="tabpanel"
                    aria-labelledby="treatment-tab">
                    @livewire('master-data.list-treatment')
                </div>
                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="dental-condition" role="tabpanel"
                    aria-labelledby="dental-condition-tab">
                    @livewire('master-data.list-dental-condition')
                </div>
                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="patient" role="tabpanel"
                    aria-labelledby="patient-tab">
                    @livewire('patient.list-patient')
                </div>

            </div>
        </div>
    </div>
</x-app-layout>