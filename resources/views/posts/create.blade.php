@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h2>Nueva publicación</h2>
        </div>
        <div class="row justify-content-center"> 
            @if (count($errors) > 0) <!--$errors será una variable creada automatiamente-->
                <div class="row alert alert-danger">
                    <p>!Opss¡ Hubo problemas con los datos proporcionados</p>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ url('/posts/create') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title" class="col-sm-12 col-form-label">
                        {{ __('Title')}}
                    </label>
                    <div class="col-sm-12">
                        <input type="text" id="title" name="title" class="form-control 
                        {{$errors->has('title') ? ' is-invalid' : ''}}" value="{{ old('title') }}" autofocus>
                        @if ($errors->has('title'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="content" class="col-sm-12 col-form-label">{{ __('Content') }}</label>
                    <div class="col-sm-12">
                        <textarea name="content" id="content" rows=3" class="form-control{{ $errors->has('content') ? ' is-invalid': ''}}">{{ old('content') }}</textarea>
                        @if ($errors->has('content'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('content') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="custom-file">
                            <input type="file" id="image" name="image" class="custom-file-input{{ $errors->has('image') ? ' is-invalid' : ''}}">
                            <label for="customFile" class="custom-file-label">{{ __('Choose image') }}</label>
                            @if ($errors->has('image'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Create') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection