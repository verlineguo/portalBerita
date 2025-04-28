<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Newsletter;

class NewsletterController extends Controller
{
    public function store(Request $request) {
        
        $request->validate([
            'email' => 'required|email',
        ]);

        Newsletter::create([
            'email' => $request->email,
            'status' => 1,

        ]);
        return redirect()->back()->with('success', 'Newsletter added successfully!');
    }
}
