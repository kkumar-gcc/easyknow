@extends('layouts.user')
@push('styles')
    <x-head.tinymce-config />
@endpush
@section('content-left')
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
    @include('docs.side')
@endsection
@section('content')
    <div class="profile">
        <nav class="tabs mobile-nav-tab">
            <ul class="nav nav-tabs mb-3 -primary" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="/settings?tab=profile"
                        role="tab">Edit Profile</a>
                </li>
            </ul>
        </nav>
        <div>
            <div id="loading"></div>

           
        </div>

    </div>
@endsection
@push('scripts')
    @include('ajax')
  
@endpush
