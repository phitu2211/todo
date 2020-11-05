@extends('layouts.app')

@section('title', 'Note View Title')

@section('content')
<div class="container">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div>
        <a href="note/create" class="btn btn-primary btn-sm">Create</a>
        <h1 class="text-center">List Note</h1>
    </div>
    <table class="table table-hover table-sm">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Content</th>
            <th scope="col">Author</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($notes as $note)
            <tr>
                <th scope="row">{{ $loop->index + 1 }}</th>
                <td>{{$note->content}}</td>
                <td>{{$note->user->username}}</td>
                <td>
                    <form method="POST" action="{{ route('note.destroy',$note->id) }}" onsubmit="return confirm('Do you really want to delete?');">
                        @method('DELETE')
                        @csrf
                        <a class="btn btn-sm btn-secondary" href="{{ route('note.edit',$note->id) }}">Edit</a>
    {{--                    <a class="btn btn-sm btn-danger btn-delete" href="{{ route('note.destroy',$note->id) }}">Delete</a>--}}
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
