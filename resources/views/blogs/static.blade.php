@extends('layouts.blog')
@push('styles')
    <x-head.tinymce-config />
@endpush
@section('content')
    <?php
    function nice_number($n)
    {
        // $n = 0 + int(str_replace(',', '', $n));
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
    Str::macro('readDuration', function (...$text) {
        $totalWords = str_word_count(implode(' ', $text));
        $minutesToRead = round($totalWords / 200);
    
        return (int) max(1, $minutesToRead);
    });
    
    ?>
    @if (session()->has('success'))
        <section class=" d-flex justify-content-center my-4 w-100">
            <div class="container">
                <div class="alert alert-dismissible fade show alert-success" role="alert" data-mdb-color="warning"
                    id="customxD">
                    <strong>Success!</strong> {{ session()->get('success') }}
                    <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </section>
    @endif
    <main class="global-main">
        <article class="blog-section">

        </article>
    </main>
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

        });
    </script>
@endpush
