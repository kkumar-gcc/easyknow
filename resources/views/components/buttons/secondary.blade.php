@props(['fullWidth' => false, 'type' => 'button'])
<span class="{{ $fullWidth ? 'flex' : 'inline-flex' }} rounded-md shadow-sm">
    @if ($attributes->has('href'))
        <a type={{ $type }}
            {{ $attributes->merge([
                'class' =>
                    ($fullWidth ? 'w-full ' : '') .
                    'shadow-sm font-semibold text-base leading-6 border border-transparent  flex-row  rounded-lg px-4 py-2 inline-flex justify-center no-underline  cursor-pointer whitespace-nowrap text-white bg-gradient-to-br from-rose-600 to-pink-500 hover:bg-gradient-to-bl',
            ]) }}>
            {{ $slot }}
        </a>
    @else
        <button type={{ $type }}
            {{ $attributes->merge([
                'class' =>
                    ($fullWidth ? 'w-full ' : '') .
                    'shadow-sm font-semibold text-base leading-6 border border-transparent  flex-row  rounded-lg px-4 py-2 inline-flex justify-center no-underline  cursor-pointer whitespace-nowrap text-white bg-gradient-to-br from-rose-600 to-pink-500 hover:bg-gradient-to-bl',
            ]) }}>
            {{ $slot }}
        </button>
    @endif
</span>
