<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PremadeTransaction\StorePremadeTransaction;
use App\Http\Resources\PremadeTransaction as PremadeTransactionResource;
use App\Jobs\SendEmailAfterPremadeBoxTransactionCreated;
use App\PremadeBox;
use App\PremadeTransaction;
use Illuminate\Http\Request;

class PremadeTransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('admin')->except(['store', 'show']);
    }

    // only admin
    public function index()
    {
        $premadeTransactions = PremadeTransactionResource::collection(
            PremadeTransaction::withRelations()->get()
        );

        return response()->json([
            'status' => 'Success get all premade transactions data!',
            'premade_transactions' => $premadeTransactions,
        ]);
    }

    public function store(StorePremadeTransaction $request)
    {
        $premadeBoxBuyed = PremadeBox::find($request->input('premade_box_id'));

        // add total_price field to request, so Transaction mass assignment will work fine 
        $request->merge([
            'total_price' => $premadeBoxBuyed->price,
        ]);

        $newPremadeTransaction = PremadeTransaction::create($request->all());

        $premadeTransaction = new PremadeTransactionResource(
            PremadeTransaction::withRelations()->where('id', $newPremadeTransaction->id)->first()
        );

        SendEmailAfterPremadeBoxTransactionCreated::dispatch();

        return response()->json([
            'status' => 'Success create new premade box transaction!',
            'premade_box_transaction' => $premadeTransaction,
        ]);
    }

    public function show($id)
    {
        $premadeTransaction = new PremadeTransactionResource(
            PremadeTransaction::withRelations()->where('id', $id)->first()
        );

        return response()->json([
            'status' => 'Success get premade box transaction data!',
            'premade_box_transaction' => $premadeTransaction,
        ]); 
    }

    // only admin
    public function destroy($id)
    {
        $premadeTransaction = PremadeTransaction::find($id);

        // Kalo pas nge-eksekusi kode line 81 gagal, bakal kena error: ErrorException.
        $premadeTransaction->receiver_name;

        // Kalo pas nge-eksekusi kode line 81 berhasil, model bakalan di delete.
        $premadeTransaction->delete();

        return response()->json([
            'status' => "Success delete premade box transaction with id {$id}!",
        ]);   
    }

    // only admin
    public function premadeBoxTransactionSuccessAction($id)
    {
        $premadeTransaction = PremadeTransaction::find($id);
        $premadeTransaction->status = 1;
        $premadeTransaction->save();

        $premadeBoxBuyed = $premadeTransaction->premadeBox;
        $premadeBoxBuyed->quantity -= 1;
        $premadeBoxBuyed->save();

        $premadeTransaction = new PremadeTransactionResource(
            PremadeTransaction::withRelations()->where('id', $id)->first()
        );

        return response()->json([
            'status' => 'Premade box transaction status has been changed to success (1)!',
            'premade_box_transaction' => $premadeTransaction,
        ]);         
    }

    // only admin
    public function premadeBoxTransactionFailedAction($id)
    {
        $premadeTransaction = PremadeTransaction::find($id);
        $premadeTransaction->status = -1;
        $premadeTransaction->save();

        return response()->json([
            'status' => 'Premade box transaction status has been changed to failed (-1)!',
            'premadeTransaction' => $premadeTransaction,
        ]);         
    }
}