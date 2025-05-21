<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Toon het contactformulier
     */
    public function show()
    {
        return view('contact.form');
    }

    /**
     * Verwerk het contactformulier
     */
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Bericht opslaan in database
        $contactMessage = ContactMessage::create($validated);

        // E-mail verzenden naar admin zou hier komen
        // Voor nu simuleren we dit met een flash message
        
        return redirect()->route('contact.show')
            ->with('success', 'Je bericht is succesvol verzonden. We nemen zo snel mogelijk contact met je op.');
    }

    /**
     * Toon de lijst van contactberichten (alleen voor admins)
     */
    public function index()
    {
        $messages = ContactMessage::orderBy('created_at', 'desc')->get();
        return view('contact.index', compact('messages'));
    }

    /**
     * Toon een specifiek bericht (alleen voor admins)
     */
    public function view(ContactMessage $message)
    {
        // Markeer als gelezen
        if (!$message->is_read) {
            $message->is_read = true;
            $message->save();
        }
        
        return view('contact.view', compact('message'));
    }

    /**
     * Verwijder een bericht (alleen voor admins)
     */
    public function destroy(ContactMessage $message)
    {
        $message->delete();
        
        return redirect()->route('contact.index')
            ->with('success', 'Bericht succesvol verwijderd.');
    }
}