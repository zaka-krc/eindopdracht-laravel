<?php

namespace App\Http\Controllers;

use App\Models\NewsItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsItemController extends Controller
{

    public function index(Request $request)
{
    $query = NewsItem::with('gameInterests')->orderBy('publication_date', 'desc');
    
    // Filter op game interest
    if ($request->has('category') && $request->category) {
        $query->whereHas('gameInterests', function($q) use ($request) {
            $q->where('slug', $request->category);
        });
    }
    
    $newsItems = $query->get();
    $gameInterests = \App\Models\GameInterest::all();
    
    return view('news.index', compact('newsItems', 'gameInterests'));
}



    public function create()
    {
        return view('news.create');
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|max:255',
        'content' => 'required',
        'publication_date' => 'required|date',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'game_interests' => 'array',
        'game_interests.*' => 'exists:game_interests,id',
    ]);

    $imagePath = $request->file('image')->store('news', 'public');

    $newsItem = NewsItem::create([
        'title' => $validated['title'],
        'content' => $validated['content'],
        'publication_date' => $validated['publication_date'],
        'image' => $imagePath,
        'user_id' => auth()->id(),
    ]);

    // Sync game interests
    if (!empty($validated['game_interests'])) {
        $newsItem->gameInterests()->sync($validated['game_interests']);
    }

    return redirect()->route('news.show', $newsItem)
        ->with('success', 'Nieuwsitem succesvol aangemaakt.');
}



    public function show(NewsItem $newsItem)
    {
        return view('news.show', compact('newsItem'));
    }


    public function edit(NewsItem $newsItem)
    {
        return view('news.edit', compact('newsItem'));
    }


    public function update(Request $request, NewsItem $newsItem)
{
    $validated = $request->validate([
        'title' => 'required|max:255',
        'content' => 'required',
        'publication_date' => 'required|date',
        'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        'game_interests' => 'array',
        'game_interests.*' => 'exists:game_interests,id',
    ]);

    if ($request->hasFile('image')) {
        if ($newsItem->image) {
            Storage::disk('public')->delete($newsItem->image);
        }
        
        $imagePath = $request->file('image')->store('news', 'public');
        $newsItem->image = $imagePath;
    }

    $newsItem->title = $validated['title'];
    $newsItem->content = $validated['content'];
    $newsItem->publication_date = $validated['publication_date'];
    $newsItem->save();

    // Sync game interests
    $newsItem->gameInterests()->sync($validated['game_interests'] ?? []);

    return redirect()->route('news.show', $newsItem)
        ->with('success', 'Nieuwsitem succesvol bijgewerkt.');
}



    public function destroy(NewsItem $newsItem)
    {
        // Verwijder de afbeelding
        if ($newsItem->image) {
            Storage::disk('public')->delete($newsItem->image);
        }

        $newsItem->delete();

        return redirect()->route('news.index')
            ->with('success', 'Nieuwsitem succesvol verwijderd.');
    }
}