<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function reloadCaptcha()
    {
        return response()->json(['captcha' => captcha_img()]);
    }

    public function loginPage()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $this->checkTooManyFailedAttempts();

        $user = User::where('email', $request->email)->first();

        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|email',
                'password' => 'required',
                'captcha' => 'required|captcha',
            ],
            [
                'captcha.captcha' => 'Invalid captcha code.',
            ]
        );

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        try {
            $credentials = request(['email', 'password']);

            if (!Auth::attempt($credentials)) {
                RateLimiter::hit($this->throttleKey(), $seconds = 30);

                echo ('Unauthorized');
            }

            if (!Hash::check($request->password, $user->password, [])) {
                throw new Exception('Error while Loging in');
            }

            $token = $user->createToken('authToken')->plainTextToken;

            RateLimiter::clear($this->throttleKey());

            return view('welcome');
        } catch (Exception $error) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Error while Logging in',
            ]);
        }
    }

    public function throttleKey()
    {
        return strtolower(request('email')) . '|' . request()->ip();
    }

    public function checkTooManyFailedAttempts()
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 3)) {
            return;
        }

        throw new Exception('Too many failed attemps, please try again in 30 seconds');
    }
}
