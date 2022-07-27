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
        <h2 class="text-5xl">Carousel</h2>
        <div class="py-4">

            <section class="mt-4">
                <h2 class="text-2xl">Basic example</h2>
                <div class="border border-gray-300 p-8 rounded-xl mt-2">
                    <div id="carouselExample" class="carousel slide" data-bs-ride="true">
                        <!-- Carousel wrapper -->
                        <div
                            class="carousel-inner  overflow-hidden relative rounded-lg h-56  sm:h-64 xl:h-80 2xl:h-96">
                            <!-- Item 1 -->
                            <div
                                class="carousel-item active duration-700 ease-in-out absolute inset-0  h-full">
                                <img src="https://picsum.photos//685/320"
                                    class="block shadow-lg absolute top-1/2 left-1/2 w-full h-full rounded-lg -translate-x-1/2 -translate-y-1/2"
                                    alt="...">
                            </div>
                            <!-- Item 2 -->
                            <div class="carousel-item duration-700 ease-in-out absolute inset-0 h-full">
                                <img src="https://picsum.photos/686/320"
                                    class="block shadow-lg absolute top-1/2 left-1/2 w-full h-full rounded-lg -translate-x-1/2 -translate-y-1/2"
                                    alt="...">
                            </div>
                            <!-- Item 3 -->
                            <div class="carousel-item duration-700 ease-in-out absolute inset-0  h-full">
                                <img src="https://picsum.photos/687/320"
                                    class="block shadow-lg absolute top-1/2 left-1/2 w-full h-full rounded-lg -translate-x-1/2 -translate-y-1/2"
                                    alt="...">
                            </div>
                        </div>

                        <!-- Slider controls -->
                        <button type="button"
                            class="flex absolute top-0 left-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none"
                            data-bs-target="#carouselExample" data-bs-slide="prev">
                            <span
                                class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7">
                                    </path>
                                </svg>
                                <span class="hidden">Previous</span>
                            </span>
                        </button>
                        <button type="button"
                            class="flex absolute top-0 right-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none"
                            data-bs-target="#carouselExample" data-bs-slide="next">
                            <span
                                class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                    </path>
                                </svg>
                                <span class="hidden">Next</span>
                            </span>
                        </button>
                    </div>
                </div>
            </section>
            <section class="mt-4">
                <h2 class="text-2xl">With Indicators</h2>
                <div class="border border-gray-300 p-8 rounded-xl mt-2">
                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
                        <!-- Carousel wrapper -->
                        <div
                            class="carousel-inner  overflow-hidden relative rounded-lg h-56  sm:h-64 xl:h-80 2xl:h-96">
                            <!-- Item 1 -->
                            <div
                                class="carousel-item active duration-700 ease-in-out absolute inset-0  h-full">
                                <img src="https://picsum.photos/320/100"
                                    class="block absolute top-1/2 left-1/2 w-full h-full rounded-lg -translate-x-1/2 -translate-y-1/2"
                                    alt="...">
                            </div>
                            <!-- Item 2 -->
                            <div class="carousel-item duration-700 ease-in-out absolute inset-0 h-full">
                                <img src="https://picsum.photos/400/100"
                                    class="block absolute top-1/2 left-1/2 w-full h-full rounded-lg -translate-x-1/2 -translate-y-1/2"
                                    alt="...">
                            </div>
                            <!-- Item 3 -->
                            <div class="carousel-item duration-700 ease-in-out absolute inset-0  h-full">
                                <img src="https://picsum.photos/200/100"
                                    class="block absolute top-1/2 left-1/2 w-full h-full rounded-lg -translate-x-1/2 -translate-y-1/2"
                                    alt="...">
                            </div>
                        </div>
                        <!-- Slider indicators -->
                        <div class="flex absolute bottom-5 left-1/2 z-30 space-x-3 -translate-x-1/2 ">
                            <button type="button"
                                class="active w-3 h-3 rounded-full bg-white/50  bg-white dark:bg-gray-800"
                                data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" aria-current="true"
                                aria-label="Slide 1"></button>
                            <button type="button"
                                class="w-3 h-3 rounded-full bg-white/50 active:bg-white dark:bg-gray-800/50 hover:bg-white dark:hover:bg-gray-800"
                                data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                                aria-label="Slide 2"></button>
                            <button type="button"
                                class="w-3 h-3 rounded-full bg-white/50 active:bg-white dark:bg-gray-800/50 hover:bg-white dark:hover:bg-gray-800"
                                data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                                aria-label="Slide 3"></button>
                        </div>
                        <!-- Slider controls -->
                        <button type="button"
                            class="flex absolute top-0 left-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none"
                            data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                            <span
                                class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7">
                                    </path>
                                </svg>
                                <span class="hidden">Previous</span>
                            </span>
                        </button>
                        <button type="button"
                            class="flex absolute top-0 right-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none"
                            data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                            <span
                                class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7">
                                    </path>
                                </svg>
                                <span class="hidden">Next</span>
                            </span>
                        </button>
                    </div>
                </div>
            </section>
            <section class="mt-4">
                <h2 class="text-2xl">Bottom controls</h2>

                <div class="border border-gray-300 p-8 rounded-xl mt-2">

                    <div id="carouselBottomControls" class="carousel slide" data-bs-ride="true">
                        <!-- Carousel wrapper -->
                        <div
                            class="carousel-inner  overflow-hidden relative rounded-lg h-56  sm:h-64 xl:h-80 2xl:h-96">
                            <!-- Item 1 -->
                            <div
                                class="carousel-item active duration-700 ease-in-out absolute inset-0  h-full">
                                <img src="https://picsum.photos/686/319"
                                    class="block absolute top-1/2 left-1/2 w-full h-full rounded-lg -translate-x-1/2 -translate-y-1/2"
                                    alt="...">
                            </div>
                            <!-- Item 2 -->
                            <div class="carousel-item duration-700 ease-in-out absolute inset-0 h-full">
                                <img src="https://picsum.photos/685/319"
                                    class="block absolute top-1/2 left-1/2 w-full h-full rounded-lg -translate-x-1/2 -translate-y-1/2"
                                    alt="...">
                            </div>
                            <!-- Item 3 -->
                            <div class="carousel-item duration-700 ease-in-out absolute inset-0  h-full">
                                <img src="https://picsum.photos/687/319"
                                    class="block absolute top-1/2 left-1/2 w-full h-full rounded-lg -translate-x-1/2 -translate-y-1/2"
                                    alt="...">
                            </div>
                        </div>
                        <!--slider controlers -->
                        <div class="flex absolute bottom-10 right-1/2 z-30 space-x-3 -translate-x-1/2 ">
                            <button type="button"
                                class="flex absolute top-0 right-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none"
                                data-bs-target="#carouselBottomControls" data-bs-slide="prev">
                                <span
                                    class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                    <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 19l-7-7 7-7">
                                        </path>
                                    </svg>
                                    <span class="hidden">Previous</span>
                                </span>
                            </button>
                            <button type="button"
                                class="flex absolute top-0 left-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none"
                                data-bs-target="#carouselBottomControls" data-bs-slide="next">
                                <span
                                    class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                    <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7">
                                        </path>
                                    </svg>
                                    <span class="hidden">Next</span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </section>
            <section class="mt-4">
                <h2 class="text-2xl">Crossfade</h2>
                <div class="border border-gray-300 p-8 rounded-xl mt-2">
                    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="true">
                        <!-- Carousel wrapper -->
                        <div
                            class="carousel-inner  overflow-hidden relative rounded-lg h-56  sm:h-64 xl:h-80 2xl:h-96">
                            <!-- Item 1 -->
                            <div
                                class="carousel-item active duration-700 ease-in-out absolute inset-0  h-full">
                                <img src="https://picsum.photos/686/321"
                                    class="block absolute top-1/2 left-1/2 w-full h-full rounded-lg -translate-x-1/2 -translate-y-1/2"
                                    alt="...">
                            </div>
                            <!-- Item 2 -->
                            <div class="carousel-item duration-700 ease-in-out absolute inset-0 h-full">
                                <img src="https://picsum.photos/686/320"
                                    class="block absolute top-1/2 left-1/2 w-full h-full rounded-lg -translate-x-1/2 -translate-y-1/2"
                                    alt="...">
                            </div>
                            <!-- Item 3 -->
                            <div class="carousel-item duration-700 ease-in-out absolute inset-0  h-full">
                                <img src="https://picsum.photos/686/322"
                                    class="block absolute top-1/2 left-1/2 w-full h-full rounded-lg -translate-x-1/2 -translate-y-1/2"
                                    alt="...">
                            </div>
                        </div>
                        <!-- Slider controls -->
                        <button type="button"
                            class="flex absolute top-0 left-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none"
                            data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                            <span
                                class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7">
                                    </path>
                                </svg>
                                <span class="hidden">Previous</span>
                            </span>
                        </button>
                        <button type="button"
                            class="flex absolute top-0 right-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none"
                            data-bs-target="#carouselExampleFade" data-bs-slide="next">
                            <span
                                class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7">
                                    </path>
                                </svg>
                                <span class="hidden">Next</span>
                            </span>
                        </button>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
@section('content-right')
@endsection
@push('scripts')
    @include('ajax')
@endpush
