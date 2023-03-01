<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    /**
     * Log the user out of the application.
     * 
     * @param Request $request
     * 
     * @return Response
     */
    public function __invoke(Request $request)
    {
        Auth::logout();

        return response()->json([
            'success' => true,
            'message' => 'Successfully logged out.',
        ], 200);
    }
}
