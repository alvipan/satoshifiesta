<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request) {

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            echo json_encode([
                'success' => true,
                'message' => 'Login success.'
            ]);
        } else {
            echo json_encode([
                'success'   => false,
                'message'   => 'Invalid login.'
            ]);
        }
    }

    public function register(Request $request) {

        $credentials = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        
        $user = User::create(request(['name', 'email', 'password']));

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            event(new Registered($user));
            echo json_encode([
                'success' => true,
                'message' => 'Success.'
            ]);
        } else {
            echo json_encode([
                'success'   => false,
                'message'   => 'Invalid.'
            ]);
        }
    }

    public function logout(Request $request): RedirectResponse {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}

