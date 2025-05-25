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
        
        // Valideer eerst de basis velden via ProfileUpdateRequest
        $user->fill($request->validated());

        // Valideer en verwerk de extra velden
        $additionalValidated = $request->validate([
            'username' => 'nullable|string|max:255|unique:users,username,' . $user->id,
            'birthday' => 'nullable|date|before:today',
            'about_me' => 'nullable|string|max:1000',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'game_interests' => 'nullable|array',
            'game_interests.*' => 'exists:game_interests,id',
        ]);

        // Verwerk de profielfoto upload
        if ($request->hasFile('profile_photo')) {
            // Verwijder oude profielfoto als die bestaat
            if ($user->profile_photo) {
                Storage::disk('public')->delete($user->profile_photo);
            }
            
            // Sla de nieuwe profielfoto op
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $user->profile_photo = $path;
        }

        // Update de overige velden
        if (isset($additionalValidated['username'])) {
            $user->username = $additionalValidated['username'];
        }
        
        if (isset($additionalValidated['birthday'])) {
            $user->birthday = $additionalValidated['birthday'];
        }
        
        if (isset($additionalValidated['about_me'])) {
            $user->about_me = $additionalValidated['about_me'];
        }
        
        // Sync game interests
        if (isset($additionalValidated['game_interests'])) {
            $user->gameInterests()->sync($additionalValidated['game_interests']);
        } else {
            // Als geen game interests zijn geselecteerd, verwijder alle relaties
            $user->gameInterests()->detach();
        }

        // Check of email is veranderd
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

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