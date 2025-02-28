<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    public function index() {
        return view('admin.advertisement.create');
    }
    public function manage() {
        return view('admin.advertisement.manage');
    }

}
