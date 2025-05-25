<?php

namespace App\Http\Controllers;

use App\Models\FaqCategory;
use Illuminate\Http\Request;

class FaqCategoryController extends Controller
{
    public function index()
    {
        $categories = FaqCategory::withCount('questions')->get();
        return view('faq.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('faq.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255|unique:faq_categories,name',
        ]);

        FaqCategory::create($validated);

        return redirect()->route('admin.faq.categories.index')
            ->with('success', 'Categorie succesvol aangemaakt.');
    }

    public function edit(FaqCategory $category)
    {
        $category->load('questions'); // Eager load questions voor statistieken
        
        return view('faq.categories.edit', compact('category'));
    }

    public function update(Request $request, FaqCategory $category)
    {
        $validated = $request->validate([
            'name' => 'required|max:255|unique:faq_categories,name,' . $category->id,
        ]);

        $category->update($validated);

        return redirect()->route('admin.faq.categories.index')
            ->with('success', 'Categorie succesvol bijgewerkt.');
    }

    public function destroy(FaqCategory $category)
    {
        // Check of er vragen zijn gekoppeld
        if ($category->questions()->count() > 0) {
            return redirect()->route('admin.faq.categories.index')
                ->with('error', 'Kan categorie niet verwijderen: er zijn nog vragen gekoppeld.');
        }

        $category->delete();

        return redirect()->route('admin.faq.categories.index')
            ->with('success', 'Categorie succesvol verwijderd.');
    }
}