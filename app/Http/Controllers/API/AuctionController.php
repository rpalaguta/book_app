<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuctionResource;
use App\Models\Auction;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class AuctionController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return AuctionResource::collection(Auction::all());
    }

    public function show(string $id): AuctionResource|Response
    {
        /** @var Auction $auction */
        $auction = Auction::find($id);

        if ($auction) {
            return new AuctionResource($auction);
        }

        return response(['error' => 'Auction does not exist'], 404);
    }

    public function store(Request $request): Response|AuctionResource
    {
        $validation = Validator::make(
            $request->all(),
            [
                'book_id' => 'required',
                'price' => 'required',
                'enabled' => 'required',
                'quantity' => 'required',
            ]
        );

        if ($validation->errors()->count() > 0) {
            return response(['errors' => $validation->errors()], 400);
        }

        $auction = new Auction();
        $auction->price = $request->price;
        $auction->enabled = $request->enabled;
        $auction->quantity = $request->quantity;
        $auction->book_id = $request->book_id;
        $auction->user_id = Auth::user()->id;
        $auction->save();

        return new AuctionResource($auction);
    }

    public function update(int $sellerId, string $auctionId, Request $request): Response|AuctionResource
    {
        $auction = Auction::where('id', '=', $auctionId)->where('user_id', '=', $sellerId)->first();

        if (!$auction) {
            return response(['error' => 'Auction does not exist'], 404);
        }

        if (!Gate::allows('update-auction', $auction)) {
            return response(['error' => 'You do not have permissions to edit auction'], 403);
        }

        $validation = Validator::make(
            $request->all(),
            [
                'price' => 'required',
                'enabled' => 'required',
                'quantity' => 'required',
            ]
        );

        if ($validation->errors()->count() > 0) {
            return response(['errors' => $validation->errors()], 400);
        }

        $auction->price = $request->price;
        $auction->enabled = $request->enabled;
        $auction->quantity = $request->quantity;
        $auction->save();

        return new AuctionResource($auction);
    }
}
