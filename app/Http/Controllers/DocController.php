<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocController extends Controller
{
    public function index(){
        return view('docs.index');
    }
    public function accordion(){
        return view('docs.accordion');
    }
    public function alerts(){
        return view('docs.alerts');
    }
    public function badges(){
        return view('docs.badges');
    }
    public function breadcrumb(){
        return view('docs.breadcrumb');
    }
    public function buttons(){
        return view('docs.buttons');
    }
    public function cards(){
        return view('docs.cards');
    }
    public function carousel(){
        return view('docs.carousel');
    }
    public function chips(){
        return view('docs.chips');
    }
    public function collapse(){
        return view('docs.collapse');
    }
    public function colors(){
        return view('docs.colors');
    }
    public function dropdowns(){
        return view('docs.dropdowns');
    }
    public function lightbox(){
        return view('docs.lightbox');
    }
    public function modal(){
        return view('docs.modal');
    }
    public function pagination(){
        return view('docs.pagination');
    }
    public function popovers(){
        return view('docs.popovers');
    }
    public function spinners(){
        return view('docs.spinners');
    }
    public function toasts(){
        return view('docs.toasts');
    }
}
