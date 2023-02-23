<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
