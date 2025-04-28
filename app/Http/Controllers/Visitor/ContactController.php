<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index() {
        return view('visitor.contact');
    }

    public function store(Request $request) {
        $request->validate([
            'message' => 'required',
            'name' => 'required',
            'email_address' => 'required',
            'subject' => 'required',
        ]);

        Contact::create([
            'message' => $request->message,
            'name' => $request->name,
            'email_address' => $request->email_address,
            'subject' => $request->subject,
            'status' => 0,
        ]);
        return redirect()->route('visitor.contact')->with('success', 'Contact added successfully!');
    }
}
