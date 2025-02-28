<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index() {
        return view('admin.tag.create');
    }
    public function manage() {
        return view('admin.tag.manage');
    }
}
