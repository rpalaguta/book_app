@extends('admin_template')

@section('body')
    <div class="row">
        <div class="col-lg-12 my-2">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ url('admin/category') }}"> Back</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Category name:</strong>
                {{ $category->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Parent category:</strong>
                @if($category->parentCategoryName)
                    {{ $category->parentCategoryName->name }}
                @endif
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Active:</strong>
                {{ $category->active }}
            </div>
        </div>
    </div>
@endsection
