<?php

namespace App\Http\Controllers\Api;

use App\Card;
use App\Http\Controllers\Controller;
use App\Http\Requests\Card\StoreCard;
use App\Http\Requests\Card\UpdateCard;
use App\Http\Resources\Card as CardResource;
use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CardController extends Controller
{
    public function index() 
    {
        $cards = CardResource::collection(
            Card::withRelations()->get()
        );

        return response()->json([
            'status' => 'Success get all card data!',
            'cards' => $cards,
        ]);
    }

    public function store(StoreCard $request)
    {
        $newCard = Card::create($request->all());

        $url = Storage::putFile('images/cards', $request->file('image'));

        $newCard->image()->save(
            Image::make([
                'url' => $url
            ])
        );

        $card = new CardResource(
            Card::withRelations()->where('id', $newCard->id)->first()
        ); 

        return response()->json([
            'status' => 'Success create new card!',
            'card' => $card,
        ]);
    }

    public function show($id) 
    {
        $card = new CardResource(
            Card::withRelations()->where('id', $id)->first()
        );

        return response()->json([
            'status' => 'Success get card data!',
            'card' => $card,
        ]);        
    }

    // use request: post, body: form-data and addition field _method: put. 
    public function update(UpdateCard $request, $id)
    {
        $card = Card::find($id);

        $card->fill($request->all());
        $card->save();

        if ($request->hasFile('image')) {
            if ($card->image()->exists()) {
                Storage::delete($card->image->url);

                $image = Image::where('imageable_id', $card->id)
                            ->where('imageable_type', 'App\Card')
                            ->first();
                $image->delete();                
            }

            $url = Storage::putFile('images/cards', $request->file('image'));

            $card->image()->save(
                Image::make([
                    'url' => $url
                ])
            );            
        }

        $card = new CardResource(
            Card::withRelations()->where('id', $id)->first()
        );

        return response()->json([
            'status' => 'Success update card data!',
            'card' => $card,
        ]);                
    }

    public function destroy($id)
    {
        $card = Card::find($id);

        // Kalo pas nge-eksekusi kode line 81 gagal, bakal kena error: ErrorException.
        $card->name;

        // Kalo pas nge-eksekusi kode line 81 berhasil, model bakalan di delete.
        Storage::delete($card->image->url);
        $card->delete();

        return response()->json([
            'status' => "Success delete card with id {$id}!",
        ]);        
    }
}
