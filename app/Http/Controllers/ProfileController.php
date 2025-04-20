<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateProfileRequest;
class ProfileController extends Controller
{
    public function edit()
    {
        // Получаем аутентифицированного пользователя
        $user = Auth::user();

        // Передаем данные пользователя в представление
        return view('profile.edit', compact('user'));
    }

    public function update(UpdateProfileRequest $request)
    {
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;

        // Обновляем изображение, если оно было загружено
        if ($request->hasFile('image')) {
            // Удаляем старое изображение
            if ($user->image_url && file_exists(public_path('storage/' . $user->image_url))) {
                unlink(public_path('storage/' . $user->image_url));
            }

            // Сохраняем новое изображение
            $path = $request->file('image')->store('avatars', 'public');
            $user->image_url = $path;
        }

        // Обновляем пароль, если он был передан
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('profile.edit')->with('status', 'Профиль обновлен!');
    }
}
