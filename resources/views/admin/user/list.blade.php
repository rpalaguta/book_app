@extends('admin_template')

@section('title')
    Users list
@endsection
@section('body')
    @include('admin.shared.messages')

    <a href="{{ route('admin.user.blocked') }}">BLocked list</a>
    <div class="row">
        <div class="col">
            <a href="{{ route('admin.user.create') }}" class="btn btn-primary">Create</a>
        </div>
    </div>

    @include('admin.shared.user_list')
@endsection
