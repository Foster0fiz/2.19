@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Написать комментарий') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('comments.store') }}">
                        @csrf

                        <input type="hidden" name="post_id" value="{{ $post->id }}">

                        <div class="mb-3">
                            <label for="content" class="form-label">{{ __('Комментарий') }}</label>
                            <textarea id="content" class="form-control @error('content') is-invalid @enderror" name="content" rows="4" required>{{ old('content') }}</textarea>

                            @error('content')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">{{ __('Отправить') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
