<?php

namespace App\Http\Controllers;

use App\Models\FaqCategory;
use App\Models\FaqQuestion;
use Illuminate\Http\Request;

class FaqQuestionController extends Controller
{
    public function index()
    {
        $questions = FaqQuestion::with('category')->orderBy('created_at', 'desc')->get();
        return view('faq.questions.index', compact('questions'));
    }

    public function create()
    {
        $categories = FaqCategory::orderBy('name')->get();
        
        return view('faq.questions.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'faq_category_id' => 'required|exists:faq_categories,id',
            'question' => 'required|max:500',
            'answer' => 'required|min:10',
        ], [
            'faq_category_id.required' => 'Selecteer een categorie.',
            'faq_category_id.exists' => 'De geselecteerde categorie bestaat niet.',
            'question.required' => 'Vul een vraag in.',
            'question.max' => 'De vraag mag maximaal 500 karakters bevatten.',
            'answer.required' => 'Vul een antwoord in.',
            'answer.min' => 'Het antwoord moet minimaal 10 karakters bevatten.',
        ]);

        FaqQuestion::create($validated);

        return redirect()->route('admin.faq.questions.index')
            ->with('success', 'Vraag succesvol aangemaakt.');
    }

    public function edit(FaqQuestion $question)
    {
        $categories = FaqCategory::orderBy('name')->get();
        $question->load('category');
        
        return view('faq.questions.edit', compact('question', 'categories'));
    }

    public function update(Request $request, FaqQuestion $question)
    {
        $validated = $request->validate([
            'faq_category_id' => 'required|exists:faq_categories,id',
            'question' => 'required|max:500',
            'answer' => 'required|min:10',
        ], [
            'faq_category_id.required' => 'Selecteer een categorie.',
            'faq_category_id.exists' => 'De geselecteerde categorie bestaat niet.',
            'question.required' => 'Vul een vraag in.',
            'question.max' => 'De vraag mag maximaal 500 karakters bevatten.',
            'answer.required' => 'Vul een antwoord in.',
            'answer.min' => 'Het antwoord moet minimaal 10 karakters bevatten.',
        ]);

        $question->update($validated);

        return redirect()->route('admin.faq.questions.index')
            ->with('success', 'Vraag succesvol bijgewerkt.');
    }

    public function destroy(FaqQuestion $question)
    {
        $question->delete();

        return redirect()->route('admin.faq.questions.index')
            ->with('success', 'Vraag succesvol verwijderd.');
    }
}