@extends('admin_template')

@section('body')
    <form action="{{ url('admin/book/create') }}" method="post">
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
                    <strong>Authors:</strong>
                    <select class="form-select @error('author_id') is-invalid @enderror" name="author_id[]" multiple>
                        <option value="">--</option>
                        @foreach($authors as $author)
                            <option value="{{ $author->id }}">{{ $author->full_name }}</option>
                        @endforeach
                    </select>
                    @error('author_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Category:</strong>
                    <select class="form-select @error('category_id') is-invalid @enderror" name="category_id">
                        <option value="">--</option>
                        @foreach($categories as $category)
                            <optgroup label="{{ $category->name }}">
                                @foreach($category->childrenCategories as $childrenCategory)
                                    <option value="{{ $childrenCategory->id }}">{{ $childrenCategory->name }}</option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                    @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Description:</strong>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>IBAN:</strong>
                    <input type="text" name="iban" value="{{ old('iban') }}" class="form-control @error('iban') is-invalid @enderror" placeholder="IBAN">
                    @error('iban')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>SKU:</strong>
                    <input type="text" name="sku" value="{{ old('sku') }}" class="form-control @error('iban') is-invalid @enderror" placeholder="SKU">
                    @error('sku')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Year:</strong>
                    <input type="text" name="year" value="{{ old('year') }}" class="form-control @error('year') is-invalid @enderror" placeholder="Year">
                    @error('year')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Page:</strong>
                    <input type="text" name="pages" value="{{ old('pages') }}" class="form-control @error('pages') is-invalid @enderror" placeholder="Pages">
                    @error('pages')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Format:</strong>
                    <input type="text" name="format" value="{{ old('format') }}" class="form-control @error('format') is-invalid @enderror" placeholder="Format">
                    @error('format')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Language:</strong>
                    <input type="text" name="language" value="{{ old('language') }}" class="form-control @error('language') is-invalid @enderror" placeholder="Language">
                    @error('language')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center pt-3">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
@endsection
