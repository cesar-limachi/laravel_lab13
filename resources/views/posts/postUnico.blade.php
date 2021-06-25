@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-md-8">
            <div class="class">
                <!-- asset($post->image) , Storage::url($post->image)-->
                <img src="{{ asset('storage/' . $post->image) }}" alt="..." class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">
                        {{ $post->title }}
                    </h5>
                    <h6 class="card-subtitle mb text-muted">
                        {{ $post->created_at->toFormattedDateString() }}
                    </h6>
                    <p class="card-text">
                        {{ $post->content }}
                    </p>
                    <a href="{{ url('/posts') }}" class="card-link">
                        Todas las publicaciones
                    </a>
                </div>
            </div>
            @auth
                <form action="{{ url('/comments?post_id=' . $post->id) }}"
                    method="POST" 
                    enctype="multipart/form-data">
                    @csrf <!--Pide poner GET enves de POST-->
                    <div class="form-group">
                        <label for="" class="col-md-8 col-form-label">
                            {{ __('Comment') }}
                        </label>
                        <div class="col-md-8">
                            <textarea name="content" id="content" rows="3" class="form-control @error('content') is-invalid @enderror">{{ old('content') }}</textarea>
                            @error('content')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-8">
                            <button class="btn btn-primary">
                                {{ __('Create') }}
                            </button>
                        </div>
                    </div>
                </form>
            @else
                <div class="alert alert-secondary">
                    <p>
                        Si deseas comentar <a href="{{ url('/login') }}">inicia sesión</a>
                        o <a href="{{ url('/register') }}">registrate</a>
                    </p>
                </div>
            @endauth
            @forelse ($post->comments as $comment)
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            {{ $comment->user->name }}
                        </h5>
                        <h6 class="card-subtitle mb-2 text-muted">
                            {{ $comment->created_at->toFormattedDateString() }}
                        </h6>
                        <p class="card-text">
                            {{ $comment->content }}
                        </p>
                    </div>
                </div>
            @empty
                <p>No hay comentarios para esta publicación, se el primero</p>
            @endforelse
        </div>
    </div>
</div>

@endsection