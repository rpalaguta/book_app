@extends('layouts.app')

@section('content')
<div id="app">
    @include('layouts.app_navbar')

    <main class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    @yield('body')
                </div>
            </div>
        </div>
    </main>
</div>
@endsection
