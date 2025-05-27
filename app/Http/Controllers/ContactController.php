<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Toon het publieke contactformulier
     */
    public function show()
    {
        return view('contact.form');
    }

    /**
     * Verwerk het contactformulier (publiek)
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
        ContactMessage::create($validated);

        return redirect()->route('contact.show')
            ->with('success', 'Je bericht is succesvol verzonden. We nemen zo snel mogelijk contact met je op.');
    }

    /**
     * ADMIN: Toon lijst van contactberichten
     */
    public function index()
    {
        $messages = ContactMessage::orderBy('created_at', 'desc')->get();
        return view('admin.contact.index', compact('messages'));
    }

    /**
     * ADMIN: Toon specifiek bericht - GEFIXT: nu met ID parameter
     */
    public function view($messageId)
    {
        $message = ContactMessage::findOrFail($messageId);
        
        // Markeer als gelezen
        if (!$message->is_read) {
            $message->is_read = true;
            $message->save();
        }
        
        return view('admin.contact.view', compact('message'));
    }

    /**
     * ADMIN: Verwijder bericht - GEFIXT: nu met ID parameter
     */
    public function destroy($messageId)
    {
        $message = ContactMessage::findOrFail($messageId);
        $message->delete();
        
        return redirect()->route('admin.contact.index')
            ->with('success', 'Bericht succesvol verwijderd.');
    }
}