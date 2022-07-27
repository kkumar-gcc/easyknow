@extends('layouts.blog')
@push('styles')
    <x-head.tinymce-config />
@endpush
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
    <div class="container-fluid blog-section">
        <div class="e-card">
            <div class="card-body profile-body">
                <h1 class="title mb-4">Create Podcast</h1>
                <form method="POST" action="/podcast/create">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-6">
                        <label class="form-label" for="podcast_image">Add a cover image</label>
                        <div class="drop-zone  @error('image') drop-zone-danger is-invalid @enderror mb-3" id="podcast_image">
                            <p class="drop-zone__prompt">Drop file here or click to upload</p>
                            <input type="file" name="image" id="podcast_image" class="form-control drop-zone__input">
                        </div>
                        @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-6">
                        <label class="form-label " for="podcast_title">Title</label>
                        <input type="text" id="podcast_title" class="form-control @error('title') is-invalid @enderror"
                            name="title" value="{{ old('title') }}" />
                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group  mb-4">
                        <label class="form-label" for="editor2">Description</label>

                        <textarea id="editor2" name="description"> {{ old('description') }} </textarea>
                    </div>
                    <button type="submit" class="mt-2 e-btn e-btn-success"> create
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    @include('ajax')
@endpush
