<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;

class AdminUserController extends Controller
{
    /**
     * Toon alle gebruikers (alleen voor admins)
     */
    public function index()
    {
        $users = User::with('gameInterests')
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('admin.users.index', compact('users'));
    }

    /**
     * Toon formulier om nieuwe gebruiker aan te maken
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Sla nieuwe gebruiker op
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'is_admin' => ['boolean'],
            'username' => ['nullable', 'string', 'max:255', 'unique:users,username'],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'is_admin' => $request->boolean('is_admin'),
            'username' => $validated['username'],
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'Gebruiker succesvol aangemaakt.');
    }

    /**
     * Toon details van een specifieke gebruiker
     */
    public function show(User $user)
    {
        $user->load('gameInterests');
        
        return view('admin.users.show', compact('user'));
    }

    /**
     * Toon formulier om gebruiker te bewerken
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update gebruiker - BEVEILIGD TEGEN EIGEN ADMIN VERLIES
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'username' => ['nullable', 'string', 'max:255', 'unique:users,username,' . $user->id],
            'is_admin' => ['sometimes', 'boolean'],
        ]);

        // VEILIGHEID: Voorkom dat je je eigen admin status verliest
        if ($user->id === auth()->id()) {
            // Voor eigen account: verwijder is_admin uit validated data
            unset($validated['is_admin']);
            
            // Waarschuwing tonen
            session()->flash('warning', 'Je eigen admin status kan niet worden gewijzigd voor veiligheid.');
        }

        $user->update($validated);

        return redirect()->route('admin.users.index')
            ->with('success', 'Gebruiker succesvol bijgewerkt.');
    }

    /**
     * Verwijder gebruiker
     */
    public function destroy(User $user)
    {
        // Voorkom dat een admin zichzelf verwijdert
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Je kunt jezelf niet verwijderen.');
        }

        // Verwijder profielfoto als die bestaat
        if ($user->profile_photo) {
            Storage::disk('public')->delete($user->profile_photo);
        }

        // Verwijder gebruiker (GameInterests worden automatisch ontkoppeld door cascade)
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', "Gebruiker {$user->display_name} succesvol verwijderd.");
    }

    /**
     * Schakel admin status van gebruiker om - BEVEILIGD
     */
    public function toggleAdmin(User $user)
    {
        // VEILIGHEID: Voorkom dat een admin zijn eigen admin status wegneemt
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Je kunt je eigen admin status niet wijzigen voor veiligheid.');
        }

        // Check of dit de laatste admin is
        if ($user->is_admin && User::where('is_admin', true)->count() <= 1) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Je kunt de laatste admin niet degraderen. Er moet altijd minstens één admin zijn.');
        }

        $user->is_admin = !$user->is_admin;
        $user->save();

        $status = $user->is_admin ? 'toegekend' : 'ingetrokken';
        
        return redirect()->route('admin.users.index')
            ->with('success', "Admin rechten {$status} voor {$user->display_name}.");
    }

    /**
     * Maak jezelf weer admin (noodknop via URL)
     * Alleen toegankelijk via directe URL voor herstel
     */
    public function emergencyAdminRestore()
    {
        $user = auth()->user();
        
        if (!$user) {
            return redirect()->route('login')
                ->with('error', 'Je moet ingelogd zijn.');
        }

        // Alleen toestaan als er geen admins zijn (noodsituatie)
        $adminCount = User::where('is_admin', true)->count();
        
        if ($adminCount === 0) {
            $user->is_admin = true;
            $user->save();
            
            return redirect()->route('admin.users.index')
                ->with('success', 'Admin rechten hersteld! Er waren geen admins meer.');
        }

        return redirect()->route('dashboard')
            ->with('error', 'Er zijn nog andere admins. Deze functie is alleen voor noodsituaties.');
    }
}