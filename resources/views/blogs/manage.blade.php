@extends('layouts.blog')
@push('styles')
    <x-head.tinymce-config />
@endpush
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
    <main
        class="relative prose max-w-none lg:max-w-full xl:max-w-none prose-img:rounded-xl dark:prose-invert prose-a:text-rose-600 dark:prose-a:text-rose-500">
        
        <div id="toast-info">

        </div>
        <section>
            <x-cards.card-primary :blog=$blog class="not-prose sm:border-gray-200"/>
            {{-- <div class="not-prose relative mt-3 w-full p-2.5 text-base text-left font-normal  border border-gray-200 rounded-xl hover:shadow-md dark:border-gray-700 dark:bg-gray-800 "
                id="blog-{{ $blog->id }}">
                <div class="flex flex-col items-stretch justify-center p-6 sm:flex-row">
                    <div class="relative text-center basis-1/3 min-h-fit">
                        <img class="relative block object-cover w-full h-full shadow-md rounded-xl hover:shadow-sm sm:absolute sm:top-0 sm:left-0 "
                            src="https://picsum.photos/400/300" alt="">
                    </div>
                    <div class="relative mt-2 leading-normal basis-2/3 sm:mt-0 sm:px-4">
                        <div class="flex flex-row mt-3 mb-1 md:mt-0">
                            <div class="flex flex-row items-center flex-1">
                                <div class="mr-2 text-sm">
                                    {{ nice_number($blog->bloglikes->where('status', 1)->count()) }} <span>likes</span>
                                </div>
                                <div class="mr-2 text-sm">
                                    {{ nice_number($blog->blogviews->count()) }} <span>views</span>
                                </div>
                            </div>
                            <div>
                                @guest

                                    <button type="button"
                                        class="flex flex-row items-center p-2 mr-1 text-sm rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700"
                                        data-modal-toggle="loginMessageModal">
                                        <span title="Bookmark this Article">
                                            @svg('gmdi-bookmark-add-o', 'h-5 w-5') </span>
                                    </button>
                                @else
                                    @if (auth()->user()->id != $blog->user_id)
                                        <form method="POST" id="bookmark-{{ $blog->id }}" class="bookmark_form">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="user_id" id="user_bookmark_id_{{ $blog->id }}"
                                                value="{{ auth()->user()->id }}">
                                            <input type="hidden" name="blog_id" id="blog_bookmark_id_{{ $blog->id }}"
                                                value="{{ $blog->id }}">
                                            <button type="submit"
                                                class="flex flex-row items-center p-2 mr-1 text-sm rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700">
                                                <span class="bookmark_btn_{{ $blog->id }}"
                                                    id="bookmark_btn_{{ $blog->id }}" title="Bookmark this Article">
                                                    @if ($blog->isBookmarked())
                                                        @svg('gmdi-bookmark-added-r', 'w-5 h-5 text-rose-500 dark:text-rose-500')
                                                    @else
                                                        @svg('gmdi-bookmark-add-o', 'h-5 w-5')
                                                    @endif
                                                </span>
                                            </button>

                                        </form>
                                    @endif
                                @endguest
                            </div>
                        </div>

                        <a href="/blogs/{{ Str::slug($blog->title, '-') }}-{{ $blog->id }}"
                            class="link link-secondary">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 line-clamp-3 dark:text-white ">
                                {{ $blog->title }}
                            </h5>
                        </a>
                        <p class="font-normal line-clamp-3 sm:hidden">
                            {!! Str::words(strip_tags($blog->description), 50) !!}
                        </p>
                        @foreach ($blog->tags as $tag)
                            <a href="/blogs/tagged/{{ $tag->title }}" class="tag-popover"
                                id="tag{{ $blog->id }}-{{ $tag->id }}">
                                <span class="modern-badge  modern-badge-{{ $tag->color }}">
                                    #{{ $tag->title }}
                                </span>
                            </a>
                        @endforeach
                        <p class="mt-3">
                            <span class="mr-1">by </span>
                            <a class="text-sm font-medium text-gray-900 truncate dark:text-white user-popover"
                                href="/users/{{ $blog->user->username }}"
                                id="user{{ $blog->id }}-{{ $blog->user_id }}">
                                {{ __($blog->user->username) }}
                            </a>
                            <span class="ml-1 text-sm">posted 3 weeks ago</span>
                        </p>
                        <a class="w-full mt-5 e-btn e-btn-dark e-btn-lg sm:hidden"
                            href="/blogs/{{ Str::slug($blog->title, '-') }}-{{ $blog->id }}">
                            Read
                            Article
                        </a>
                    </div>
                </div>
            </div> --}}
        </section>
        <div class="relative flex flex-col w-full mt-3 lg:flex-row ">
            <aside class="basis-1/4 not-prose" aria-label="Sidebar">
                <div id="sticky-sidebar" class="hidden py-4 overflow-y-auto rounded lg:block">
                    <ul class="space-y-2">
                        <li>
                            <a href="#general"
                                class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white }} hover:bg-gray-100 dark:hover:bg-gray-700">
                                <span class="ml-3">General</span>
                            </a>
                        </li>
                        <li>
                            <a href="/blogs/edit/{{ Str::slug($blog->title, '-') }}-{{ $blog->id }}"
                                class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                                <span class="flex-1 ml-3 whitespace-nowrap">Edit</span>
                            </a>
                        </li>
                        <li>
                            <a href="/blogs/stats/{{ Str::slug($blog->title, '-') }}-{{ $blog->id }}"
                                class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                                <span class="flex-1 ml-3 whitespace-nowrap">Stats</span>
                            </a>
                        </li>

                        <li>
                            <a href="#seo-settings"
                                class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                                <span class="flex-1 ml-3 whitespace-nowrap">Seo Settings</span>
                            </a>
                        </li>
                    </ul>
                    <ul class="pt-4 mt-4 space-y-2 border-t border-gray-200 dark:border-gray-700">
                        <li>
                            <a href="#delete"
                                class="flex items-center p-2 text-base font-normal transition duration-75 rounded-lg text-rose-600 hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white group">
                                <span class="ml-4">Delete Blog</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </aside>

            <div class="flex-1 py-4 my-2 basis-3/4 lg:pl-8 not-prose">
                <div id="loading"></div>
                <section id="general">
                    <div
                        class="relative w-full mt-3 text-base font-normal text-left border border-gray-200 rounded-xl hover:shadow-md dark:border-gray-700 dark:bg-gray-800 ">
                        <header class="px-5 py-4 text-2xl font-semibold text-gray-700 dark:text-white">
                            <h3>General</h3>
                        </header>
                        <div
                            class="px-5 py-4 border-t border-gray-200 last:rounded-b-xl dark:hover:text-white dark:border-gray-700 hover:shadow-md dark:bg-gray-800 dark:hover:bg-gray-700">

                            <form method="POST" id="blog_manage_form" data-blog-id="{{ $blog->id }}">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                                <input type="hidden" name="user_id" value="{{ $blog->user->id }}">
                                <div class="mb-4">
                                    <label for="seo_title"
                                        class="block mb-2 text-base font-medium text-gray-900 dark:text-white">
                                        Title</label>
                                    <input type="text" id="seo_title" aria-describedby="helper-text-explanation"
                                        class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-4 focus:ring-rose-500/20 focus:border-rose-600 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-4 dark:focus:border-rose-500"
                                        name="seo_title" autocomplete="off" @disabled(true)
                                        value="{{ $blog->title }}">
                                </div>
                                <div class="mb-6">
                                    <label for="general_comment"
                                        class="block mb-5 text-base font-medium text-gray-900 dark:text-white">Who Can
                                        Comment ?</label>
                                    <ul id="general_comment" class="grid w-full gap-6 md:grid-cols-3">
                                        <li class="relative">
                                            <input type="radio" id="comment-anyone" name="comment_access"
                                                value="enable" class="hidden peer" {{ ($blog->comment_access=="enable")? "checked" : "" }}
                                                required="">
                                            <label for="comment-anyone"
                                                class="inline-flex items-center justify-between w-full p-3 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer peer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-rose-500 peer-checked:border-rose-600 peer-checked:text-rose-600 hover:text-gray-600 hover:bg-gray-50 peer-checked:hover:bg-white dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                                <div class="block">
                                                    <div class="w-full text-sm">Anyone</div>
                                                </div>
                                            </label>
                                            <div
                                                class="absolute hidden w-5 h-5 peer-checked:block top-4 right-5 dark:peer-checked:text-rose-500 peer-checked:border-rose-600 peer-checked:text-rose-600">
                                                @svg('heroicon-o-check', 'w-4 h-4 ml-2')
                                            </div>
                                        </li>
                                        <li class="relative">
                                            <input type="radio" id="comment-none" name="comment_access"
                                                value="disable" class="hidden peer" {{ ($blog->comment_access=="disable")? "checked" : "" }}>
                                            <label for="comment-none"
                                                class="inline-flex items-center justify-between w-full p-3 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer peer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-rose-500 peer-checked:border-rose-600 peer-checked:text-rose-600 hover:text-gray-600 hover:bg-gray-50 peer-checked:hover:bg-white dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                                <div class="block">
                                                    <div class="w-full text-sm">Comment Off</div>
                                                </div>
                                            </label>
                                            <div
                                                class="absolute hidden w-5 h-5 peer-checked:block top-4 right-5 dark:peer-checked:text-rose-500 peer-checked:border-rose-600 peer-checked:text-rose-600">
                                                @svg('heroicon-o-check', 'w-4 h-4 ml-2')
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="mb-6">
                                    <label for="general_comment"
                                        class="block mb-5 text-base font-medium text-gray-900 dark:text-white">Reader
                                        Access </label>
                                    <ul id="general_comment" class="grid w-full gap-6 md:grid-cols-3">
                                        <li class="relative">
                                            <input type="radio" id="reader-anyone" name="blog_access" value="public"
                                                class="hidden peer" {{ ($blog->access=="public")? "checked" : "" }} required="">
                                            <label for="reader-anyone"
                                                class="inline-flex items-center justify-between w-full p-3 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer peer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-rose-500 peer-checked:border-rose-600 peer-checked:text-rose-600 hover:text-gray-600 hover:bg-gray-50 peer-checked:hover:bg-white dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                                <div class="block">
                                                    <div class="w-full text-sm">Public</div>
                                                </div>
                                            </label>
                                            <div
                                                class="absolute hidden w-5 h-5 peer-checked:block top-4 right-5 dark:peer-checked:text-rose-500 peer-checked:border-rose-600 peer-checked:text-rose-600">
                                                @svg('heroicon-o-check', 'w-4 h-4 ml-2')
                                            </div>
                                        </li>
                                        <li class="relative">
                                            <input type="radio" id="reader-follower" name="blog_access"
                                                value="follower" class="hidden peer" {{ ($blog->access=="follower")? "checked" : "" }}>
                                            <label for="reader-follower"
                                                class="inline-flex items-center justify-between w-full p-3 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer peer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-rose-500 peer-checked:border-rose-600 peer-checked:text-rose-600 hover:text-gray-600 hover:bg-gray-50 peer-checked:hover:bg-white dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                                <div class="block">
                                                    <div class="w-full text-sm">Only Follower</div>
                                                </div>
                                            </label>
                                            <div
                                                class="absolute hidden w-5 h-5 peer-checked:block top-4 right-5 dark:peer-checked:text-rose-500 peer-checked:border-rose-600 peer-checked:text-rose-600">
                                                @svg('heroicon-o-check', 'w-4 h-4 ml-2')
                                            </div>
                                        </li>
                                        <li class="relative">
                                            <input type="radio" id="reader-none" name="blog_access" value="private"
                                                class="hidden peer" {{ ($blog->access=="private")? "checked" : "" }}>
                                            <label for="reader-none"
                                                class="inline-flex items-center justify-between w-full p-3 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer peer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-rose-500 peer-checked:border-rose-600 peer-checked:text-rose-600 hover:text-gray-600 hover:bg-gray-50 peer-checked:hover:bg-white dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                                <div class="block">
                                                    <div class="w-full text-sm">Private</div>
                                                </div>
                                            </label>
                                            <div
                                                class="absolute hidden w-5 h-5 peer-checked:block top-4 right-5 dark:peer-checked:text-rose-500 peer-checked:border-rose-600 peer-checked:text-rose-600">
                                                @svg('heroicon-o-check', 'w-4 h-4 ml-2')
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="mb-6">
                                    <label class="block mb-5 text-base font-medium text-gray-900 dark:text-white">Adult
                                        Content</label>
                                    <ul class="grid w-full gap-6 md:grid-cols-2">
                                        <li>
                                            <input type="checkbox" id="adult_warning" @checked( $blog->adult_warning)
                                                class="hidden peer" required="" name="adult_warning">
                                            <label for="adult_warning"
                                                class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 peer-checked:text-rose-600 peer-checked:border-rose-600 hover:text-gray-600 dark:peer-checked:text-rose-500 peer-checked:hover:bg-white hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                                <div class="block">

                                                    <div class="w-full text-sm">Show warning to blog readers</div>
                                                </div>
                                            </label>
                                        </li>
                                        <li>
                                            <input type="checkbox" id="age_confirmation" @checked( $blog->age_confirmation)
                                                name="age_confirmation" class="hidden peer">
                                            <label for="age_confirmation"
                                                class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 peer-checked:border-rose-600 hover:text-gray-600 dark:peer-checked:text-rose-500 peer-checked:text-rose-600 hover:bg-gray-50 peer-checked:hover:bg-white dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                                <div class="block">

                                                    <div class="w-full text-sm">Require age confirmation</div>
                                                </div>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                                <button type="submit" id="manage_form_button_{{ $blog->id }}"
                                    class="inline-flex justify-center items-center font-medium rounded-lg text-sm px-5 py-2.5 text-center no-underline cursor-pointer whitespace-nowrap text-white bg-gradient-to-br from-rose-600 to-pink-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-rose-300 dark:focus:ring-rose-800">Save
                                </button>
                            </form>
                        </div>
                    </div>
                </section>
                <section id="seo-settings">
                    <div
                        class="relative w-full mt-3 text-base font-normal text-left border border-gray-200 rounded-xl hover:shadow-md dark:border-gray-700 dark:bg-gray-800 ">
                        <header class="px-5 py-4 text-2xl font-semibold text-gray-700 dark:text-white">
                            <h3>Seo Settings</h3>
                        </header>
                        <div
                            class="px-5 py-4 border-t border-gray-200 last:rounded-b-xl dark:hover:text-white dark:border-gray-700 hover:shadow-md dark:bg-gray-800 dark:hover:bg-gray-700">

                            <form method="POST" id="blog_seo_form" data-blog-id="{{ $blog->id }}">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                                <input type="hidden" name="user_id" value="{{ $blog->user->id }}">
                                <div class="mb-4">
                                    <label for="seo_title"
                                        class="block mb-2 text-base font-medium text-gray-900 dark:text-white">Seo
                                        Title</label>
                                    <input type="text" id="seo_title" aria-describedby="helper-text-explanation"
                                        class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-4 focus:ring-rose-500/20 focus:border-rose-600 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-4 dark:focus:border-rose-500"
                                        name="seo_title" autocomplete="off" value="{{ old('seo_title', $blog->meta_title ?? '') }}">
                                </div>
                                <div class="mb-4">
                                    <label for="seo_description"
                                        class="block mb-2 text-base font-medium text-gray-900 dark:text-white">Seo
                                        Description</label>
                                    <textarea id="seo_description"
                                        class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-4 focus:ring-rose-500/20 focus:border-rose-600 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-4 dark:focus:border-rose-500"
                                        name="seo_description" data-mdb-showcounter="true" maxlength="200" rows="4">{{ old('seo_description', $blog->meta_description ?? '') }}</textarea>
                                </div>
                                <button type="submit" id="seo_form_button_{{ $blog->id }}"
                                    class="inline-flex justify-center items-center font-medium rounded-lg text-sm px-5 py-2.5 text-center no-underline cursor-pointer whitespace-nowrap text-white bg-gradient-to-br from-rose-600 to-pink-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-rose-300 dark:focus:ring-rose-800">Save
                                </button>

                            </form>
                        </div>
                    </div>
                </section>
                <section id="delete">
                    <div
                        class="relative w-full mt-5 text-base font-normal text-left border border-rose-600 rounded-xl hover:shadow-md dark:border-rose-500 dark:bg-gray-800 ">
                        <header class="px-5 py-4 text-2xl font-semibold text-gray-700 dark:text-white">
                            <h3>Delete Blog</h3>
                        </header>
                        <div
                            class="px-5 py-4 border-t border-gray-200 last:rounded-b-xl dark:hover:text-white dark:border-gray-700 hover:shadow-md dark:bg-gray-800 dark:hover:bg-gray-700">

                            <form method="POST" id="profile_update">
                                <p>Once you delete your account, there is no going back. Please be certain.</p>
                                <button
                                    class="mt-3 inline-flex justify-center items-center font-medium rounded-lg text-sm px-5 py-2.5 text-center no-underline cursor-pointer whitespace-nowrap text-white bg-gradient-to-br from-rose-600 to-pink-500 hover:bg-gradient-to-bl  focus:outline-none">Delete
                                    account</button>
                            </form>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </main>
@endsection
@push('scripts')
    @include('ajax')
    <script>
        $(document).ready(function() {
            $(document).on('submit', '#blog_manage_form', function(e) {
                $.ajaxSetup({
                    header: $('meta[name="_token"]').attr('content')
                })
                e.preventDefault(e);
                var blog_id = $(this).attr('data-blog-id');
                $.ajax({
                    type: "PUT",
                    url: '{{ Route('blogs.manage') }}',
                    data: $(this).serialize(),
                    beforeSend: function() {
                        $("#manage_form_button_" + blog_id).html(
                            ` <div role="status">
                                <svg role="status" class="inline w-4 h-4 mr-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                                </svg>
                                updating...
                        </div>`);
                    },
                    dataType: 'json',
                    success: function(data) {
                        if(data.success){
                            $("#manage_form_button_" + blog_id).html(`Save`);
                        }
                        
                    }
                })
            });
            $(document).on('submit', '#blog_seo_form', function(e) {
                $.ajaxSetup({
                    header: $('meta[name="_token"]').attr('content')
                })
                e.preventDefault(e);
                var blog_id = $(this).attr('data-blog-id');
                $.ajax({
                    type: "PUT",
                    url: '{{ Route('blogs.manage.seo') }}',
                    data: $(this).serialize(),
                    beforeSend: function() {
                        $("#seo_form_button_" + blog_id).html(
                            ` <div role="status">
                                <svg role="status" class="inline w-4 h-4 mr-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                                </svg>
                                updating...
                        </div>`);
                    },
                    dataType: 'json',
                    success: function(data) {
                        if(data.success){
                            $("#seo_form_button_" + blog_id).html(`Save`);
                        }
                        
                    }
                })
            });
        })
    </script>
@endpush
