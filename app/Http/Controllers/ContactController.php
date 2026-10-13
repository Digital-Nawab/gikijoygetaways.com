<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    /**
     * Store Contact Form Data
     */
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'first_name'   => 'required|string|max:255',
            'last_name'    => 'required|string|max:255',
            'email'        => 'required|email|max:255',
            'phone'        => 'nullable|string|max:20',
            'adult'        => 'required|integer|min:1',
            'child'        => 'nullable|integer|min:0',
            'total_people' => 'required|integer|min:1',
            'message'      => 'nullable|string',
        ]);

        // Save Data
        Contact::create([
            'first_name'   => $request->first_name,
            'last_name'    => $request->last_name,
            'email'        => $request->email,
            'phone'        => $request->phone,
            'adult'        => $request->adult,
            'child'        => $request->child,
            'total_people' => $request->total_people,
            'message'      => $request->message,
        ]);

        // Redirect to Thank You Page
        return redirect()->route('thankyou2')
            ->with('success', 'Contact form submitted successfully!');
    }

    public function thankyou2()
    {
        return view('frontend.pages.thankyou2');
    }

    public function index()
    {
        $contacts = Contact::latest()->get();

        return view('admin.pages.Contact.index', compact('contacts'));
    }
}