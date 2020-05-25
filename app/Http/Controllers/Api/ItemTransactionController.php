<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ItemTransaction\StoreItemTransaction;
use App\Http\Requests\ItemTransaction\UpdateItemTransaction;
use App\Http\Resources\ItemTransaction as ItemTransactionResource;
use App\ItemTransaction;
use Illuminate\Http\Request;

class ItemTransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    // only admin
    public function store(StoreItemTransaction $request)
    {
        $newItem = ItemTransaction::create($request->all());

        // update transaction total_price
        $transaction = $newItem->transaction;
        $transaction->total_price += $newItem->item->price * $newItem->quantity;
        $transaction->save(); 

        $item = new ItemTransactionResource(
            ItemTransaction::withRelations()->where('id', $newItem->id)->first()
        );

        return response()->json([
            'status' => "Success add new item to the transcation list with id {$newItem->transcation_id}!",
            'item' => $item,
        ]);
    }

    // only admin
    public function update(UpdateItemTransaction $request, $id)
    {
        $item = ItemTransaction::find($id);

        $item->fill($request->all());
        $item->save();

        $item = new ItemTransactionResource(
            Item::withRelations()->where('id', $id)->first()
        );

        return response()->json([
            'status' => 'Success update item transaction list data!',
            'item' => $item,
        ]);    
    }

    // only admin
    public function destroy($id)
    {
        $item = ItemTransaction::find($id);

        // Kalo pas nge-eksekusi kode line 81 gagal, bakal kena error: ErrorException.
        $item->quantity;

        // Kalo pas nge-eksekusi kode line 81 berhasil, model bakalan di delete.
        $item->delete();

        return response()->json([
            'status' => "Success delete item transaction list with id {$id}!",
        ]);      
    }
}
