@extends('admin_template')

@section('title')
    Blocked users list
@endsection
@section('body')
    @include('admin.shared.messages')

    <a href="{{ route('admin.user') }}">User list</a>

    @include('admin.shared.user_list')
@endsection
