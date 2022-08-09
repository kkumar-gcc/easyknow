@extends('layouts.user')
@push('styles')
    <x-head.tinymce-config />
@endpush
@section('content-left')
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
    Str::macro('readDuration', function (...$text) {
        $totalWords = str_word_count(implode(' ', $text));
        $minutesToRead = round($totalWords / 200);
    
        return (int) max(1, $minutesToRead);
    });
    
    ?>
    <div class="">
        <article>
            <div id="toast-tag"></div>
            @auth
                <div
                    class="relative mt-3 w-full  text-base text-left  border  border-gray-200 rounded-xl font-normal   hover:shadow-md dark:border-gray-700 dark:bg-gray-800 ">
                    <div class="py-3 px-4 ">

                        <form method="POST" id="tag_create">
                            @csrf
                            @method('put')
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            <div class="mb-3">
                                <input type="text" name="title"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-4 focus:ring-rose-500/20 focus:border-rose-600 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-4 dark:focus:border-rose-500"
                                    id="tag_title" placeholder="tag title" required />
                                <div class="input-error" id="invalid_tag"></div>
                            </div>

                            {{-- <div class="invalid-tooltip">Please choose a unique and valid username.</div> --}}
                            <button type="submit"
                                class="w-full mt-3 inline-flex justify-center items-center font-medium rounded-lg text-sm px-5 py-2.5 text-center no-underline cursor-pointer whitespace-nowrap text-white bg-gradient-to-br from-rose-600 to-pink-500 hover:bg-gradient-to-bl  focus:outline-none">create
                                tag</button>
                        </form>
                    </div>
                </div>
            @endauth
            @if ($topUsers->count() > 3)
                <div
                    class="relative mt-3 w-full  text-base text-left  border  border-gray-200 rounded-xl font-normal   hover:shadow-md dark:border-gray-700 dark:bg-gray-800 ">
                    <header class="py-3 px-4 text-2xl font-semibold text-gray-700 dark:text-white">
                        <h3> Top Users</h3>
                    </header>
                    <ul class="p-0 list-none">
                        @foreach ($topUsers as $topUser)
                            <li
                                class="border-t py-3 px-4 last:rounded-b-xl border-gray-200  dark:hover:text-white dark:border-gray-700 hover:bg-gray-100 hover:shadow-sm dark:bg-gray-800 dark:hover:bg-gray-700">
                                <a href="/users/{{ $topUser->username }}" class="flex items-center space-x-4 user-popover"
                                    id="user-1" id="user-{{ $topUser->id }}" data-popover-placement="left">
                                    <img class="w-12 h-12 rounded-full"
                                        src="{{ asset($topUser->profile_image ?? 'images/1654760695anime3.png') }}"
                                        alt="">
                                    <div class="space-y-1 font-medium ">
                                        <div>{{ $topUser->username }}</div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
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

        </article>
    </div>
@endsection
@section('content')
    <div class="p-2 md:p-5 lg:p-7">
        <div class="">
            <h1 class="inline-block mb-2 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white"> Search
                Tags</h1>
        </div>
        <div class=" my-3 flex flex-row justify-between items-center">
            <div class="flex-1 mr-4">
                <input id="search-input" autocomplete="off" type="search"
                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-4 focus:ring-rose-500/20 focus:border-rose-600 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-4 dark:focus:border-rose-500"
                    placeholder="Search by tag name" name="search">
                {{-- <span class="input-group-text border-0"><i class="fas fa-search" id="mdb-5-search-icon"></i></span> --}}
            </div>

            <button id="tagShortDropdownButton" data-dropdown-toggle="tagShortDropdown" data-dropdown-placement="bottom-end"
                class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-2 focus:ring-gray-200 font-medium text-center inline-flex items-center rounded-lg text-sm px-5 py-2.5  dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                type="button">Sort By <svg class="ml-2 w-4 h-4" aria-hidden="true" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>

            <!-- Dropdown menu -->
            <div id="tagShortDropdown"
                class="hidden z-10  bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700"
                data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="bottom-end">
                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="tagShortDropdownButton">
                    <li>
                        <a class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                            href="/tags?tab=newest">Newest</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                            href="/tags?tab=name">Name</a></ </li>
                    <li>
                        <a href="#"
                            class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                            href="/tags?tab=popular">Popular</a>
                    </li>
                </ul>
            </div>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3  gap-4 border-t border-gray-200 dark:border-gray-700 pt-4"
            id="tag-show">
            @foreach ($tags as $tag)
                <div
                    class="relative mt-2 w-full p-2.5 text-base text-left  border border-transparent rounded-3xl font-normal  hover:bg-gray-100 shadow dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                    <div class="flex flex-col items-stretch justify-center p-6">
                        <a href="/blogs/tagged/{{ $tag->title }}" class="tag-popover" id="tag-{{ $tag->id }}"><span
                                class="modern-badge  modern-badge-{{ $tag->color }}">
                                #{{ $tag->title }}
                            </span>
                        </a>
                        <p class="mt-3 mb-3">Some quick example text to build on the card title and make up the
                            bulk of
                            the card's content.</p>
                        <span class="text-muted">{{ $tag->blogs_count }} blogs</span>
                    </div>
                </div>
            @endforeach

        </div>
        <div class="row" id="new-tag-show"></div>
        <div id="tag-paginator">
            {!! $tags->withQueryString()->links('pagination::tailwind') !!}
        </div>
    </div>
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
            $(document).on('keyup', '#search-input', function() {
                var query = $(this).val();
                if (query != '') {
                    $.ajax({
                        url: "{{ Route('tags.search') }}",
                        method: "GET",
                        data: {
                            query: query
                        },
                        dataType: 'json',
                        success: function(data) {
                            $("#tag-show").hide();
                            if (data.searched) {
                                $("#new-tag-show").html('');
                                $("#tag-paginator").hide('slow');
                                $.each(data.tags, function(index, tag) {
                                    $("#new-tag-show").append(`
                                <div class='col-lg-3 col-md-4 col-sm-12 '>
                                    <div class="e-card">
                                        <div class="e-card-body">
                                            <a href="blogs/tagged/` + tag.title + `"  class="tag-popover"
                                                id="tagSuggest-` + tag.id + `">
                                            <span class="modern-badge  modern-badge-` + tag.color + `">#` + tag.title + `</span></a>

                                            <p class="mt-3 mb-3">Some quick example text to build on the card title and make up the bulk of
                                                the card's content.</p>
                                            <span class="text-muted">` + tag.blogs_count + ` blogs</span>
                                        </div>
                                    </div>
                               </div>
                                `);
                                });
                            }
                        }
                    })
                } else {
                    $("#new-tag-show").hide();
                    $("#tag-show").show('slow');
                    $("#tag-paginator").show('slow');
                }
            });
            $("input#tag_title").on({
                keydown: function(e) {
                    $("#tag_title").removeClass("is-invalid");
                    $("#invalid_tag").text('');
                    if (e.which === 32)
                        return false;
                },
                // change: function() {
                //     this.value = this.value.replace(/\s/g, "");
                // }
            });
            $(document).on('submit', '#tag_create', function(e) {
                $.ajaxSetup({
                    header: $('meta[name="_token"]').attr('content')
                })
                e.preventDefault(e);
                $.ajax({
                    type: "PUT",
                    url: '{{ Route('tag.create') }}',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(data) {
                        if (data.success) {
                            $("#toast-tag").html(`<div class="toast toast-fixed show fade  " id="placement-toast" role="alert" aria-live="assertive"
                            aria-atomic="true"  data-mdb-width="350px"
                            style="width: 350px; display: block; top: unset; left: 10px; bottom: 10px; right: unset; transform: unset;"
                            data-mdb-autohide="true" data-mdb-position="top-right" data-mdb-append-to-body="true">
                            <div class="toast-body ">` + data.success + `</div>
                            </div>`);
                            $("#tag_create")[0].reset();
                            setInterval(() => {
                                $("#toast-tag").html('');
                            }, 5000);
                        }
                        if (data.error) {
                            $("#invalid_tag").text(data.error);
                            $("#tag_title").addClass("is-invalid ");
                        }
                    }
                })
            });
        });
    </script>
@endpush
