@extends('layouts.app')

@section('content')
<div class="container-fluid">

    @auth
        <div class="col-md-8 mx-auto">
            <a href="{{ url('/posts/myPosts') }}">
                <button type="button" class="btn btn-info">MIS POSTS</button>
            </a>

            <a class="dropdown-item" href="{{ url('/user/count') }}">
                    
                <button class="btn btn-info">
                    {{ __('ACTUALIZAR CUENTA') }}
                </button>
            </a>
        </div>   

    @endauth

    @foreach ($posts as $post)
    <div class="row align-items-center h-100">
        <div class="card col-md-8 mx-auto">
            <div class="card-body">
                <h5 class="card-title">
                    <a href="{{ url('/posts/' . $post->id) }}">
                        {{$post->title}}
                    </a>
                </h5>

                @if (Request::url() === url('/posts/myPosts'))
                    <form method="POST" action="{{ url('/posts/myPosts/' . $post->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            ELIMINAR
                        </button> 
                    </form>
                        
                @endif

            </div>
        </div>  
    </div>
    @endforeach
    {{ $posts->links()}}
</div>
@endsection
