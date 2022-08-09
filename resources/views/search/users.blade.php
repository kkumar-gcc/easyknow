@if (count($users) > 0)
    @foreach ($users as $user)
        <div
            class="mt-3 max-w-full text-base w-full border  border-gray-200 rounded-xl font-normal  dark:border-gray-700 dark:bg-gray-800 ">
            <div
                class="py-3 px-4 rounded-xl not-prose dark:bg-gray-800 ">
                <header class="flex flex-col md:flex-row">
                    <div class="flex-1 flex items-center ">
                        <img class="w-10 h-10 rounded-full"
                            src="{{ asset($user->profile_image)}}" onerror="this.onerror=null;this.src=`https://avatars.dicebear.com/api/bottts/:{{ $user->username }}.svg`" alt="">
                        <div class="ml-2 font-medium ">
                            <div class="dark:text-white">
                                <a href="/users/{{ $user->username }}">{{ $user->username }} </a></div>
                            <div class="text-sm ">Joined in
                                {{ \Carbon\Carbon::parse($user->created_at)->format('F Y') }}
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="mb-3 md:hidden">
                            {!! $user->short_bio !!}
                        </div>
                        @guest
                            <button type="button"
                                class="w-full inline-flex justify-center items-center font-medium rounded-lg text-sm px-5 py-2.5 text-center no-underline  cursor-pointer whitespace-nowrap text-white bg-gradient-to-br from-rose-600 to-pink-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-rose-300 dark:focus:ring-rose-800"
                                data-modal-toggle="loginMessageModal">
                                {{ svg('bi-person-plus-fill', 'mr-2 -ml-1 w-5 h-5') }}
                                {{ __('Follow') }}
                            </button>
                        @else
                            @if (auth()->user()->id == $user->id)
                                <a class="w-full inline-flex justify-center items-center font-medium rounded-lg text-sm px-5 py-2.5 text-center no-underline cursor-pointer whitespace-nowrap text-white bg-gradient-to-br from-rose-600 to-pink-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-rose-300 dark:focus:ring-rose-800"
                                    href="/users/{{ $user->username }}">
                                    {{ svg('coolicon-edit', 'mr-2 -ml-1 w-5 h-5') }}
                                    {{ __('View Profile') }}
                                </a>
                            @else
                                {{-- @if ($blog->user->isFollower()) --}}
                                <form method="post" id="follow-{{ $user->id }}" class="follow">
                                    @csrf
                                    @method('put')
                                    <input type="hidden" name="follower_id" id="follower_id" value="{{ auth()->user()->id }}">
                                    <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">
                                    @if ($user->isFollowing())
                                        <button type="submit"
                                            class="follow_button_{{ $user->id }} w-full inline-flex justify-center items-center font-medium rounded-lg text-sm px-5 py-2.5 text-center no-underline cursor-pointer whitespace-nowrap text-white bg-gradient-to-br from-rose-600 to-pink-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-rose-300 dark:focus:ring-rose-800">
                                            {{ svg('bi-person-check-fill', 'mr-2 -ml-1 w-5 h-5') }}
                                            {{ __('Following') }}
                                        </button>
                                    @else
                                        <button type="submit"
                                            class="follow_button_{{ $user->id }} w-full inline-flex justify-center items-center font-medium rounded-lg text-sm px-5 py-2.5 text-center no-underline  cursor-pointer whitespace-nowrap text-white bg-gradient-to-br from-rose-600 to-pink-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-rose-300 dark:focus:ring-rose-800">
    
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
                    {!! $user->short_bio !!}
                </div>
                
            </div>
        </div>
    @endforeach

    {!! $users->withQueryString()->onEachSide(3)->links('pagination::tailwind') !!}
@else
    <div class="prose">
        <ul>
            <li>Make sure all words are spelled correctly.</li>
            <li>Try different keywords.</li>
            <li>Try more general keywords.</li>
        </ul>
    </div>
@endif
