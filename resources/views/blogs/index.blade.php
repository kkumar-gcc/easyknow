@extends('layouts.base')

@section('content')
    <?php
    function nice_number($n)
    {
        // $n = 0 + str_replace(',', '', $n);
        if (!is_numeric($n)) {
            return false;
        }
        if ($n > 1000000000000) {
            return round($n / 1000000000000, 1) + 't ';
        } elseif ($n > 1000000000) {
            return round($n / 1000000000, 1) + 'b ';
        } elseif ($n > 1000000) {
            return round($n / 1000000, 1) + 'm ';
        } elseif ($n > 1000) {
            return round($n / 1000, 1) + 'k ';
        }
    
        return number_format($n);
    }
    ?>

    <div class="w-full px-2 md:px-12  my-4 mx-auto  relative">
        <div id="toast-info">
        </div>
        @if (session()->has('deleteSuccess'))
            <section class=" d-flex justify-content-center my-4 w-100">
                <div class="container">
                    <div class="alert alert-dismissible fade show alert-success" role="alert" data-mdb-color="warning"
                        id="customxD">
                        <strong>Success!</strong> {{ session()->get('deleteSuccess') }}
                        <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </section>
        @endif
        <div class="tabs mb-4  mt-4 dark:border-gray-700 overflow-y-hidden">
            <ul class="flex flex-nowrap  whitespace-nowrap  -mb-px text-sm font-medium text-center -primary "
                role="tablist">
                <li class="mr-2" role="presentation">
                    <a class="inline-block p-4 rounded-t-lg border-b-4  {{ $tab == 'newest' ? 'text-rose-600  dark:text-rose-500  border-rose-600 dark:border-rose-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-transparent text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-700' }}"
                        href="/blogs?tab=newest" role="tab">Recent</a>
                </li>
                <li class="mr-2" role="presentation">
                    <a class="inline-block p-4 rounded-t-lg border-b-4 {{ $tab == 'likes' ? 'text-rose-600  dark:text-rose-500  border-rose-600 dark:border-rose-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-transparent text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-600' }}"
                        href="/blogs?tab=likes" role="tab">Popular</a>
                </li>
                <li class="mr-2" role="presentation">
                    <a class="inline-block p-4 rounded-t-lg border-b-4  {{ $tab == 'views' ? 'text-rose-600  dark:text-rose-500  border-rose-600 dark:border-rose-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-transparent text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-700' }}"
                        href="/blogs?tab=views" role="tab">Top Viewed</a>
                </li>
            </ul>
        </div>
        <x-dropdowns.primary>
            <x-slot:title> Sort By </x-slot:title>
            <ul>
                <li>
                    <a href="#" class="block hover:bg-gray-50 whitespace-no-wrap py-2 px-4">
                        Mont Blanc
                    </a>
                </li>
                <li>
                    <a href="#" class="block hover:bg-gray-50 whitespace-no-wrap py-2 px-4">
                        Monte Rosa
                    </a>
                </li>
                <li>
                    <a href="#" class="block hover:bg-gray-50 whitespace-no-wrap py-2 px-4">
                        Dom <span class="text-gray-400">(no good)</span>
                    </a>
                </li>
            </ul>
        </x-dropdowns.primary>
        @foreach ($blogs as $blog)
            <x-cards.card-primary :blog=$blog />
        @endforeach
        {!! $blogs->withQueryString()->links('pagination::tailwind') !!}
    </div>
@endsection
@section('content-left')
    <article>
        <livewire:top-users />
        {{-- <div
            class="w-full mt-3 text-base font-normal text-left border border-gray-200 rounded-xl hover:shadow-md dark:border-gray-700 dark:bg-gray-800">
            <header class="px-4 py-3 text-2xl font-semibold text-gray-700 dark:text-white">
                <span class="modern-badge modern-badge-danger">#Advertisment</span>
            </header>
            <div
                class="px-4 py-3 text-gray-700 border-t border-gray-200 last:rounded-b-xl dark:text-gray-400 dark:hover:text-white dark:border-gray-700 hover:bg-gray-50 hover:shadow-md dark:bg-gray-800 dark:hover:bg-gray-700">
                <div class="relative  pt-[60%] w-full rounded-xl sm:pt-[50%] md:pt-[42%] ">
                    <img class="absolute top-0 bottom-0 left-0 right-0 object-cover w-full h-full m-0 bg-white shadow-md rounded-xl drop-shadow-md dark:bg-gray-800"
                        src="https://picsum.photos/400/300" alt="" />
                </div>
            </div>
        </div> --}}
        <livewire:top-tags />
    </article>
@endsection
@push('scripts')
    @include('ajax')
@endpush
