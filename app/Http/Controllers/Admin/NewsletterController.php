<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsLetter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function manage() {
        $newsletters = NewsLetter::all();
        return view('admin.newsletter.manage', compact('newsletters'));
    }

    
   
    public function destroy($id) {
        $newsletter = NewsLetter::findOrFail($id);
        $newsletter->delete();

        return redirect()->route('admin.newsletter.manage')->with('success', 'Newsletter deleted successfully!');
    }
}
