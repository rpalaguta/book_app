<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Request;

class AuctionController extends Controller
{
    public function create(Request $request): View
    {
        //importer logic

        return view('app.auction.create', ['books' => Book::all()]);
    }
}
