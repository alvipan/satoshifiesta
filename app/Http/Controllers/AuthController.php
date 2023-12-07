<?php

namespace App\Http\Controllers;

use App\Models\Config;
use App\Models\User;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(Request $request) {

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return [
                'success' => true,
                'message' => 'Login success.'
            ];
        }

        return [
            'success' => false,
            'message' => User::firstWhere('email', $request->email)
                ? 'Incorrect email or password'
                : 'Email not registered'
        ];
    }

    public function register(Request $request) {

        $credentials = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!User::firstWhere('email', $request->email)) {
            $wallets = explode(',', Config::firstWhere('name', 'currency_list')->content ?? '');
            $user = User::create([
                'name'      => $request->name,
                'email'     => $request->email,
                'password'  => $request->password,
                'wallets'   => $this->create_wallet()
            ]);

            Auth::attempt($credentials);
            $request->session()->regenerate();
            event(new Registered($user));

            return [
                'success' => true,
                'message' => 'Registration successful.'
            ];
        }

        return [
            'success' => false,
            'message' => 'Email has been registered.'
        ];
    }

    public function email_verify() {
        $user = Auth::user();
	    if (!$user->verified()) {
		    $data = [
			    'user' => Auth::user(),
			    'page' => 'auth.verify-email'
		    ];
		    return view('wrapper', $data);
	    }
	    return redirect('/faucet');
    }

    public function email_verify_notify(Request $request) {
        $request->user()->sendEmailVerificationNotification();
	    return $this->json_response([
		    'success' => true,
		    'message' => 'Sent successfully.'
	    ]);
    }

    public function email_verify_handler(EmailVerificationRequest $request) {
        $request->fulfill();
	    $data = [
		    'user' => Auth::user(),
		    'page' => 'auth.verify-email-success'
	    ];
	    return view('wrapper', $data);
    }

    public function forgot_password(Request $request) {
        $request->validate(['email' => 'required|email']);
 
        $status = Password::sendResetLink(
            $request->only('email')
        );

		if ($status === Password::RESET_LINK_SENT) {
			return $this->json_response([
				'success' => true,
				'message' => 'Reset link sent'
			]);
		}
        return [
            'success' => false,
            'message' => 'Error: '.$status
        ];
    }

    public function reset_password(string $token) {

        if (in_array($token, ['sent','success'])) {
            return view('wrapper', ['page' => 'auth.reset-password-'.$token]);
        }

        $data = [
            'token' => $token,
            'page' => 'auth.reset-password'
        ];
        return view('wrapper', $data);
    }

    public function reset_password_handler(Request $request) {
        $request->validate([
			'token' => 'required',
			'email' => 'required|email',
			'password' => 'required|min:8|confirmed',
	    ]);

	    $status = Password::reset(
			$request->only('email', 'password', 'password_confirmation', 'token'),
			function (User $user, string $password) {
				$user->forceFill([
					'password' => Hash::make($password)
				])->setRememberToken(Str::random(60));

				$user->save();
				event(new PasswordReset($user));
			}
	    );

	    if ($status === Password::PASSWORD_RESET) {
		    return [
			    'success' => true,
			    'message' => 'Password has been reset'
		    ];
	    }
        return [
            'success' => false,
            'message' => 'Error: '.$status
        ];
    }

    public function logout(Request $request): RedirectResponse {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    private function create_wallet() {
        $currency = explode(',', Config::firstWhere('name', 'currency_list')->content ?? '');
	    $wallets = [];
	    for ($i = 0; $i < count($currency); $i++) {
            $wallets[$currency[$i]] = [
			    'amount'	=> 0,
			    'adrress'	=> ''
		    ];
	    }
	    return json_encode($wallets);
    }
}

