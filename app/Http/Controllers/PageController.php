<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class PageController extends Controller
{
    
    public function show($page = 'welcome') {

        $data = [
            'user' => Auth::check() ? Auth::user() : null,
            'page' => $page
        ];
        return view('wrapper', $data);
    }

    public function content($page = 'welcome') {
        return View::exists('page.'.$page) ? view('page.'.$page) : view('page.404');
    }
}
