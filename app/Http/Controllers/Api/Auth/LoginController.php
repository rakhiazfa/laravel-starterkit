<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     * 
     * @param LoginRequest $request
     * 
     * @return Response
     */
    public function __invoke(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        $token = Auth::guard('api')->attempt($credentials);

        if (!$token) return response()->json([
            'success' => false,
            'message' => 'Unauthorized',
        ], 401);

        $user = Auth::guard('api')->user();
        $user->load('roles');

        return response()->json([
            'success' => true,
            'user' => $user,
            'token' => $token,
        ], 200);
    }
}
