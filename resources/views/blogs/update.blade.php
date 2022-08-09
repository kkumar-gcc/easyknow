@extends('layouts.blog')
@push('styles')
    <x-head.tinymce-config />
@endpush
@section('content')
    <main class="relative prose max-w-none lg:max-w-full xl:max-w-none prose-img:rounded-xl dark:prose-invert prose-a:text-rose-600 dark:prose-a:text-rose-500">
        <div id="toast-info">

        </div>
        <form method="post" action="{{ Route('blogs.edit') }}">
            @csrf
            @method('put')
            <input type="hidden" id="blog_id" name="blog_id" value="{{ $blog->id }}" />
            <input type="hidden" name="user_id" value="{{ $blog->user_id }}" />

            <div class="mb-4 ">
                <label class="form-label" for="blog_image">Add a cover image</label>
                <input type="file" class="form-control form-control-lg" id="blog_image" name="image" />
            </div>
            <div class="mb-4">
                <label for="blog_title" class="block mb-2 text-base font-medium text-gray-900 dark:text-white">Title
                    </label>
                <input type="text" id="blog_title"
                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-4 focus:ring-rose-500/20 focus:border-rose-600 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-4 dark:focus:border-rose-500"
                    name="title" value="{{ $blog->title }}" />
            </div>
            <input type="hidden" name="tags" id="tag-input" value="{{ old('tags', $tagTitles) }}">
            <div class="mb-4">
                <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white" for="js-typeahead-tags">Add
                    Tags</label>
                <div class="typeahead__container">
                    <div class="typeahead__field">
                        <div class="typeahead__query">
                            <input
                                class="js-typeahead-tags border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-4 focus:ring-rose-500/20 focus:border-rose-600 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-4 dark:focus:border-rose-500"
                                name="tag[query]" placeholder="Search" autocomplete="off" id="js-typeahead-tags">
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-4">
                <label for="myeditorinstance"
                    class="block mb-2 text-base font-medium text-gray-900 dark:text-white">Description</label>
                <textarea id="myeditorinstance" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-4 focus:ring-rose-500/20 focus:border-rose-600 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-4 dark:focus:border-rose-500" name="description">{{ $blog->description }}</textarea>
            </div>
           
            <button type="submit" class="inline-flex items-center justify-center px-5 py-2 mb-4 text-sm font-medium text-center text-white no-underline rounded-lg cursor-pointer whitespace-nowrap bg-gradient-to-br from-rose-600 to-pink-500 hover:bg-gradient-to-bl focus:ring-2 focus:outline-none focus:ring-rose-300 dark:focus:ring-rose-800"> Update
            </button>
        </form>
    </main>
@endsection
