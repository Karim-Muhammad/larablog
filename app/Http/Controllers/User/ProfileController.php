<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Get the users who made the request
        $user = $request->user();
        // dd($user->image);

        // Fill the user with the validated data
        $request->user()->fill($request->validated());
        // $request->validated() -> will return only fields that we are validated by ProfileUpdateRequest rules
        // and `fill()` method will fill the user with the validated data, but won't take all of them, it will take only what we defined in the `fillable` property in `User` model
        // to avoid mass assignment vulnerability

        // 
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // If the request has an image file
        if ($request->hasFile('image')) {
            // dd($request->file('image'));
            Storage::delete("public/" . $user->image);
            $request->user()->image = $request->image->store("users_imgs", "public");
        }

        $request->user()->save();
        // dd([$request->user()->image, $user]);

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
