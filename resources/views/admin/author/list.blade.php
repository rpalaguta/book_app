@extends('admin_template')

@section('body')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="row">
        <div class="col">
            <a href="{{ route('admin.author.create') }}" class="btn btn-primary">Create</a>
        </div>
    </div>
    <table class="table">
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Birthday</td>
        </tr>
        @foreach($authors as $author)
            <tr>
                <td>{{ $author->id }}</td>
                <td><a href="{{ url('admin/author/show', $author->id) }}">{{ $author->full_name }}</a></td>
                <td>{{ $author->birthday }}</td>
            </tr>
        @endforeach
    </table>
@endsection
