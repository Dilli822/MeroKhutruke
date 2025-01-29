<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    // Show user profile page
    public function show()
    {
        $profile = Auth::user()->profile; // Fetch the authenticated user's profile
        return view('user.profile', compact('profile'));
    }

    // Show the edit form for the profile
    public function edit()
    {
        // Fetch the user's profile
        $profile = auth()->user()->profile;
    
        // If no profile exists, create a new empty profile
        if (!$profile) {
            $profile = new UserProfile();
        }
    
        return view('user.edit', compact('profile'));
    }
    

    public function update(Request $request)
    {
        // Validate the input fields
        $validated = $request->validate([
            'bio' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,gif',
        ]);
    
        // Get the authenticated user
        $user = Auth::user();
    
        // Check if the user has a profile; if not, create a new one
        $profile = $user->profile ?: new UserProfile(['user_id' => $user->id]);
    
        // Update the profile fields
        $profile->bio = $validated['bio'];
        $profile->phone = $validated['phone'];
        $profile->address = $validated['address'];
    
        // Handle avatar upload if a file was uploaded
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $profile->avatar = $avatarPath;
        }
    
        // Save the profile
        $profile->save();
    
    // Return a response with a flag for delayed redirect
    return redirect()->route('user.profile.edit')->with([
        'success' => 'Profile updated successfully',
        'delay_redirect' => true, // Flag to indicate a delayed redirect
    ]);
    }
    
}
