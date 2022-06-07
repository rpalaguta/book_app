@extends('app_template')

@section('body')
    <div class="row">
    @foreach($newest_book as $book)
        <div class="col-3">
            <div class="card">
                <img src="{{ Storage::disk('digitalocean')->url($book->image) }}" class="card-img-top">
                <div class="card-body">
                    <h3>{{ $book->name }} {{ $book->id }}</h3>
                    <span>{{ __('Category') }}: {{ $book->category->name }}</span><br>
                    <span>{{ __('Page') }}: {{ $book->page }}</span><br>
                    <span>{{ __('Format') }}: {{ $book->format }}</span><br>
                    <span>{{ __('Language') }}: {{ $book->language }}</span>
                </div>
            </div>
        </div>
    @endforeach
    </div>
@endsection
