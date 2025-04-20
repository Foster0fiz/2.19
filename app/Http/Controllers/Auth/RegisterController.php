<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    protected $redirectTo = '/home'; 

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->validated(); 

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('avatars', 'public');
            $data['image_url'] = $path; 
        }

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'image_url' => $data['image_url'] ?? null, 
        ]);

        Auth::login($user);

        return redirect($this->redirectTo); 
    }
}
