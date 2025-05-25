<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\Models\User;

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
        $user = $request->user();
        $validated = $request->validated();
        
        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            // Delete old photo
            if ($user->profile_photo) {
                Storage::disk('public')->delete($user->profile_photo);
            }
            
            // Store new photo
            $validated['profile_photo'] = $request->file('profile_photo')
                ->store('profile-photos', 'public');
        }

        // Update user with all validated data except game_interests
        $user->fill(collect($validated)->except('game_interests')->toArray());

        // Handle email verification reset
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        // Sync game interests
        if (isset($validated['game_interests'])) {
            $user->gameInterests()->sync($validated['game_interests']);
        } else {
            $user->gameInterests()->detach();
        }

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

        // Delete profile photo
        if ($user->profile_photo) {
            Storage::disk('public')->delete($user->profile_photo);
        }

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    
    /**
     * Display the specified user's profile.
     */
    public function show(User $user): View
    {
        $user->load('gameInterests'); // Eager load for efficiency
        
        return view('profile.show', compact('user'));
    }
}