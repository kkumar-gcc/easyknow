@if (count($followers) > 0)
    @foreach ($followers as $follower)
        <div
            class="mt-3 max-w-full text-base w-full border  border-gray-200 rounded-xl font-normal  dark:border-gray-700 dark:bg-gray-800 ">
            <div class="py-3 px-4 rounded-xl not-prose dark:bg-gray-800 ">
                <header class="flex flex-col md:flex-row">
                    <div class="flex-1 flex items-center ">
                        <img class="w-10 h-10 rounded-full"
                            src="{{ asset($follower->profile_image)}}" onerror="this.onerror=null;this.src=`https://avatars.dicebear.com/api/bottts/:{{ $follower->username }}.svg`"
                            alt="">
                        <div class="ml-2 font-medium ">
                            <div class="dark:text-white">
                                <a href="/users/{{ $follower->username }}">{{ $follower->username }} </a>
                            </div>
                            <div class="text-sm ">Joined in
                                {{ \Carbon\Carbon::parse($follower->created_at)->format('F Y') }}
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="mb-3 md:hidden">
                            {!! $follower->short_bio !!}
                        </div>
                        @guest
                            <button type="button"
                                class="w-full inline-flex justify-center items-center font-medium rounded-lg text-sm px-5 py-2.5 text-center no-underline  cursor-pointer whitespace-nowrap text-white bg-gradient-to-br from-rose-600 to-pink-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-rose-300 dark:focus:ring-rose-800"
                                data-modal-toggle="loginMessageModal">
                                {{ svg('bi-person-plus-fill', 'mr-2 -ml-1 w-5 h-5') }}
                                {{ __('Follow') }}
                            </button>
                        @else
                            @if (auth()->user()->id == $follower->id)
                                <a class="w-full inline-flex justify-center items-center font-medium rounded-lg text-sm px-5 py-2.5 text-center no-underline cursor-pointer whitespace-nowrap text-white bg-gradient-to-br from-rose-600 to-pink-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-rose-300 dark:focus:ring-rose-800"
                                    href="/users/{{ $follower->username }}">
                                    {{ svg('coolicon-edit', 'mr-2 -ml-1 w-5 h-5') }}
                                    {{ __('View Profile') }}
                                </a>
                            @else
                                {{-- @if ($blog->isFollower()) --}}
                                <form method="post" id="follow-{{ $follower->id }}" class="follow">
                                    @csrf
                                    @method('put')
                                    <input type="hidden" name="follower_id" id="follower_id"
                                        value="{{ auth()->user()->id }}">
                                    <input type="hidden" name="user_id" id="user_id" value="{{ $follower->id }}">
                                    @if ($follower->isFollowing())
                                        <button type="submit"
                                            class="follow_button_{{ $follower->id }} w-full inline-flex justify-center items-center font-medium rounded-lg text-sm px-5 py-2.5 text-center no-underline cursor-pointer whitespace-nowrap text-white bg-gradient-to-br from-rose-600 to-pink-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-rose-300 dark:focus:ring-rose-800">
                                            {{ svg('bi-person-check-fill', 'mr-2 -ml-1 w-5 h-5') }}
                                            {{ __('Following') }}
                                        </button>
                                    @else
                                        <button type="submit"
                                            class="follow_button_{{ $follower->id }} w-full inline-flex justify-center items-center font-medium rounded-lg text-sm px-5 py-2.5 text-center no-underline  cursor-pointer whitespace-nowrap text-white bg-gradient-to-br from-rose-600 to-pink-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-rose-300 dark:focus:ring-rose-800">

                                            {{ svg('bi-person-plus-fill', 'mr-2 -ml-1 w-5 h-5') }}
                                            {{ __('Follow') }}
                                        </button>
                                    @endif
                                </form>
                            @endif
                        @endguest
                    </div>

                </header>
                <div class="mt-3 hidden md:block">
                    {!! $follower->short_bio !!}
                </div>

            </div>
        </div>
    @endforeach

    {!! $followers->withQueryString()->onEachSide(3)->links('pagination::tailwind') !!}
@else
    <div
        class="py-4 px-5 rounded-xl text-base border   text-gray-700 dark:text-gray-300  dark:border-gray-700 dark:bg-gray-800 ">
        You don't have any follower.
    </div>
@endif
