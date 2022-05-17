@extends('admin_template')

@section('body')
    <div class="row">
        <div class="col-lg-12 my-2">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ url('admin/author') }}"> Back</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Full name:</strong>
                {{ $author->full_name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description:</strong>
                {{ $author->description }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Birthday:</strong>
                {{ $author->birthday }}
            </div>
        </div>
    </div>
@endsection
