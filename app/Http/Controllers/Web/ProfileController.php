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
    public function update(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email,' . $user->id],
        ]);

        $user->update($request->all());

        return back()->with('success', 'Profile updated successfully.');
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
