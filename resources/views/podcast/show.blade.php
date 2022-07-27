@extends('layouts.podcast', ['pageDirection' => 'flex-col-reverse'])

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

        @if (session()->has('deleteSuccess'))
            <section class="flex justify-content-center my-4 w-100">
                <div class="container">
                    <div class="alert alert-dismissible fade show alert-success" role="alert" data-mdb-color="warning"
                        id="customxD">
                        <strong>Success!</strong> {{ session()->get('deleteSuccess') }}
                        <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </section>
        @endif
        @if (session()->has('success'))
            <section class=" d-flex justify-content-center my-4 w-100">
                <div class="container">
                    <div class="alert alert-dismissible fade show alert-success" role="alert" data-mdb-color="warning"
                        id="customxD">
                        <strong>Success!</strong> {{ session()->get('success') }}
                        <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </section>
        @endif
        @auth
            @can('isPodcastOwner', $podcast)
                <a class="e-btn e-btn-success" href="/podcasts/{{ $podcast->id }}/episode/create">upload new episode</a>
            @endcan
        @endauth
        @if ($podcast->episodes->count() > 0)
            @foreach ($podcast->episodes as $episode)
                <div class="relative mt-3 w-full p-2.5 text-base text-left  border border-transparent rounded-3xl font-normal text-gray-700 dark:text-gray-400 hover:bg-gray-100 hover:shadow-md dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700"
                    id="episode-{{ $episode->id }}">
                    <div class="flex flex-col items-stretch justify-center p-6 sm:flex-row">
                        <div class="basis-1/3 relative text-center min-h-fit">
                            <img class="block relative w-full h-full rounded-xl  object-cover shadow-md hover:shadow-sm sm:absolute sm:top-0 sm:left-0 "
                                src="https://picsum.photos/400/300" alt="">
                        </div>
                        <div class="basis-2/3 mt-2 relative leading-normal sm:mt-0 sm:px-4">
                            <a href="/podcasts/{{ $podcast->id }}/episodes/{{ $episode->id }}"
                                class="link link-secondary">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                    {{ $episode->title }}
                                </h5>
                            </a>
                            <p class="font-normal text-gray-700 dark:text-gray-400">
                                {!! Str::words(strip_tags($episode->description), 20) !!}
                            </p>

                            <p class="mt-3">
                                <span>By </span>
                                <a class="text-sm font-medium text-gray-900 truncate dark:text-white user-popover" h
                                    href="/users/{{ $podcast->user->username }}"
                                    id="user{{ $podcast->id }}-{{ $podcast->user_id }}">
                                    {{ __($podcast->user->username) }}
                                </a>
                                <span class="text-sm">| EP {{ $episode->serial_number }}</span>
                            </p>
                            <a class="e-btn e-btn-dark e-btn-lg mt-5 w-full sm:hidden"
                                href="/podcasts/{{ $podcast->id }}/episodes/{{ $episode->id }}">
                                {{ __('Listen Podcast') }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
            
        @else
            <div class="e-scard e-scard-hover s-empty-state wmx4 p48">
                <div class="card-body">
                    This series doesn't have any episode.
                </div>
            </div>
        @endif
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
