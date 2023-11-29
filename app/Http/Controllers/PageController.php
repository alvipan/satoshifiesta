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
        if (Auth::check() && !Auth::user()->verified()) {
            return redirect('/email/verify');
        }
        return view('wrapper', $data);
    }

    public function content($page = 'welcome') {
        $data = [
            'user' => Auth::check() ? Auth::user() : null
        ];
        $view = View::exists('page.'.$page) ? 'page.'.$page : 'page.error.404';
        if (Auth::check() && !Auth::user()->verified()) {
            $view = 'page.verify-email';
        }
        return View($view, $data);
    }
}
