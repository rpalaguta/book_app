@extends('app_template')

@section('body')
    <div class="card">
        <div class="card-header">{{ __('Book') }}</div>
        <div class="card-body">
            <div id="filter">
<!--
1. Prisidedam inputa name
2. ant formos submit callsinsim js
3. js perrenderins visa lista
-->
                <div class="mb-3">
                    <label for="name" class="form-label">{{ __('Name') }}</label>
                    <input type="text" class="form-control" id="name" placeholder="{{ __('Name of the book...') }}">
                </div>

                <div class="mb-3">
                    <label for="category_name" class="form-label">{{ __('Category name') }}</label>
                    <input type="text" class="form-control" id="category_name" placeholder="{{ __('Name of the category...') }}">
                </div>

                <div class="mb-3">
                    <label for="author" class="form-label">{{ __('Author') }}</label>
                    <input type="text" class="form-control" id="author" placeholder="{{ __('Name of the author...') }}">
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label">{{ __('Category') }}</label>
                    <select class="form-control" id="category">
                        <option value="">{{ __('Select category') }}</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label">{{ __('Languages') }}</label>
                    <select class="form-control" id="language">
                        <option value="">{{ __('Select language') }}</option>
                        @foreach($languages as $language)
                            <option value="{{ $language }}">{{ $language }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label">{{ __('SORT BY') }}</label>
                    <select class="form-control" id="sort">
                        <option value="">-</option>
                        @foreach($sortingValues as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>


                <button id="search" type="button" class="btn btn-primary">{{ __('Search') }}</button>
            </div>

            <div id="bookContainer">
                loading...
            </div>
        </div>
    </div>
@endsection
