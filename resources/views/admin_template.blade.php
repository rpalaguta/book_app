@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-title" style="padding:10px; font-size:24px">
                    @yield('title')
                </div>
                <div class="card-body">
                    @yield('body')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
