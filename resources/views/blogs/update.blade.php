<div class="modal fade" id="blogEditModal-{{ $blog->id }}" tabindex="-1"
    aria-labelledby="blogEditModal-{{ $blog->id }}-Label" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="blogEditModal-{{ $blog->id }}-Label">Update Blog</h5>
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid blog-create">
                    <div class="e-card" style="border-radius:0px 0px 0.5rem 0.5rem">
                        <div class="e-card-body profile-body">

                            <form method="post" action="{{ Route('blog.update') }}">
                                @csrf
                                @method('put')
                                <input type="hidden" id="blog_id" name="blog_id" value="{{ $blog->id }}" />
                                <input type="hidden" name="user_id" value="{{ $blog->user_id }}" />

                                <div class="form-group mb-4 ">
                                    <label class="form-label" for="blog_image">Add a cover image</label>
                                    <input type="file" class="form-control  form-control-lg" id="blog_image"
                                        name="image" />
                                </div>
                                <div class="form-outline mb-4">
                                    <input type="text" id="blog_title" class="form-control form-control-lg" name="title"
                                        value="{{ $blog->title }}" />
                                    <label class="form-label " for="blog_title">Post Title</label>
                                </div>

                                <textarea id="myeditorinstance" name="description">{{ $blog->description }}</textarea>
                                <input type="hidden" name="tags" id="tag-input" value="{{ old('tags', $tagTitles) }}">
                                <div class="form-group mb-4 ">
                                    <label class="form-label" for="blog_image">Add Tags</label>
                                    <div class="typeahead__container">
                                        <div class="typeahead__field">
                                            <div class="typeahead__query">
                                                <input class="js-typeahead-tags form-control" name="tag[query]"
                                                    placeholder="Search" autocomplete="off" id="js-typeahead-tags">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="mt-2 e-btn e-btn-success"> Update
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
