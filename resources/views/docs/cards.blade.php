@extends('layouts.docs')
@push('styles')
    <x-head.tinymce-config />
@endpush
@section('content-left')
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
    @include('docs.side')
@endsection
@section('content')
    <div class="py-3 px-2 text-base ">
        <h2 class="text-5xl">Cards</h2>
        <p class="my-4 text-base">Responsive Alerts built with the latest Bootstrap 5. Alerts provide contextual feedback
            messages for typical user actions with a handful of responsible and flexible alert boxes.
        </p>
        <hr>
        <section>
            <div class="py-4">
                <h2 class="text-2xl">Basic example</h2>
                <p class="mb-5">Use the following examples of alert components to show messages as feedback to your users.
                </p>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <div class="border border-gray-300 p-8 rounded-xl">

                </div>
            </div>
        </section>
        <section>
            <div
                class="flex flex-col items-center bg-white rounded-lg border shadow-md md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                <img class="object-cover w-full h-96 rounded-t-lg md:h-auto md:w-48 md:rounded-none md:rounded-l-lg"
                    src="/docs/images/blog/image-4.jpg" alt="">
                <div class="flex flex-col justify-between p-4 leading-normal">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Noteworthy technology
                        acquisitions 2021</h5>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Here are the biggest enterprise technology
                        acquisitions of 2021 so far, in reverse chronological order.</p>
                </div>
            </div>
        </section>
        <section>
            <div class=" e-scard" id="blog-242">
                <div class="card-body">
                    <div class="image"> <img class="shadow-md hover:shadow-sm" src="https://picsum.photos/400/300"
                            alt=""> </div>
                    <div class="detail">
                        <div class="statics"> <span> <small> 0
                                    likes</small></span> <span class="text-muted"><small> 1
                                    views</small></span> </div> <span class="bookmark " title="Bookmark this Article"> <a
                                class="e-rbtn"> <svg width="18" height="18" xmlns="http://www.w3.org/2000/svg"
                                    enable-background="new 0 0 24 24" viewBox="0 0 24 24" fill="currentColor">
                                    <rect fill="none" height="24" width="24"></rect>
                                    <path
                                        d="M17,11v6.97l-5-2.14l-5,2.14V5h6V3H7C5.9,3,5,3.9,5,5v16l7-3l7,3V11H17z M21,7h-2v2h-2V7h-2V5h2V3h2v2h2V7z">
                                    </path>
                                </svg> </a> </span> <a href="/blogs/in-vitae-ut-id-242" class="link link-secondary">
                            <h5 class="title">In vitae ut id.</h5>
                        </a>
                        <p class="card-text disable"> Alice; 'but when you come to the Mock Turtle repeated thoughtfully. 'I
                            should like it very much,' said Alice, in a hurry: a large cauldron which seemed to be otherwise
                            than what you were never even. </p> <a href="/blogs/tagged/friends" class="tag-popover"
                            id="tag242-6"> <span class="modern-badge  modern-badge-info"> #friends </span> </a> <a
                            href="/blogs/tagged/interest" class="tag-popover" id="tag242-8"> <span
                                class="modern-badge  modern-badge-dark"> #interest </span> </a> <a
                            href="/blogs/tagged/inspiration" class="tag-popover" id="tag242-5"> <span
                                class="modern-badge  modern-badge-light"> #inspiration </span> </a>
                        <p class="mt-3"> by <a class="btn-link link-secondary user-popover" href="/users/hunter.fritsch"
                                id="user242-98"> hunter.fritsch </a> <small class="text-muted"> posted
                                3 weeks ago </small> </p> <a class="e-btn e-btn-dark e-btn-lg disable " href="/blogs/242">
                            Read Article </a>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="py-4">
                <h2 class="text-2xl">Basic example</h2>
                <p class="mb-5">Use the following examples of alert components to show messages as feedback to your users.
                </p>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <div class="border border-gray-300 p-8 rounded-xl">

                </div>
            </div>
        </section>
        <section>
            <div class="py-4">
                <h2 class="text-2xl">Basic example</h2>
                <p class="mb-5">Use the following examples of alert components to show messages as feedback to your users.
                </p>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <div class="border border-gray-300 p-8 rounded-xl">

                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    @include('ajax')
@endpush
