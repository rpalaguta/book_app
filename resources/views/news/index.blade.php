@extends('admin_template')

@section('body')
    <div class="row">
        <div class="col">
            <a href="{{ url('news/create') }}" class="btn btn-primary">Create</a>
        </div>
    </div>
    <table class="table">
        <tr>
            <td>ID</td>
            <td>{{ __('Title') }}</td>
            <td>{{ __('Description') }}</td>
            <td>{{ __('Active') }}</td>
        </tr>
        @foreach($news as $article)
            <tr>
                <td>{{ $article->id }}</td>
                <td>{{ $article->title }}</a></td>
                <td>{{ $article->description }}</td>
                <td>{{ $article->active }}</td>
                <td>
                    <a href="{{ route('news.edit', $article->id) }}">Edit</a>
                    {{-- <form action="{{ route('news.delete', $news->id) }}" method="post">
                        @csrf
                        @method("delete")
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form> --}}
                </td>
            </tr>
        @endforeach
    </table>
@endsection

