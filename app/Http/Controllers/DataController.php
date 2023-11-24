<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DataController extends Controller
{
    public function get() {
        $data = [
            'user' => Auth::check() ? Auth::user() : null
        ];
        echo json_encode($data);
    }
}
