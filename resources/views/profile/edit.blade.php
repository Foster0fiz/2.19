@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Редактировать профиль</h1>

    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Имя</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Фото</label>
            @if($user->image_url)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $user->image_url) }}" class="img-thumbnail" alt="Фото профиля" style="width: 150px;">
                </div>
            @endif
            <input class="form-control" type="file" id="image" name="image">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Новый пароль</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Введите новый пароль">
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Подтверждение пароля</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Подтвердите новый пароль">
        </div>

        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
    </form>
</div>
@endsection
