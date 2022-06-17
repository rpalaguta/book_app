@extends('admin_template')

@section('body')
    <form action="{{ route('news.create') }}" method="post" enctype="multipart/form-data">
        @csrf   

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Title:</strong>
                    <input type="text" name="title" value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror" placeholder="Title">
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            {{-- <div class="col-xs-12 col-sm-12 col-md-12">
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
            </div> --}}
            
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Description:</strong>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Active:</strong>
                    <input type="checkbox" name="active" value="1" id="flexCheckChecked" class="form-check-input" checked>
                    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12 text-center pt-3">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
@endsection
