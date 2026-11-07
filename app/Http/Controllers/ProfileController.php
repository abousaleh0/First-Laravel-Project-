<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function store(StoreProfileRequest $request)
    {
        if (Auth::user()->profile) {
            return response()->json([
                'message' => 'User already has a profile'
            ], 400);
        }

        $validatedData = $request->validated();
        $validatedData['user_id'] = Auth::user()->id;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('My photo', 'public');
            $validatedData['image'] = $path;
        }
        $profile = Profile::create($validatedData);

        return response()->json([
            'message' => 'Profile created Successfully',
            'profile' => $profile
        ], 201);
    }

    #--------------------------------------------------------------------
    public function show()
    {
        $profile = Auth::user()->profile;

        // فحص: هل الملف موجود؟
        if (!$profile) {
            return response()->json(['message' => 'Profile not found'], 404);
        }
        return response()->json($profile, 200);
    }

    #--------------------------------------------------------------------
    public function update(UpdateProfileRequest $request)
    {
        $profile = Auth::user()->profile;

        // فحص: هل الملف موجود أصلاً ليتم تعديله؟
        if (!$profile) {
            return response()->json(['message' => 'Profile not found. Please create one first.'], 404);
        }

        $profile->update($request->validated());
        return response()->json([
            'message' => 'Profile updated Successfully',
            'profile' => $profile
        ], 200);
    }
}
