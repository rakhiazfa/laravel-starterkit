<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => ['required'],
            'new_password' => ['required', 'min:8', 'confirmed'],
        ]);

        $user = $request->user();

        $oldPassword = $request->input('old_password');
        $newPassword = $request->input('new_password');

        if (Hash::check($oldPassword, $user->password)) {

            $user->update([
                'password' => Hash::make($newPassword),
            ]);

            return back()->with('success', 'Successfully updated password.');
        }

        return back()->withErrors([
            'old_password' => 'Old password is wrong.',
        ]);
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
