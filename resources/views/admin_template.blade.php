@extends('layouts.app')

@section('content')
    <div id="app">
        @include('layouts.navbar')

        <main class="py-4">
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
        </main>
    </div>
@endsection
