<?php

namespace App\Http\Controllers;

// app/Http/Controllers/UserController.php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function edit()
    {
        return view('profile.edit');
    }

    public function update(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
        'password' => 'nullable|string|min:8|confirmed',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    $data = $request->only('name', 'email');
    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
    }

    $user->update($data);

    if ($request->hasFile('image')) {
        $user->image()->delete();
        $path = $request->file('image')->store('images', 'public');
        $user->image()->create(['url' => $path]);
    }

    return redirect()->route('profile.edit')->with('success', 'Profile updated successfully');
}


    private function storeImage($model, $image)
    {
        $path = $image->store('images', 'public');
        $model->image()->create(['url' => $path]);
    }
}