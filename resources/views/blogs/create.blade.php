@extends('layouts.user')
@section('style')
    <x-head.tinymce-config />
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

    <div class="container-fluid blog-create">
        <div class="card" style="border-radius:0px 0px 0.5rem 0.5rem">
            <div class="card-body profile-body">
                <h1 class="title">Create Post</h1>
                <form method="POST" action="{{ route('blog.create') }}">
                    @method('PUT')
                    @csrf
                    <input type="hidden" id="blog_id" name="blog_id" />
                    <div class="form-group mb-4 ">
                        <label class="form-label" for="blog_image">Add a cover image</label>
                        <input type="file" class="form-control  form-control-lg" id="blog_image" name="image" />
                    </div>
                    <div class="form-outline mb-4">
                        <input type="text" id="blog_title" class="form-control form-control-lg" name="title" />
                        <label class="form-label " for="blog_title">Post Title</label>
                    </div>
                    <textarea  id="myeditorinstance" name="description"></textarea>
                    <div class="form-group">
                     

                    </div>
                    <div class="clearfix">
                        <div class=" float-end" id="autoSave"> 
                            
                        </div>
                    </div>

                    <button type="submit" class="mt-2 btn btn-primary border-primary"> Post
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            function autoSave() {
                var blog_title = $("#blog_title").val();
                var blog_description = $("#myeditorinstance").val();
                var blog_id = $("#blog_id").val();
                if (blog_title != '' && blog_description != '') {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('blog.draft') }}",
                        data: {
                            blogTitle: blog_title,
                            blogDescription: blog_description,
                            blogId: blog_id
                        },
                        beforeSend: function() {
                            $("#autoSave").html(
                                " <span class='text-center modern-badge  modern-badge-danger' > <div class='spinner-border spinner-border-sm' role='status' > <span class='visually-hidden'>Loading...</span> </div> Saving...</span>"
                            );
                        },
                        complete: function() {
                            $("#autoSave").html(
                                "<span class='text-right modern-badge  modern-badge-success'>Saved</span>"
                            );
                        },
                        success: function(data) {

                            if (data.blogId != '') {
                                $("#blog_id").val(data.blogId);
                            }
                        }

                    });
                }
            }
            setInterval(function() {
                autoSave();
            }, 10000);
            // $("#blog_create_id").submit(function(event) {
            //     var blog_title = $("#blog_title").val();
            //     var blog_description = $("#myeditorinstance").val();
            //     var blog_id = $("#blog_id").val();
            //     if (blog_title != '' && blog_description != '') {
            //         $.ajax({
            //             type: "POST",
            //             url: "{{ route('blog.create') }}",
            //             data: {
            //                 blogTitle: blog_title,
            //                 blogDescription: blog_description,
            //                 blogId: blog_id
            //             },
            //             encode: true,
            //             success: function(data) {

            //                 if (data.blogId != '') {
            //                     $("#blog_id").val('');
            //                     $("#blog_title").val('');
            //                     tinyMCE.activeEditor.setContent('');
            //                     window.location = "/blogs/" + data.blogId;
            //                 }
            //             }

            //         });
            //     }
            //     event.preventDefault();

            // });
        });
    </script>
@endsection
