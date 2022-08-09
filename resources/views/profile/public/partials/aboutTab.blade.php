<div
    class="mt-3 w-full text-base text-left  border  border-gray-200 rounded-xl font-normal  dark:border-gray-700 dark:bg-gray-800 ">
    <header class="py-3 px-4 flex flex-row text-2xl font-semibold text-gray-700 dark:text-white">
        <div class="flex-1">
            <h3> About Me </h3>
        </div>
        @auth
            <button type="button"
                class="text-gray-500 flex flex-row items-center mr-1  dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5"
                data-modal-toggle="loginMessageModal">
                {{ svg('coolicon-edit', 'w-5 h-5') }}
            </button>
        @endauth
    </header>
    <div
        class="py-3 px-4 rounded-xl text-base  text-gray-700 dark:text-gray-300   dark:bg-gray-800 ">
        @if ($user->about_me)
            {!! $user->about_me !!}
        @else
            {{ $user->username }} hasn't updated "about me".
        @endif
    </div>
</div>
{{-- <div class="col-md-5">
                    <div class="alert alert-info" role="alert" data-mdb-color="info">
                        <div class="sub-body">
                            <h5 class="sub-title ">Location</h5>
                            <hr>
                            <ul class="sidebar-nav" style="padding-left:10px;">
                                <li class="sidebar-item">
                                    <p class="sidebar-link sidebar-change alert-link">
                                        <span class="icon-primary">{{ svg('bi-facebook') }}
                                        </span>
                                        facebook  </p>
                                </li>
                                <li class="sidebar-item">
                                    <p class="sidebar-link sidebar-change alert-link">
                                        <span class="icon-primary">{{ svg('bi-facebook') }}
                                        </span>
                                        facebook  </p>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="alert alert-warning" role="alert" data-mdb-color="info">
                        <div class="sub-body">
                            <h5 class="sub-title ">Connect</h5>
                            <hr>
                            <ul class="sidebar-nav" style="padding-left:10px;">
                                <li class="sidebar-item">
                                    <a href="#" class="sidebar-link sidebar-change link alert-link">
                                        <span class="icon-primary">{{ svg('bi-facebook') }}
                                        </span>
                                        facebook  </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="/blogs" class="sidebar-link sidebar-change link alert-link">  <span class="icon-primary">{{ svg('entypo-github') }}
                                    </span> Github</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="#" class="sidebar-link sidebar-change link alert-link">
                                        <span class="icon-primary">{{ svg('feathericon-instagram') }}</span> Instagram
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div> </div> --}}
