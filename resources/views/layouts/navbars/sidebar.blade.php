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
                <a href="#" class="sidebar-link link link-secondary">Home 1</a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link dropdown-toggle sidebar-link link link-secondary" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Dropdown
                  </a>
                  <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                  </ul>
            </li>
           
        </ul>
        <div class="btn-group">
            <a href="#" class="btn btn-primary" aria-current="page">Active link</a>
            <a href="#" class="btn btn-primary">Link</a>
            <a href="#" class="btn btn-primary">Link</a>
          </div>
    </div>
</div>
