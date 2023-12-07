<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DataController extends Controller
{
    public function get() {
        return [
            'config' => Config::whereNotIn('name',[
                'hcaptcha_key', 
                'hcaptcha_secret'
            ])->get(),
            'user' => Auth::check() ? Auth::user() : null
        ];
    }
}
