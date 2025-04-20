@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Главная страница') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Вы вошли в систему!') }}
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mb-4">
        <div class="col-md-8 text-end">
            <a href="{{ route('posts.create') }}" class="btn btn-success">
                + Написать сообщение
            </a>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach ($posts as $post)
                <div class="card mb-3">
                    <div class="card-header">
                        <strong>{{ $post->user->name }}</strong> написал:
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{{ $post->description }}</p>

                        @if ($post->image_url)
                            <div class="mb-3">
                                <img src="{{ asset('storage/' . $post->image_url) }}" alt="Post Image" class="img-thumbnail" style="max-width: 100px; cursor: pointer;" onclick="toggleImageSize(this)">
                            </div>
                        @endif

                        @if ($post->user_id == auth()->id())
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary btn-sm">Редактировать</a>

                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Вы уверены, что хотите удалить это сообщение?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach

            @if ($posts->isEmpty())
                <div class="alert alert-info">
                    Сообщений пока нет. Будь первым, кто напишет!
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    function toggleImageSize(img) {
        if (img.style.maxWidth === "100px") {
            img.style.maxWidth = "500px";
        } else {
            img.style.maxWidth = "100px";
        }
    }
</script>

@endsection
