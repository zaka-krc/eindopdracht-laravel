<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
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
        $request->user()->fill($request->validated());

        // Voeg de ontbrekende velden toe
        $validated = $request->validate([
            'username' => 'nullable|string|max:255',
            'birthday' => 'nullable|date',
            'about_me' => 'nullable|string|max:1000',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Verwerk de profielfoto upload
        if ($request->hasFile('profile_photo')) {
            // Verwijder oude profielfoto als die bestaat
            if ($request->user()->profile_photo) {
                Storage::disk('public')->delete($request->user()->profile_photo);
            }
            
            // Sla de nieuwe profielfoto op
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $request->user()->profile_photo = $path;
        }

        // Voeg de overige velden toe
        if (isset($validated['username'])) {
            $request->user()->username = $validated['username'];
        }
        if (isset($validated['birthday'])) {
            $request->user()->birthday = $validated['birthday'];
        }
        if (isset($validated['about_me'])) {
            $request->user()->about_me = $validated['about_me'];
        }

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

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
    /**
     * Display the specified user's profile.
     */
    public function show(User $user)
    {
        return view('profile.show', compact('user'));
    }
}
