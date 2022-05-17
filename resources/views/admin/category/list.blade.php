@extends('admin_template')

@section('body')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="row">
        <div class="col">
            <a href="{{ url('admin/category/create') }}" class="btn btn-primary">Create</a>
        </div>
    </div>
    <table class="table">
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Parent name</td>
            <td>Active</td>
        </tr>
        @foreach($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td><a href="{{ url('admin/category/show', $category->id) }}">{{ $category->name }}</a></td>
                <td>
                    @if($category->parentCategoryName)
                        {{ $category->parentCategoryName->name }}
                    @endif
                </td>
                <td>{{ $category->active }}</td>
            </tr>
        @endforeach
    </table>
@endsection
