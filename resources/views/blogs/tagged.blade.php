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
            return round($n / 1000000000000, 1) . 't ';
        } elseif ($n > 1000000000) {
            return round($n / 1000000000, 1) . 'b ';
        } elseif ($n > 1000000) {
            return round($n / 1000000, 1) . 'm ';
        } elseif ($n > 1000) {
            return round($n / 1000, 1) . 'k ';
        }
    
        return number_format($n);
    }
    Str::macro('readDuration', function (...$text) {
        $totalWords = str_word_count(implode(' ', $text));
        $minutesToRead = round($totalWords / 200);
    
        return (int) max(1, $minutesToRead);
    });
    ?>
    <div class="w-full px-2 md:px-12  my-4 mx-auto">
      <div id="toast-info"></div>
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

        <div
            class="relative mt-2 w-full p-2.5 text-base text-left  border border-transparent rounded-3xl font-normal text-gray-700 dark:text-gray-400 hover:bg-gray-50 hover:border-gray-200 shadow-sm dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
            <div class="flex flex-col items-stretch justify-center p-6">
                <x-tag :tag=$searchTag id="searchTag-{{ $searchTag->id }}" />
                <p class="mt-3 mb-3">Some quick example text to build on the card title and make up the
                    bulk of
                    the card's content.</p>
            </div>
        </div>

        <div class="mb-4  mt-4 border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-nowrap  whitespace-nowrap  -mb-px text-sm font-medium text-center" role="tablist">
                <li class="mr-2" role="presentation">
                    <a class="inline-block p-4 rounded-t-lg border-b-2  {{ $tab == 'newest' ? 'text-rose-600  dark:text-rose-500  border-rose-600 dark:border-rose-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-transparent text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-700' }}"
                        href="/blogs/tagged/{{ $searchTag->title }}?tab=newest" role="tab">Newest</a>
                </li>
                <li class="mr-2" role="presentation">
                    <a class="inline-block p-4 rounded-t-lg border-b-2  {{ $tab == 'likes' ? 'text-rose-600  dark:text-rose-500  border-rose-600 dark:border-rose-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-transparent text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-700' }}"
                        href="/blogs/tagged/{{ $searchTag->title }}?tab=likes" role="tab">Most Liked</a>
                </li>
                <li class="mr-2" role="presentation">
                    <a class="inline-block p-4 rounded-t-lg border-b-2  {{ $tab == 'views' ? 'text-rose-600  dark:text-rose-500  border-rose-600 dark:border-rose-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-transparent text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-700' }}"
                        href="/blogs/tagged/{{ $searchTag->title }}?tab=views" role="tab">Top Viewed</a>
                </li>
            </ul>
        </div>

        @if ($blogs->count() > 0)
            @foreach ($blogs as $blog)
            <x-cards.card-primary :blog=$blog />
            @endforeach

            {!! $blogs->withQueryString()->onEachSide(3)->links('pagination::tailwind') !!}
        @else
            <div class="e-card e-card-hover ">
                <div class="card-body text-center">
                    There is no blog related to <a href="/blogs/tagged/{{ $searchTag->title }}" class="tag-popover"
                        id="tagError-{{ $searchTag->id }}"><span
                            class="modern-badge  modern-badge-{{ $searchTag->color }}">
                            #{{ $searchTag->title }} </a>. Please try our <a href="/tags?tab=popular">popular tags</a>.
                    </span>
                    </a>
                </div>
            </div>
        @endif
    </div>
@endsection
@section('content-left')

    <article id="sticky-sidebar" class="">
        <livewire:top-users />
        <div
            class="relative mt-3 w-full  text-base text-left  border  border-gray-200 rounded-xl font-normal   hover:shadow-md dark:border-gray-700 dark:bg-gray-800 ">
            <header class="py-3 px-4 text-2xl font-semibold text-gray-700 dark:text-white">
                <span class="modern-badge modern-badge-danger">#Advertisment</span>
            </header>
            <div
                class="border-t py-3 px-4 last:rounded-b-xl border-gray-200 text-gray-700 dark:text-gray-400 dark:hover:text-white dark:border-gray-700 hover:bg-gray-100 hover:shadow-md dark:bg-gray-800 dark:hover:bg-gray-700">

                <img src="https://picsum.photos/1200/1000" alt="">
            </div>
        </div>

        <livewire:top-tags />
    </article>
@endsection
@push('scripts')
    @include('ajax')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            //bookmark ajax
        });
    </script>
@endpush
