<x-filament::widget >
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <x-dashboard-section class="basis-0 flex-1">
            <h2 class="text-lg sm:text-xl font-bold tracking-tight">Views</h2>
            <div class="flex gap-2 items-center">
                @svg('heroicon-o-eye', 'h-6 w-6')
                {{ $viewCount }}
            </div>
        </x-dashboard-section>

        <x-dashboard-section class="basis-0 flex-1">
            <h2 class="text-lg sm:text-xl font-bold tracking-tight">Upvotes</h2>
            <div class="flex gap-2 items-center">
                @svg('heroicon-o-hand-thumb-up', 'h-6 w-6')
                {{ $upvotes }}
            </div>
        </x-dashboard-section>

        <x-dashboard-section class="basis-0 flex-1">
            <h2 class="text-lg sm:text-xl font-bold tracking-tight">Downvotes</h2>
            <div class="flex gap-2 items-center">
                @svg('heroicon-o-hand-thumb-down', 'h-6 w-6')
                {{ $downvotes }}
            </div>
        </x-dashboard-section>
    </div>
</x-filament::widget>
