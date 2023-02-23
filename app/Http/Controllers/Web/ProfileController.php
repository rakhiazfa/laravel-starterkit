<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * @param Request $request
     * 
     * @return Response
     */
    public function __invoke(Request $request)
    {
        $profile = Auth::user();

        return view('profile')->with('profile', $profile);
    }

    /**
     * @param Request $request
     * 
     * @return Response
     */
    public function updateProfile(Request $request)
    {
    }

    /**
     * @param Request $request
     * 
     * @return Response
     */
    public function deleteAccount(Request $request)
    {
        $request->validate(['email_confirmation' => ['required', 'email']]);

        $user = $request->user();

        if ($user->email === $request->input('email_confirmation')) {

            $user->delete();

            return redirect()->route('logout');
        }

        return back()->withErrors([
            'email_confirmation' => 'Incorrect email confirmation.'
        ]);
    }
}
