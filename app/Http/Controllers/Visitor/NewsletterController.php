<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Newsletter;
use App\Models\User;
use App\Notifications\NewsletterSubscriptionNotification;
use App\Notifications\NewsletterWelcomeNotification;
use Illuminate\Support\Facades\Notification;

class NewsletterController extends Controller
{
    public function store(Request $request) {
        
        $request->validate([
            'email' => 'required|email',
        ]);

        $newsletter = NewsLetter::create([
            'email' => $request->email,
            'status' => true,
        ]);
        $subscriber = (object) ['email' => $request->email];
        Notification::route('mail', $request->email)
        ->notify(new NewsletterWelcomeNotification());


        $admins = User::where('role', 0)->get();
        Notification::send($admins, new NewsletterSubscriptionNotification($newsletter));


        return redirect()->back()->with('success', 'Newsletter added successfully!');
    }

    public function unsubscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:newsletter,email',
        ]);

        $newsletter = NewsLetter::where('email', $request->email)->first();
        $newsletter->delete();

        return redirect()->back()->with('success', 'Anda berhasil berhenti berlangganan newsletter kami.');
    }

}
