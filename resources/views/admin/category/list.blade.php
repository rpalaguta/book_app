@extends('admin_template')

@section('body')
    @include('admin.shared.messages')
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
                    @if($category->parentCategory)
                        {{ $category->parentCategory->name }}
                    @endif
                </td>
                <td>{{ $category->active }}</td>
            </tr>
        @endforeach
    </table>
@endsection
