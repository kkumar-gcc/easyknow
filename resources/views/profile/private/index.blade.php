@extends('layouts.user')

@section('content')
    <div class="profile">
        <h2>Settings</h2>
        <ul class="nav nav-tabs mb-3" id="ex-with-icons" role="tablist">
            <li class="nav-item" role="presentation">
              <a class="nav-link active detail" id="ex-with-icons-tab-1"  data-mdb-toggle="tab" href="#ex-with-icons-tabs-1" role="tab"
                aria-controls="ex-with-icons-tabs-1" aria-selected="true">My Details</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="ex-with-icons-tab-2" data-mdb-toggle="tab" href="#ex-with-icons-tabs-2" role="tab"
                aria-controls="ex-with-icons-tabs-2" aria-selected="false">Profile</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="ex-with-icons-tab-3" data-mdb-toggle="tab" href="#ex-with-icons-tabs-3" role="tab"
                aria-controls="ex-with-icons-tabs-3" aria-selected="false">Password</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="ex-with-icons-tab-3" data-mdb-toggle="tab" href="#ex-with-icons-tabs-3" role="tab"
                  aria-controls="ex-with-icons-tabs-3" aria-selected="false">Blogs ({{ auth()->user()->blogs->count() }})</a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link" id="ex-with-icons-tab-3" data-mdb-toggle="tab" href="#ex-with-icons-tabs-3" role="tab"
                  aria-controls="ex-with-icons-tabs-3" aria-selected="false">Drafts</a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link" id="ex-with-icons-tab-3" data-mdb-toggle="tab" href="#ex-with-icons-tabs-3" role="tab"
                  aria-controls="ex-with-icons-tabs-3" aria-selected="false">Bookmarks</a>
              </li>
        </ul>

    </div>
@endsection
