@extends('admin_template')

@section('body')
    <h1>Import</h1>
    <form action="{{ route('admin.book.import') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>File:</strong>
                    <input type="file" name="file" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center pt-3">
                <button type="submit" class="btn btn-primary">Import</button>
            </div>
        </div>
    </form>
@endsection
