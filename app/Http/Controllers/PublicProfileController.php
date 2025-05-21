<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PublicProfileController extends Controller
{
    /**
     * Toon het openbare profiel van een gebruiker.
     */
    public function show(User $user)
    {
        return view('profile.public.show', compact('user'));
    }

    /**
     * Toon het formulier om je publieke profielinformatie te bewerken.
     */
    public function edit()
    {
        return view('profile.public.edit', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Update het publieke profiel in de database.
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'birthday' => 'nullable|date',
            'about_me' => 'nullable|string|max:1000',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Verwerk de profielfoto upload
        if ($request->hasFile('profile_photo')) {
            // Verwijder oude profielfoto als die bestaat
            if ($user->profile_photo) {
                Storage::disk('public')->delete($user->profile_photo);
            }
            
            // Sla de nieuwe profielfoto op
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $validated['profile_photo'] = $path;
        }

        // Update gebruikersgegevens
        $user->update($validated);

        return redirect()->route('profile.public.edit')
            ->with('status', 'Publiek profiel succesvol bijgewerkt.');
    }
}