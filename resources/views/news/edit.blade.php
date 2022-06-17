@extends('admin_template')

@section('body')
<form action="{{ route('news.edit', $article->id) }}" method="post" enctype="multipart/form-data">
        @csrf


        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Title:</strong>
                    <input type="text" name="title" value="{{ old('title') ?: $article->title }}" class="form-control @error('title') is-invalid @enderror" placeholder="Title">
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>            
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Description:</strong>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror">{{ $article->description }}</textarea>
                    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Active:</strong>
                    <input type="checkbox" name="active" value={{$article->active}} id="flexCheckChecked" class="form-check-input" checked>
                    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center pt-3">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
@endsection
