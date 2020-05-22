<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Item\StoreItem;
use App\Http\Requests\Item\UpdateItem;
use App\Http\Resources\Item as ItemResource;
use App\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    public function index()
    {
        $items = ItemResource::collection(
            Item::withRelations()->get()
        );

        return response()->json([
            'status' => 'Success get all items data!',
            'items' => $items,
        ]);
    }

    public function store(StoreItem $request)
    {
        $newItem = Item::create($request->all());

        $numberOfImages = count($request->file('images'));
        for ($i = 0; $i < $numberOfImages; $i++) {
            $url = Storage::putFile('images/items', $request->file('images')[$i]);

            $newItem->images()->create([
                'url' => $url,
            ]);
        }

        $item = new ItemResource(
            Item::withRelations()->where('id', $newItem->id)->first()
        ); 

        return response()->json([
            'status' => 'Success create new item!',
            'item' => $item,
        ]);
    }

    public function show($id)
    {
        $item = new ItemResource(
            Item::withRelations()->where('id', $id)->first()
        );

        return response()->json([
            'status' => 'Success get item data!',
            'item' => $item,
        ]);     
    }

    // use request: post, body: form-data and addition field _method: put. 
    public function update(UpdateItem $request, $id)
    {
        $item = Item::find($id);

        $item->fill($request->all());
        $item->save();

        $numberOfImages = count($request->file('images'));
        for ($i = 0; $i < $numberOfImages; $i++) {
            $url = Storage::putFile('images/items', $request->file('images')[$i]);

            $item->images()->create([
                'url' => $url,
            ]);
        }

        $item = new ItemResource(
            Item::withRelations()->where('id', $id)->first()
        );

        return response()->json([
            'status' => 'Success update item data!',
            'item' => $item,
        ]);    
    }

    public function destroy($id)
    {
        $item = Item::find($id);

        // Kalo pas nge-eksekusi kode line 81 gagal, bakal kena error: ErrorException.
        $item->category_id;

        // Kalo pas nge-eksekusi kode line 81 berhasil, model bakalan di delete.
        foreach ($item->images as $image) {
            Storage::delete($image->url);
        }

        // Update total_price suatu data transaction kalo ada itemnya yang dihapus.
        foreach($item->itemTransactions as $itemTransaction) {
            $item = $itemTransaction->item;

            $transaction = $itemTransaction->transaction;
            $transaction->total_price -= $item->price * $itemTransaction->quantity;
            $transaction->save();
        }

        $item->delete();

        return response()->json([
            'status' => "Success delete item with id {$id}!",
        ]);      
    }
}