<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdvertisementController extends Controller
{
    public function index() {
        return view('admin.advertisement.create');
    }
    public function manage() {
        $advertisements = Advertisement::all();
        return view('admin.advertisement.manage', compact('advertisements'));
    }
    public function store(Request $request) {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'position' => 'required|string|max:255',
            'status' => 'nullable|boolean',
        ]);

        $image_path = $request->file('image')->store('advertisement', 'public');
        $image_name = str_replace('public/', '', $image_path);

        Advertisement::create([
            'image' => $image_name,
            'position' => $request->position,
            'status' => $request->has('status') ? 1 : 0,
        ]);

        return redirect()->route('admin.advertisement.manage')->with('success', 'Advertisement added successfully!');
    }
    public function show($id) {
        $advertisement = Advertisement::findOrFail($id);
        return view('admin.advertisement.edit', compact('advertisement'));
    }

    public function destroy($id) {
        
        $advertisement = Advertisement::findOrFail($id);
        if ($advertisement->image && file_exists(storage_path('app/public/' . $advertisement->image))) {
            unlink(storage_path('app/public/' . $advertisement->image));
        }
        $advertisement->delete();

        return redirect()->route('admin.advertisement.manage')->with('success', 'Advertisement deleted successfully!');
    }
    public function update(Request $request, $id) {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'position' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);


        $advertisement = Advertisement::findOrFail($id);
        if($request->hasFile('image')) {
            if ($advertisement->image && file_exists(storage_path('app/public/' . $advertisement->image))) {
                unlink(storage_path('app/public/' . $advertisement->image));
            }

            $image_path = $request->file('image')->store('public/advertisement');
            $advertisement->image = str_replace('public/', '', $image_path);

        } 
        $advertisement->position = $request->position;
        $advertisement->status = $request->status;
        $advertisement->save();


        return redirect()->route('admin.advertisement.manage')->with('success', 'Advertisement updated successfully!');
    }
}
