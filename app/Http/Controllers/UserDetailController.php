<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class UserDetailController extends Controller
{
    /**
     * Show the profile view.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        $user = auth()->user();  // Get the authenticated user

        return view('profile.show', compact('user'));
    }

    /**
     * Show the form for editing the user's details.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $user = auth()->user();  // Get the authenticated user
        return view('profile.edit', compact('user'));
    }

    /**
     * Update the user's details.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'phone_number' => 'nullable|string|max:15',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'address' => 'nullable|string|max:255',
        ]);

        $user = auth()->user();  // Get the authenticated user

        // Handle profile image upload if exists
        $imagePath = null;
        if ($request->hasFile('profile_image')) {
            // Delete the old profile image if it exists
            if ($user->userDetail && $user->userDetail->profile_image) {
                Storage::delete('public/' . $user->userDetail->profile_image);
            }

            // Store the new image and get the path
            $imagePath = $request->file('profile_image')->store('profile_images', 'public');
        } else {
            // If no new image, keep the old one
            $imagePath = $user->userDetail ? $user->userDetail->profile_image : null;
        }

        // Use DB transaction to update the user's details
        DB::transaction(function () use ($request, $user, $imagePath) {
            $user->userDetail()->updateOrCreate(
                ['user_id' => $user->id],
                [
                    'phone_number' => $request->phone_number,
                    'profile_image' => $imagePath,
                    'address' => $request->address,
                ]
            );
        });

        return redirect()->route('profile.show')->with('success', 'User details updated successfully.');
    }
}
