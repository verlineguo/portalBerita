<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.profile.index');
    }


    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'phone' => ['nullable', 'string', 'max:20'],
            'profile_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'current_password' => ['required', 'string', function ($attribute, $value, $fail) use ($user) {
                if (!Hash::check($value, $user->password)) {
                    $fail('The current password is incorrect.');
                }
            }]
        ]);

        try {
            // Update the user model with validated data
            $userData = [
                'name' => $validated['name'],
                'email' => $validated['email'],
            ];
            
            // Add phone if provided
            if (isset($validated['phone'])) {
                $userData['phone'] = $validated['phone'];
            }

            // Handle profile image upload
            // Handle profile image upload
if ($request->hasFile('profile_image')) {
    // Delete old image if exists
    if ($user->profile_image && file_exists(public_path($user->profile_image))) {
        unlink(public_path($user->profile_image));
    }

    // Store new image in public/profile-images/
    $image = $request->file('profile_image');
    $imageName = time() . '_' . $image->getClientOriginalName();
    $image->move(public_path('profile-images'), $imageName);
    $userData['profile_image'] = 'profile-images/' . $imageName;
}


            // Update user using update method instead of save
            User::where('id', $user->id)->update($userData);

            return redirect()->route('admin.profile')->with('success', 'Profile updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update profile: ' . $e->getMessage())->withInput();
        }
    }


    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'current_password' => ['required', 'string', function ($attribute, $value, $fail) use ($user) {
                if (!Hash::check($value, $user->password)) {
                    $fail('The current password is incorrect.');
                }
            }],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user->password = Hash::make($validated['password']);
        $user->save();

        return redirect()->route('admin.profile')->with('success', 'Password updated successfully.');
    }

}
