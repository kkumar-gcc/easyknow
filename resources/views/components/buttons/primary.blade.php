@props(['fullWidth' => false, 'type' => 'button'])
<span class="{{ $fullWidth ? 'flex' : 'inline-flex' }} rounded-md shadow-sm">
    @if ($attributes->has('href'))
        <a  type={{ $type }}
            {{ $attributes->merge(['class' => ($fullWidth ? 'w-full ' : '') . 'shadow-sm font-semibold text-base leading-6 border border-gray-200  flex-row rounded-lg py-2 px-4 inline-flex justify-center  hover:bg-gray-50']) }}>
            {{ $slot }}
        </a>
    @else
        <button type={{ $type }}
            {{ $attributes->merge(['class' => ($fullWidth ? 'w-full ' : '') . 'shadow-sm font-semibold text-base leading-6 border border-gray-200  flex-row rounded-lg py-2 px-4 inline-flex justify-center  hover:bg-gray-50']) }}>
            {{ $slot }}
        </button>
    @endif
</span>
