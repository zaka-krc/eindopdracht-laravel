<?php

namespace App\Http\Controllers;

use App\Models\NewsItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsItemController extends Controller
{
    public function index(Request $request)
    {
        $newsItems = NewsItem::with('user')
            ->withCount('comments')
            ->orderBy('publication_date', 'desc')
            ->get();
        
        return view('news.index', compact('newsItems'));
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
        ]);

        $imagePath = $request->file('image')->store('news', 'public');

        NewsItem::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'publication_date' => $validated['publication_date'],
            'image' => $imagePath,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('news.index')
            ->with('success', 'Nieuwsitem succesvol aangemaakt.');
    }

    public function show(NewsItem $newsItem)
    {
        // Eager load user and top-level comments with their nested replies
        $newsItem->load([
            'user',
            'topLevelComments.user',
            'topLevelComments.allReplies.user'
        ]);
        
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($newsItem->image) {
                Storage::disk('public')->delete($newsItem->image);
            }
            
            $imagePath = $request->file('image')->store('news', 'public');
            $validated['image'] = $imagePath;
        }

        $newsItem->update($validated);

        return redirect()->route('news.show', $newsItem)
            ->with('success', 'Nieuwsitem succesvol bijgewerkt.');
    }

    public function destroy(NewsItem $newsItem)
    {
        // Delete image
        if ($newsItem->image) {
            Storage::disk('public')->delete($newsItem->image);
        }

        $newsItem->delete(); // Comments worden automatisch verwijderd door cascade

        return redirect()->route('news.index')
            ->with('success', 'Nieuwsitem succesvol verwijderd.');
    }
}