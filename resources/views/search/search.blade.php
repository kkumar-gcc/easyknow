@extends('layouts.blog2')

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
    <div class="container-fluid blog">

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

        <div class="search-title">
            <h1> Search results for "{!! Str::words($query, 4) !!}"</h1>
        </div>
        <ul class="nav nav-tabs mb-3" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ $tab == 'blogs' ? 'active' : '' }}" href="/search/blogs?query={{ $query }}"
                    role="tab">Blogs</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ $tab == 'users' ? 'active' : '' }}" href="/search/users?query={{ $query }}"
                    role="tab">Users</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ $tab == 'tags' ? 'active' : '' }}" href="/search/tags?query={{ $query }}"
                    role="tab">Tags</a>
            </li>
        </ul>
        @if ($tab == 'blogs')
            @include('search.blogs', ['blogs' => $blogs])
        @elseif($tab == 'users')
            @include('search.users', ['users' => $users])
        @elseif($tab == 'tags')
            @include('search.tags', ['tags' => $tags])
        @endif
    </div>
@endsection
@section('content-right')
    <article>
        <div class="form-group mb-4 ">
            <div class="typeahead__container">
                <div class="typeahead__field">
                    <div class="typeahead__query">
                        <form method="GET" action="/search">
                            <input type="search" class="js-typeahead-search form-control " autocomplete="off"
                                placeholder="Search" name="query" id="js-typeahead-search" required
                                value="{{ old('query', $query) }}">
                            <input type="submit" hidden />
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="e-vcard">
            <div class="e-vcard-title">
                {{-- <span class="modern-badge modern-badge-info">Help</span> --}}
                <h3>#help</h3>
            </div>

            <ul class="e-vcard-list">
                <li>one</li>
                <li>two</li>
            </ul>
        </div>
        <div class="e-vcard">
            <div class="e-vcard-title">
                {{-- <span class="modern-badge modern-badge-success">Discuss</span> --}}
                <h3>#Discuss</h3>
            </div>
            <div class="e-vcard-image">
                <img src="https://picsum.photos/1200/1000" alt="">
            </div>
            <div class="e-vcard-body">
                <a href="#">hello</a>
            </div>
        </div>
        <div class="e-vcard">
            <div class="e-vcard-title">
                <h3>Top Tags</h3>
            </div>
            <div class="e-vcard-body">
                {{-- @foreach ($tags as $tag)
                    <a href="/blogs/tagged/{{ $tag->title }}" class="tag-popover" id="sidebarTag-{{ $tag->id }}">
                        <span class="modern-badge modern-badge-{{ $tag->color }}">
                            {{ $tag->title }}
                        </span>
                    </a>
                @endforeach --}}

            </div>
        </div>
    </article>
@endsection
@push('scripts')
    @include('ajax')
    <script>
        $(document).ready(function() {

        });
    </script>
@endpush
