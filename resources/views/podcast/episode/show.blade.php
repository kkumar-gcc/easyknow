@extends('layouts.podcast', ['pageDirection' => 'flex-col-reverse'])

@section('content')
    <?php
    function nice_number($n)
    {
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
        @foreach ($podcast->episodes as $episode)
            <div class="relative mt-3 w-full p-2.5 text-base text-left  border border-transparent rounded-3xl font-normal text-gray-700 dark:text-gray-400 hover:bg-gray-100 hover:shadow-md dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 "
                id="episode-{{ $episode->id }}">
                {{-- {{ $episode->id == $currentEp->id ? 'bg-yellow-300 border-yellow-500' : '' }} --}}
                <div class="flex flex-col items-stretch justify-center p-6 sm:flex-row">
                    <div class="basis-1/3 relative text-center min-h-fit">
                        <img class="block relative w-full h-full rounded-xl  object-cover shadow-md hover:shadow-sm sm:absolute sm:top-0 sm:left-0 "
                            src="https://picsum.photos/400/300" alt="">
                    </div>
                    <div class="basis-2/3 mt-2 relative leading-normal sm:mt-0 sm:px-4">
                        <a href="/podcasts/{{ $podcast->id }}/episodes/{{ $episode->id }}#episode-{{ $episode->id }}"
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
                            href="/podcasts/{{ $podcast->id }}/episodes/{{ $episode->id }}#episode-{{ $episode->id }}">
                            {{ __('Listen Podcast') }}
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
        
        {{-- @include('podcast.episode.audio', ['episode' => $currentEp]) --}}

    </div>
@endsection
@section('content-right')
    <article>
        <div class="w-full text-base rounded-2xl mt-1 sm:px-4 md:px-6 lg:px-0">
            <div class="relative  w-full  overflow-hidden   pb-2.5 px-3.5">
                <img class="object-cover h-48 w-full rounded-xl" src="https://picsum.photos/1200/1000" alt="">
            </div>
            <div class="w-full py-2.5 px-3.5">
                <h5 class="font-poppins text-orange-600">The Laracasts Snippet | Episode {{ $currentEp->serial_number }}
                </h5>

                <h2 class="mb-2 text-xl font-bold tracking-normal md:text-lg lg:text-xl">{{ $currentEp->title }}</h2>
                <div class="clamp five-lines tracking-wide lg:three-lines mt-6 mb-auto text-[14px] text-gray-600 lg:mt-0">
                    {!! $currentEp->description !!}
                </div>
            </div>
            <div class="item-meta global-meta py-2.5 px-3.5">
                <div class="item-profile-image">
                    <a href="/users/{{ $podcast->user_id }}/{{ $podcast->user->username }}/public" class="global-image">
                        <img src="{{ asset($podcast->user->profile_image ?? 'https://picsum.photos/800/800') }}"
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
            <div class="py-2.5 px-3.5">
                <div class="border-2 bg-white rounded-xl w-full h-auto p-4 mt-1">
                    <div class="flex flex-row items-center justify-center">
                        <div class="relative overflow-hidden w-20  h-20">
                            <img class="object-cover h-20 w-20 rounded-xl" src="https://picsum.photos/1200/1000"
                                alt="">
                        </div>
                        <div class="flex-1 w-full pl-2 lg:w-1/3 ">
                            <h5 class="font-poppins text-orange-600">Episode
                                {{ $currentEp->serial_number }}
                            </h5>
                            <h2 class="mb-2 text-xl font-bold tracking-normal md:text-lg lg:text-xl">
                                {{ $currentEp->title }}</h2>
                        </div>
                    </div>
                    <div class="relative my-4">

                        <div class="absolute top-0 bottom-0 my-auto flex items-center   w-full text-[10px]">
                            <div class="flex justify-start flex-none z-10  pl-0.5">
                                <span class="bg-[#fdf280f2] px-[5px] rounded-sm font-mono tracking-[.5px] "
                                    id="time-current">
                                </span>
                            </div>
                            <div class="flex justify-end ml-auto flex-none text-right  z-10 pr-0.5">
                                <span class="bg-white px-[5px] rounded-sm font-mono tracking-[.5px]" id="time-total">
                                </span>
                            </div>
                        </div>
                        <audio class="hidden" id="podcastEpisode" preload="none" src="{{ $currentEp->link }}"></audio>
                        <div id="waveform" class=""></div>
                    </div>

                    <div class="flex flex-row items-center justify-center mt-4">
                        <div class="flex-none">
                            <button class="border-2 rounded-md px-[6px] border-gray-400" id="audioSpeed"></button>
                        </div>
                        <div class="flex-auto mx-auto w-56 flex flex-row justify-between items-center px-4">
                            <div class="flex-none mx-auto w-40 flex flex-row justify-between items-center px-4">
                                <div class="flex-auto text-center pr-2">
                                    <button id="audioRewind"> @svg('carbon-rewind-10', 'h-6 w-6')</button>
                                </div>
                                <div class="flex-auto text-center px-2">
                                    <button id="pausePlay" aria-label="play"></button>
                                </div>
                                <div class="flex-auto text-center pl-2">
                                    <button id="audioForward">@svg('carbon-forward-10', 'h-6 w-6')</button>
                                </div>
                            </div>
                        </div>
                        <div class="flex-none flex justify-end">
                            <button class="group relative">@svg('heroicon-s-volume-up', 'h-6 w-6')
                                <div class="absolute  h-10  hidden group-hover:block ">
                                    <input id="audioVolume" type="range" class="" min="0" max="1"
                                        value="1" step="0.1">
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
@endsection
@push('scripts')
    @include('ajax')
    <script>
        function episodeTime(time) {
            // Hours, minutes and seconds
            var hrs = ~~(time / 3600);
            var mins = ~~((time % 3600) / 60);
            var secs = ~~time % 60;

            // Output like "1:01" or "4:03:59" or "123:03:59"
            var ret = "";
            if (hrs > 0) {
                ret += "" + hrs + ":" + (mins < 10 ? "0" : "");
            }
            ret += "" + String(mins).padStart(2, '0') + ":" + (secs < 10 ? "0" : "");
            ret += "" + secs;
            return ret;
        }
        var audioPlay = document.getElementById('audioPlay');
        var wavesurfer = WaveSurfer.create({
            container: '#waveform',
            barWidth: 2,
            barHeight: 1,
            barGap: null,
            height: 90,
            responsive: true,
        });
        var podcastEpisode = $("#podcastEpisode").attr('src');
        wavesurfer.load(podcastEpisode);
        wavesurfer.on('ready', function() {
            var totalTime = wavesurfer.getDuration(),
                currentTime = wavesurfer.getCurrentTime(),
                playSpeed = wavesurfer.getPlaybackRate();
            document.getElementById('time-total').innerText = episodeTime(totalTime);
            document.getElementById('time-current').innerText = episodeTime(currentTime);
            document.getElementById('audioSpeed').innerText = playSpeed + 'x';
            document.getElementById('audioVolume').value = wavesurfer.getVolume();
            $("#pausePlay").html(`@svg('bi-play-circle', 'h-6 w-6')`)
            var timeline = Object.create(WaveSurfer.Timeline);


            timeline.init({
                wavesurfer: wavesurfer,
                container: '#waveform-timeline',
                primaryFontColor: '#fff',
                primaryColor: '#fff',
                secondaryColor: '#fff',
                secondaryFontColor: '#fff'
            });
        });

        $(document).on('click', "#pausePlay", function() {
            var label = $(this).attr('aria-label');
            if (label == 'pause') {
                wavesurfer.playPause();
                $(this).removeClass('is-playing');
                $(this).html(`@svg('bi-play-circle', 'h-6 w-6')`);
                $(this).attr('aria-label', 'play');
            }
            if (label == 'play') {
                wavesurfer.playPause();
                $(this).addClass('is-playing');
                $(this).html(`@svg('bi-pause-circle', 'h-6 w-6')`);
                $(this).attr('aria-label', 'pause');
            }
        })

        $(document).on('click', "#audioRewind", function() {
            wavesurfer.skipBackward(10)
        });
        $(document).on('click', "#audioForward", function() {
            wavesurfer.skipForward(10)
        })

        $(document).on('click', "#audioSpeed", function() {
            var audioSpeed = wavesurfer.getPlaybackRate();
            if (audioSpeed >= 2) {
                wavesurfer.setPlaybackRate(0.25);
            } else {
                wavesurfer.setPlaybackRate(audioSpeed + 0.25)
            }
            document.getElementById('audioSpeed').innerText = wavesurfer.getPlaybackRate() + 'x';
        });

        var onChangeVolume = function(e) {
            wavesurfer.setVolume(e.target.value);
        };

        $(document).on('input', "#audioVolume", onChangeVolume);
        $(document).on('change', "#audioVolume", onChangeVolume);

        wavesurfer.on('interaction', function() {
            var totalTime = wavesurfer.getDuration(),
                currentTime = wavesurfer.getCurrentTime();
            document.getElementById('time-current').innerText = episodeTime(currentTime);
        });
        wavesurfer.on('audioprocess', function() {
            var totalTime = wavesurfer.getDuration(),
                currentTime = wavesurfer.getCurrentTime();
            document.getElementById('time-current').innerText = episodeTime(currentTime);
            // if()
        });
    </script>
@endpush
