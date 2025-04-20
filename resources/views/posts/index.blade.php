@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Все сообщения</h1>

    @auth
        <a href="{{ url('/posts/create') }}" class="btn btn-success mb-3">Создать новое сообщение</a>
    @endauth

    @foreach ($posts as $post)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text">{{ $post->description }}</p>

                @if ($post->user_id === auth()->id())
                    <a href="{{ url('/posts/' . $post->id . '/edit') }}" class="btn btn-primary btn-sm">Редактировать</a>

                    <form action="{{ url('/posts/' . $post->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                    </form>
                @endif
            </div>
        </div>
    @endforeach

</div>
@endsection
