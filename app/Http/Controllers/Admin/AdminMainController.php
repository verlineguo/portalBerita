<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminMainController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }
    public function setting()
    {
        return view('admin.settings');
    } 
    public function comment_history()
    {
        return view('admin.comment.history');
    } 
    public function contact_history()
    {
        return view('admin.contact.history');
    }  
    public function newsletter_history()
    {
        return view('admin.newsletter.history');
    }  
}
