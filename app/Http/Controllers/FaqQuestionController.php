<?php

namespace App\Http\Controllers;

use App\Models\FaqCategory;
use App\Models\FaqQuestion;
use Illuminate\Http\Request;

class FaqQuestionController extends Controller
{
 
    public function index()
    {
        $questions = FaqQuestion::with('category')->get();
        return view('faq.questions.index', compact('questions'));
    }


    public function create()
    {
        $categories = FaqCategory::all();
        return view('faq.questions.create', compact('categories'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'faq_category_id' => 'required|exists:faq_categories,id',
            'question' => 'required|max:255',
            'answer' => 'required',
        ]);

        FaqQuestion::create($validated);

        return redirect()->route('faq.questions.index')
            ->with('success', 'Vraag succesvol aangemaakt.');
    }


    public function edit(FaqQuestion $question)
    {
        $categories = FaqCategory::all();
        return view('faq.questions.edit', compact('question', 'categories'));
    }


    public function update(Request $request, FaqQuestion $question)
    {
        $validated = $request->validate([
            'faq_category_id' => 'required|exists:faq_categories,id',
            'question' => 'required|max:255',
            'answer' => 'required',
        ]);

        $question->update($validated);

        return redirect()->route('faq.questions.index')
            ->with('success', 'Vraag succesvol bijgewerkt.');
    }


    public function destroy(FaqQuestion $question)
    {
        $question->delete();

        return redirect()->route('faq.questions.index')
            ->with('success', 'Vraag succesvol verwijderd.');
    }
}