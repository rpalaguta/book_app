@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
                    <div class="card-title" style="padding:10px; font-size:24px">

                        Books

                    </div>
                    <div class="card-body">
                        <div id="filter">
<!--
1. Prisidedam inputa name
2. ant formos submit callsinsim js
3. js perrenderins visa lista
-->
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Name of the book...">
                            </div>

                            <div class="mb-3">
                                <label for="category_name" class="form-label">Category name</label>
                                <input type="text" class="form-control" id="category_name" placeholder="Name of the category...">
                            </div>

                            <div class="mb-3">
                                <label for="author" class="form-label">Author</label>
                                <input type="text" class="form-control" id="author" placeholder="Name of the author...">
                            </div>

                            <div class="mb-3">
                                <label for="category" class="form-label">Category</label>
                                <select class="form-control" id="category">
                                    <option value="">Select category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="category" class="form-label">Languages</label>
                                <select class="form-control" id="language">
                                    <option value="">Select language</option>
                                    @foreach($languages as $language)
                                        <option value="{{ $language }}">{{ $language }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="category" class="form-label">SORT BY</label>
                                <select class="form-control" id="sort">
                                    <option value="">-</option>
                                    @foreach($sortingValues as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <button id="search" type="button" class="btn btn-primary">Search</button>
                        </div>

                        <div id="bookContainer">
                            loading...
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
