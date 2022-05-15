<div class="modal fade" id="blogModal-{{ $blog->id }}" tabindex="-1" aria-labelledby="blogModal-{{ $blog->id }}-Label" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="blogModal-{{ $blog->id }}-Label">Update Blog</h5>
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid blog-create">
                    <div class="card" style="border-radius:0px 0px 0.5rem 0.5rem">
                        <div class="card-body profile-body">

                            <form method="post" action="{{ Route('blog.update') }}">
                                @csrf
                                @method('put')
                                <input type="hidden" id="blog_id" name="blog_id" value="{{ $blog->id }}"/>
                                <input type="hidden"  name="user_id" value="{{ $blog->user_id }}"/>
                               
                                <div class="form-group mb-4 ">
                                    <label class="form-label" for="blog_image">Add a cover image</label>
                                    <input type="file" class="form-control  form-control-lg" id="blog_image" name="image" />
                                </div>
                                <div class="form-outline mb-4">
                                    <input type="text" id="blog_title" class="form-control form-control-lg" name="title" value="{{ $blog->title }}"/>
                                    <label class="form-label " for="blog_title">Post Title</label>
                                </div>
                                <textarea  id="myeditorinstance" name="description" >{{ $blog->description }}</textarea>
                                <button type="submit" class="mt-2 btn btn-primary border-primary"> Update
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
