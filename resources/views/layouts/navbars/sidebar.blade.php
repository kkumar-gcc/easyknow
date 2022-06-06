<div class="offcanvas sidebar offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasSidebar"
    aria-labelledby="offcanvasSidebarLabel">

    <div class="offcanvas-body">

        <div class="sidebar-brand">
            <button class="sidebar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar"
                aria-controls="offcanvasSidebar" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <a class="navbar-brand link link-primary" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
        </div>


        <ul class="sidebar-nav">
            <li class="sidebar-item">
                <a href="#" class="sidebar-link link link-secondary">
                    {{-- <span class="icon-primary"><i class="tim-icons icon-align-left-2"></i></span> --}}
                    Home </a>
            </li>
            <li class="sidebar-item">
                <a href="/blogs" class="sidebar-link link link-secondary">Blogs</a>
            </li>
            <li class="sidebar-item">
                <a href="/tags" class="sidebar-link link link-secondary">Tags</a>
            </li>
           
           
        </ul>
       
    </div>
</div>
