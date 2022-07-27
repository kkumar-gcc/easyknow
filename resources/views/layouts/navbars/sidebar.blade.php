<div class="offcanvas sidebar offcanvas-start" data-mdb-scroll="true" data-mdb-backdrop="true" tabindex="-1"
    id="offcanvasSidebar" aria-labelledby="offcanvasSidebarLabel">
    <div class="sidebar-header">
        <div class="sidebar-button">
            <button class="sidebar-toggler" type="button" data-mdb-toggle="offcanvas" data-mdb-target="#offcanvasSidebar"
                aria-controls="offcanvasSidebar" aria-controls="offcanvasSidebar" aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="sidebar-logo"> <a class="navbar-brand link link-primary" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a></div>

    </div>
    <div class="sidebar-inner mt-3">
        {{-- <h3 class="sidebar-inner-title">Analtytics</h3> --}}
        <ul class="sidebar-inner-list">
            <li>
                <a href="/home">
                    <div class="list-inner"> <span class="sidebar-list-icon"><i
                                class="fa-solid fa-table-columns"></i></span> <span
                            class="sidebar-list-title">home</span></div>
                </a>
            </li>
            <li>
                <a href="/blogs">
                    <div class="list-inner"> <span class="sidebar-list-icon"><i
                                class="fa-solid fa-table-columns"></i></span> <span
                            class="sidebar-list-title">Blogs</span></div>
                </a>
            </li>
            <li>
                <a href="/tags">
                    <div class="list-inner "> <span class="sidebar-list-icon"><i
                                class="fa-solid fa-table-columns"></i></span> <span
                            class="sidebar-list-title">Tags</span></div>
                </a>
            </li>

        </ul>
       
    </div>
</div>
