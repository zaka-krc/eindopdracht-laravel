<?php

namespace App\Http\Controllers;

use App\Models\FaqCategory;
use Illuminate\Http\Request;

class FaqCategoryController extends Controller
{
   
    public function index()
    {
        $categories = FaqCategory::all();
        return view('faq.categories.index', compact('categories'));
    }

 
    public function create()
    {
        return view('faq.categories.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
        ]);

        FaqCategory::create($validated);

        return redirect()->route('faq.categories.index')
            ->with('success', 'Categorie succesvol aangemaakt.');
    }


    public function edit(FaqCategory $category)
    {
        return view('faq.categories.edit', compact('category'));
    }


    public function update(Request $request, FaqCategory $category)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
        ]);

        $category->update($validated);

        return redirect()->route('faq.categories.index')
            ->with('success', 'Categorie succesvol bijgewerkt.');
    }


    public function destroy(FaqCategory $category)
    {
        $category->delete();

        return redirect()->route('faq.categories.index')
            ->with('success', 'Categorie succesvol verwijderd.');
    }
}