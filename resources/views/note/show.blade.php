@extends('layouts.app')

@section('title', 'Create note')

@section('content')
    <div class="container">
        <h1>View Note</h1>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div>
            {{$note->content}}
        </div>
        <a href="{{route('note.index')}}" class="btn btn-primary btn-sm">Back</a>
    </div>
@endsection
