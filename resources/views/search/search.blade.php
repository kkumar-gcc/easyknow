@extends('layouts.base')

@section('content')
    <?php
    function nice_number($n)
    {
        // $n = 0 + int(str_replace(',', '', $n));
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

        <div class="mt-4">
            <h1 class="inline-block mb-2 text-4xl font-extrabold tracking-tight text-gray-900 dark:text-white"> Search
                results for "{!! Str::words($query, 4) !!}"</h1>
        </div>
        <div class="mb-4 mt-4 border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-nowrap  whitespace-nowrap  -mb-px text-sm font-medium text-center" role="tablist">
                <li class="mr-2" role="presentation">
                    <a class="inline-block p-4 rounded-t-lg border-b-2  {{ $tab == 'blogs' ? 'text-rose-600  dark:text-rose-500  border-rose-600 dark:border-rose-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-transparent text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-700' }}"
                        href="/search/blogs?query={{ $query }}" role="tab">Blogs</a>
                </li>
                <li class="mr-2" role="presentation">
                    <a class="inline-block p-4 rounded-t-lg border-b-2  {{ $tab == 'users' ? 'text-rose-600  dark:text-rose-500  border-rose-600 dark:border-rose-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-transparent text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-700' }}"
                        href="/search/users?query={{ $query }}" role="tab">Users</a>
                </li>
                <li class="mr-2" role="presentation">
                    <a class="inline-block p-4 rounded-t-lg border-b-2  {{ $tab == 'tags' ? 'text-rose-600  dark:text-rose-500  border-rose-600 dark:border-rose-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-transparent text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-700' }}"
                        href="/search/tags?query={{ $query }}" role="tab">Tags</a>
                </li>
            </ul>
        </div>
        @if ($tab == 'blogs')
            @include('search.blogs', ['blogs' => $blogs])
        @elseif($tab == 'users')
            @include('search.users', ['users' => $users])
        @elseif($tab == 'tags')
            @include('search.tags', ['tags' => $tags])
        @endif
    </div>
@endsection
@section('content-left')
    <article id="sticky-sidebar" class="">
        <livewire:top-blogs />
        <livewire:top-users />
        <div
            class="relative mt-3 w-full  text-base text-left  border  border-gray-200 rounded-xl font-normal   hover:shadow-md dark:border-gray-700 dark:bg-gray-800 ">
            <header class="py-3 px-4 text-2xl font-semibold text-gray-700 dark:text-white">
                <span class="modern-badge modern-badge-danger">#Advertisment</span>
            </header>
            <div
                class="border-t py-3 px-4 last:rounded-b-xl border-gray-200  dark:hover:text-white dark:border-gray-700 hover:bg-gray-100 hover:shadow-md dark:bg-gray-800 dark:hover:bg-gray-700">
                <div class="relative  pt-[60%] w-full rounded-xl sm:pt-[50%] md:pt-[42%] ">
                    <img class="absolute m-0 top-0 left-0 right-0 bottom-0 w-full h-full object-cover rounded-xl shadow-md drop-shadow-md bg-white dark:bg-gray-800"
                        src="https://picsum.photos/400/300" alt="" />
                </div>
            </div>
        </div>
        <livewire:top-tags />
    </article>
@endsection
@push('scripts')
    @include('ajax')
    <script>
        $(document).ready(function() {

        });
    </script>
@endpush
