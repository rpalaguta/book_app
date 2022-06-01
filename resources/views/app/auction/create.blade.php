@extends('layouts.app')

@section('content')
    <div id="auction_spa">
        <div id="error" style="color:red;font-weight:700"></div>
        <div id="success" style="color:green;font-weight:700"></div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Books:</strong>
                    <select class="form-select" id="book_id" name="book_id">
                        @foreach($books as $book)
                            <option value="{{ $book->id }}">{{ $book->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Price:</strong>
                    <input type="text" id="price" name="price" value="0" class="form-control" placeholder="IBAN">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Quantity:</strong>
                    <input type="text" id="quantity" name="quantity" value="0" class="form-control" placeholder="Quantity">
                </div>
            </div>


            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" id="enabled">
                    <label class="form-check-label" for="enabled">
                        <strong>Enabled</strong>
                    </label>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center pt-3">
                <button id="trigger" type="button" class="btn btn-primary">Create</button>
            </div>

        </div>
    </div>
@endsection
