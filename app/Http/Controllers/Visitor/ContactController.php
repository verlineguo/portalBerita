<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\User;
use App\Notifications\ContactFormNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

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

        $contact = Contact::create([
            'message' => $request->message,
            'name' => $request->name,
            'email_address' => $request->email_address,
            'subject' => $request->subject,
            'status' => 0,
        ]);

        $admins = User::where('role', 0)->get();
        Notification::send($admins, new ContactFormNotification($contact));

        return redirect()->route('visitor.contact')->with('success', 'Contact added successfully!');
    }
}
