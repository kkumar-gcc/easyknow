@props(['direction' => 'right', 'icon' => false, 'customButton' => false])
<div x-data="{ open: false }" class="relative inline-block">
    @if ($customButton)
        <div x-on:click="open = true" type="button">
            {{ $title }}
        </div>
    @else
        <x-buttons.primary x-on:click="open = true" type="button">
            {{ $title }}
            @if ($icon)
                <svg class="fill-current h-4 w-4 ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                    style="margin-top:3px">
                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                </svg>
            @endif
        </x-buttons.primary>
    @endif
    <div x-show="open" x-on:click.away="open = false"
        class="bg-white border mt-2 border-gray-200 rounded-lg text-gray-700 z-10 shadow-sm absolute left-0 py-2"
        style="min-width:15rem">
        {{ $slot }}
    </div>
</div>
