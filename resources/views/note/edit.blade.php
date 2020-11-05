@extends('layouts.app')

@section('title', 'Create note')

@section('content')
    <div class="container">
        <h1>Update Note</h1>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('note.update',$note->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group row">
                <label for="content" class="col-1 col-form-label">Content</label>

                <div class="col-6">
                    <input placeholder="Content note" id="content" type="text" class="form-control @error('content') is-invalid @enderror" name="content" value="{{$note->content}}" required>
                    @error('content')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div>
                <button type="submit" class="btn btn-primary btn-sm">
                    Update
                </button>
                <input type="text" hidden name="user_id" value="{{Auth::user()->id}}">
                <a href="{{route('note.index')}}" class="btn btn-primary btn-sm">Back</a>
            </div>
        </form>
    </div>
@endsection
