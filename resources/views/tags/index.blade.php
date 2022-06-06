@extends('layouts.user')
@push('styles')
    <x-head.tinymce-config />
@endpush
@section('content-left')
    <div class="">
        <article>
            <div id="toast-tag"></div>
            @auth
                <div class="e-card">
                    <div class="e-card-body">
                        <form method="POST" id="tag_create" class="needs-validation" novalidate>
                            @csrf
                            @method('put')
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            <div class="">
                                <div class="form-outline">
                                    <input type="text" name="title" class="form-control rounded " id="tag_title"
                                        placeholder="tag title" required />
                                    <div class="invalid-tooltip" id="invalid_tag"></div>
                                </div>
                            </div>
                            {{-- <div class="invalid-tooltip">Please choose a unique and valid username.</div> --}}
                            <button type="submit" class="e-btn e-btn-primary">create tag</button>
                        </form>
                    </div>
                </div>
            @endauth

        </article>
    </div>
@endsection
@section('content')
    <?php
    function nice_number($n)
    {
        $n = 0 + str_replace(',', '', $n);
        if (!is_numeric($n)) {
            return false;
        }
        if ($n > 1000000000000) {
            return round($n / 1000000000000, 1) . 't ';
        } elseif ($n > 1000000000) {
            return round($n / 1000000000, 1) . 'b ';
        } elseif ($n > 1000000) {
            return round($n / 1000000, 1) . 'm ';
        } elseif ($n > 1000) {
            return round($n / 1000, 1) . 'k ';
        }
        return number_format($n);
    }
    ?>

    <div class="container-fluid tags">
        <h3>Tags</h3>
        <div class=" mt-4 row flex-row justify-content-between align-items-center">
            <div class="ml-2 col-lg-6 col-md-6 col-sm-12">
                <div class=" d-md-flex input-group w-auto my-auto">

                    <input id="search-input" autocomplete="off" type="search" class="form-control rounded "
                        placeholder="Search by tag name" name="search">
                    {{-- <span class="input-group-text border-0"><i class="fas fa-search" id="mdb-5-search-icon"></i></span> --}}
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 clearfix">
                <div class="dropdown float-end">
                    <button class="e-btn  dropdown-toggle" type="button" id="dropdownMenuButton" data-mdb-toggle="dropdown"
                        aria-expanded="false">
                        Sortby
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="/tags?tab=newest">Newest</a></li>
                        <li><a class="dropdown-item" href="/tags?tab=name">Name</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <hr>
        <div class="row " id="tag-show">
            @foreach ($tags as $tag)
                <div class='col-lg-3 col-md-4 col-sm-12 '>
                    <div class="e-card ">
                        <div class="e-card-body">
                            <a href="blogs/tagged/{{ $tag->title }}" class="tag-popover"
                                id="tag-{{ $tag->id }}"><span
                                    class="modern-badge  modern-badge-{{ $tag->color }}">#{{ $tag->title }}</span>
                            </a>
                            <p class="mt-3 mb-3">Some quick example text to build on the card title and make up the
                                bulk of
                                the card's content.</p>
                            <span class="text-muted">{{ $tag->blogs->count() }} blogs</span>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        <div class="row" id="new-tag-show"></div>
        <div id="tag-paginator">
            {!! $tags->withQueryString()->onEachSide(3)->links('pagination::bootstrap-5') !!}
        </div>
    </div>
@endsection
@push('scripts')
    @include('ajax')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).on('keyup', '#search-input', function() {
                var query = $(this).val();
                if (query != ' ') {
                    $.ajax({
                        url: "{{ Route('tags.search') }}",
                        method: "GET",
                        data: {
                            query: query
                        },
                        dataType: 'json',
                        success: function(data) {
                            $("#tag-show").hide();
                            if (data.searched) {
                                $("#new-tag-show").html('');
                                $("#tag-paginator").hide('slow');
                                $.each(data.tags, function(index, tag) {
                                    $("#new-tag-show").append(`
                                <div class='col-lg-3 col-md-4 col-sm-12 '>
                                    <div class="e-card  shadow-1  ">
                                        <div class="e-card-body">
                                            <a href="blogs/tagged/` + tag.title + `"  class="tag-popover"
                                                id="tagSuggest-` + tag.id + `">
                                            <span class="modern-badge  modern-badge-` + tag.color + `">#` + tag.title + `</span></a>

                                            <p class="mt-3 mb-3">Some quick example text to build on the card title and make up the bulk of
                                                the card's content.</p>
                                            <span class="text-muted">` + tag.blogs_count + ` blogs</span>
                                        </div>
                                    </div>
                               </div>
                                `);
                                });
                            }
                        }
                    })
                } else {
                    $("#new-tag-show").hide();
                    $("#tag-show").show('slow');
                    $("#tag-paginator").show('slow');
                }
            });
            $("input#tag_title").on({
                keydown: function(e) {
                    $("#tag_title").removeClass("is-invalid mb-5");
                    if (e.which === 32)
                        return false;
                },
                // change: function() {
                //     this.value = this.value.replace(/\s/g, "");
                // }
            });
            $(document).on('submit', '#tag_create', function(e) {
                $.ajaxSetup({
                    header: $('meta[name="_token"]').attr('content')
                })
                e.preventDefault(e);
                $.ajax({
                    type: "PUT",
                    url: '{{ Route('tag.create') }}',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(data) {
                        if (data.success) {
                            $("#toast-tag").html(`<div class="toast toast-fixed show fade  " id="placement-toast" role="alert" aria-live="assertive"
                            aria-atomic="true"  data-mdb-width="350px"
                            style="width: 350px; display: block; top: unset; left: 10px; bottom: 10px; right: unset; transform: unset;"
                            data-mdb-autohide="true" data-mdb-position="top-right" data-mdb-append-to-body="true">
                            <div class="toast-body ">` + data.success + `</div>
                            </div>`);
                            setInterval(() => {
                                $("#toast-tag").html('');
                            }, 5000);
                        }
                        if (data.error) {
                            $("#invalid_tag").text(data.error);
                            $("#tag_title").addClass("is-invalid mb-5");
                        }
                    }
                })
            });
        });
    </script>
@endpush
