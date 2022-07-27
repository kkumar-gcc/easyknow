@extends('layouts.podcast', ['pageDirection' => 'flex-col-reverse'])
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
    <div class="container-fluid blog mt-4">
        <h1 class="text-xl mb-4">Create new Episode</h1>
        <form method="POST" action="/podcasts/{{ $podcast->id }}/episode/create">
            @csrf
            @method('PUT')
            <div class="form-group mb-6">
                <label class="form-label" for="episode_image">Add a cover image</label>
                <div class="drop-zone  @error('image') drop-zone-danger is-invalid @enderror mb-3" id="podcast_image">
                    <p class="drop-zone__prompt">Drop file here or click to upload</p>
                    <input type="file" name="image" id="episode_image" class="form-control drop-zone__input">
                </div>
                @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-6">
                <label class="form-label" for="episode_audio">Add Episode Audio</label>
                <input type="file" name="audio" id="episode_audio"
                    class="form-control @error('audio') drop-zone-danger is-invalid @enderror" accept="audio/mp3,audio/*;capture=microphone">
                @error('audio')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-6">
                <label class="form-label " for="podcast_title">Title</label>
                <input type="text" id="podcast_title" class="form-control @error('title') is-invalid @enderror"
                    name="title" value="{{ old('title') }}" />
                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-4">
                <label class="form-label" for="editor2">Description</label>

                <textarea id="editor2" name="description"> {{ old('description') }} </textarea>
            </div>
            <button type="submit" class="mt-2 e-btn e-btn-success"> create
            </button>
        </form>
    </div>
@endsection
@section('content-right')
    <article>
        <div class="w-full text-base rounded-2xl mt-1 sm:px-4 md:px-6 lg:px-0">
            <div class="relative  w-full  overflow-hidden   pb-2.5 px-3.5">
                <img class="object-cover h-48 w-full rounded-xl" src="https://picsum.photos/1200/1000" alt="">
            </div>
            <div class="w-full py-2.5 px-3.5">
                <h5 class="font-poppins text-orange-600">Total Episode {{ $podcast->episodes->count() }}</h5>

                <h2 class="mb-2 text-xl font-bold tracking-normal md:text-lg lg:text-xl">{{ $podcast->title }}</h2>
                <div class="clamp five-lines tracking-wide lg:three-lines mt-6 mb-auto text-[14px] text-gray-600 lg:mt-0">
                    {!! $podcast->description !!}
                </div>
            </div>
            <div class="item-meta global-meta py-2.5 px-3.5">
                <div class="item-profile-image">
                    <a href="/users/{{ $podcast->user_id }}/{{ $podcast->user->username }}/public" class="global-image">
                        <img src="{{ asset($podcast->user->profile_image ?? 'https://picsum.photos/200/200') }}"
                            alt="">
                    </a>
                </div>
                <div class="item-author">
                    <a href="/users/{{ $podcast->user->username }}">
                        {{ __($podcast->user->username) }}
                    </a>
                    <div class="item-time">
                        <time datetime="{{ $podcast->created_at }}">
                            {{ \Carbon\Carbon::parse($podcast->created_at)->format('M d, Y') }}
                        </time>
                        ∙ 5 mins read
                    </div>
                </div>
            </div>
        </div>
    </article>
@endsection
@push('scripts')
    @include('ajax')
@endpush
