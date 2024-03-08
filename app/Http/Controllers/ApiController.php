<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class ApiController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('username', 'password');
        if ($auth = Auth::attempt($credentials)) {
            $user = collect(User::where('name', Auth::user()->username)->first());
            $roles = Auth::user()->roles;
            $user->put('roles', $roles);
            $user->put('has_roles', $roles->pluck('code'));
            $user->put('timestamp', Carbon::now()->toDateTimeString());
            $token = JWTAuth::fromUser(Auth::user());
            $user->put('token', $token);
            $response = responseSuccess(__('messages.login-success'), $user);
            return response()->json($response, 200, [], JSON_PRETTY_PRINT)->header('Authorization', $token);
        } 
        else {
            $response = responseFail(__('messages.login-fail'));
            return response()->json($response, 400, [], JSON_PRETTY_PRINT);
        }
    }

    public function logout()
    {
        // Invalidate the token
        try {
            JWTAuth::invalidate();
            $response = responseSuccess(__('messages.logout-success'));
            return response()->json($response, 200, [], JSON_PRETTY_PRINT);
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            $response = responseFail(__('messages.logout-fail'), $e->getMessage());
            return response()->json($response, 400, [], JSON_PRETTY_PRINT);
        }
    }
}
