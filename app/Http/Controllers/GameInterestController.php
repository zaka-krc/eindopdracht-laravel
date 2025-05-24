<?php

namespace App\Http\Controllers;

use App\Models\GameInterest;
use Illuminate\Http\Request;

class GameInterestController extends Controller
{
    /**
     * Admin: Toon alle game interests
     */
    public function index()
    {
        $interests = GameInterest::withCount('users', 'newsItems')->get();
        return view('admin.game-interests.index', compact('interests'));
    }

    /**
     * Admin: Toon create form
     */
    public function create()
    {
        return view('admin.game-interests.create');
    }

    /**
     * Admin: Sla nieuwe game interest op
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:game_interests',
            'description' => 'nullable|string|max:500',
            'color' => 'required|string|regex:/^#[a-fA-F0-9]{6}$/',
        ]);

        $validated['slug'] = \Str::slug($validated['name']);
        GameInterest::create($validated);

        return redirect()->route('admin.game-interests.index')
            ->with('success', 'Game categorie succesvol aangemaakt.');
    }

    /**
     * Admin: Toon edit form
     */
    public function edit(GameInterest $gameInterest)
    {
        return view('admin.game-interests.edit', compact('gameInterest'));
    }

    /**
     * Admin: Update game interest
     */
    public function update(Request $request, GameInterest $gameInterest)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:game_interests,name,' . $gameInterest->id,
            'description' => 'nullable|string|max:500',
            'color' => 'required|string|regex:/^#[a-fA-F0-9]{6}$/',
        ]);

        $validated['slug'] = \Str::slug($validated['name']);
        $gameInterest->update($validated);

        return redirect()->route('admin.game-interests.index')
            ->with('success', 'Game categorie succesvol bijgewerkt.');
    }

    /**
     * Admin: Verwijder game interest
     */
    public function destroy(GameInterest $gameInterest)
    {
        $gameInterest->delete();

        return redirect()->route('admin.game-interests.index')
            ->with('success', 'Game categorie succesvol verwijderd.');
    }
}