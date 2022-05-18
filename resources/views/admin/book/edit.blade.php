@extends('admin_template')

@section('body')
    <h1> Edit book </h1>
    <form action="{{ route('admin.book.edit', $book->id) }}" method="post">
        @csrf

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" value="{{ old('name') ?: $book->name }}" class="form-control @error('name') is-invalid @enderror" placeholder="Name">
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Authors:</strong>
                    <select class="form-select @error('author_id') is-invalid @enderror" name="author_id[]" multiple>
                        <option value="">--</option>
                        @foreach($authors as $author)
                            <!-- patikrinti ar musu knygoje yra author->id
                                $book->authors->contains()
                            -->
                            <option @if($book->authors->contains($author->id)) selected @endif value="{{ $author->id }}">{{ $author->full_name }}</option>
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
                                    <!-- Patikrinti ar knygos Categorijos id sutampa su foreach esanciu kategorijos id -->
                                    <option @if($book->category->is($childrenCategory)) selected @endif value="{{ $childrenCategory->id }}">
                                        {{ $childrenCategory->name }}
                                    </option>
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
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror">{{ $book->description }}</textarea>
                    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>IBAN:</strong>
                    <input type="text" name="iban" value="{{ $book->iban }}" class="form-control @error('iban') is-invalid @enderror" placeholder="IBAN">
                    @error('iban')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Year:</strong>
                    <input type="text" name="year" value="{{ old('year') ?: $book->year }}" class="form-control @error('year') is-invalid @enderror" placeholder="Year">
                    @error('year')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Page:</strong>
                    <input type="text" name="pages" value="{{ $book->pages }}" class="form-control @error('pages') is-invalid @enderror" placeholder="Pages">
                    @error('pages')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Format:</strong>
                    <input type="text" name="format" value="{{ $book->format }}" class="form-control @error('format') is-invalid @enderror" placeholder="Format">
                    @error('format')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Language:</strong>
                    <input type="text" name="language" value="{{ $book->language }}" class="form-control @error('language') is-invalid @enderror" placeholder="Language">
                    @error('language')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center pt-3">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
@endsection
