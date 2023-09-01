<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight py-2">
                {{ __('Tasks') }}
            </h2>
            <x-button @click="openModale = true">add task</x-button>

            {{-- Added buttons that sets the sorting choice, one displaying only when the other option is actually selected --}}

            <?php if ($sort == 'desc'): ?>
                <a href="{{ route('tasks.index', ['sort' => 'asc']) }}" class="btn btn-primary">Sort by Oldest End Date</a>
            <?php elseif ($sort == 'asc'): ?>
                <a href="{{ route('tasks.index', ['sort' => 'desc']) }}" class="btn btn-primary">Sort by Latest End Date</a>
            <?php endif; ?>

            {{-- Displays the actual sorting --}}

            <p class="capitalize"><?php echo $sort ?>ending</p>

        </div>
    </x-slot>

    <div class="sm:py-12 py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex sm:flex-row flex-col sm:gap-4 gap-6">
                <div class="sm:basis-1/3">
                    @include('_partials.column', ['status' => 'pending', 'color' => 'gray'])
                </div>
                <div class="sm:basis-1/3">
                    @include('_partials.column', ['status' => 'in_progress', 'color' => 'yellow'])
                </div>
                <div class="sm:basis-1/3">
                    @include('_partials.column', ['status' => 'completed', 'color' => 'green'])
                </div>
            </div>
        </div>
    </div>

    @include('_partials.modal')

</x-app-layout>
