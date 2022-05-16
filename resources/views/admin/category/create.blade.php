@extends('admin_template')

@section('body')
    <form action="{{ url('admin/category/create') }}" method="post">
        @csrf

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="Name">
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Parent category:</strong>
                    <select class="form-select" name="category_id">
                        <option value="">--</option>
                        @foreach($firstLevelCategories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-check">
                    <input type="checkbox" name="active" value="1" id="flexCheckChecked" class="form-check-input"
                           @if (old('active'))
                           checked
                        @endif
                    >
                    <label class="form-check-label" for="flexCheckChecked">
                        Active
                    </label>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
@endsection
