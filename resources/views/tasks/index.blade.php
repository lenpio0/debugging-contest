<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight py-2">
                {{ __('Tasks') }}
            </h2>
            <x-button @click="openModale = true">add task</x-button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex gap-4">
                <div class="basis-1/3">
                    @include('_partials.column', ['status' => 'pending', 'color' => 'gray'])
                </div>
                <div class="basis-1/3">
                    @include('_partials.column', ['status' => 'in_progress', 'color' => 'yellow'])
                </div>
                <div class="basis-1/3">
                    @include('_partials.column', ['status' => 'completed', 'color' => 'green'])
                </div>
            </div>
        </div>
    </div>

    @include('_partials.modal')

</x-app-layout>
