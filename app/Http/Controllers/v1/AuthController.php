<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Utilities\ProxyRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(ProxyRequest $proxy, User $user)
    {
        $this->model = $user;
        $this->proxy = $proxy;
        $this->middleware('auth:api')->except('auth');
    }

    public function auth(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('username', request('username'))->first();

        abort_unless($user, 404, 'This username does not exists.');
        abort_unless(
            \Hash::check(request('password'), $user->password),
            403,
            'This password does not exists.'
        );

        $resp = $this->proxy
            ->grantPasswordToken(request('username'), request('password'));

        return response([
            'user' => $user,
            'token' => [
                'access_token' => $resp->access_token,
                'refresh_token' => $resp->refresh_token,
                'expiresIn' => $resp->expires_in,
                'token_type' => $resp->token_type,
            ],
            'message' => 'You have been logged in',
        ], 200);
    }

    public function logout_api()
    {
        $token = request()->user()->token();
        $token->delete();

        cookie()->queue(cookie()->forget('refresh_token'));

        return response([
            'message' => 'You have been successfully logged out',
        ], 200);

    }
}
