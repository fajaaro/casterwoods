<?php

namespace App\Http\Controllers\Api;

use App\Box;
use App\Card;
use App\Http\Controllers\Controller;
use App\Http\Requests\Transaction\StoreTransaction;
use App\Http\Resources\Transaction as TransactionResource;
use App\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    // only admin
    public function index()
    {
        $transactions = TransactionResource::collection(
            Transaction::withRelations()->get()
        );

        return response()->json([
            'status' => 'Success get all transactions data!',
            'transactions' => $transactions,
        ]);
    }

    // only admin
    public function store(StoreTransaction $request)
    {
        $boxBuyed = Box::find($request->input('box_id'));
        $cardBuyed = Card::find($request->input('card_id'));

        // add total_price field to request, so Transaction mass assignment will work fine 
        $request->merge([
            'total_price' => $boxBuyed->price + $cardBuyed->price
        ]);

        $newTransaction = Transaction::create($request->all());

        $transaction = new TransactionResource(
            Transaction::withRelations()->where('id', $newTransaction->id)->first()
        );

        return response()->json([
            'status' => 'Success create new transaction!',
            'transaction' => $transaction,
        ]);
    }

    public function show($id)
    {
        $transaction = new TransactionResource(
            Transaction::withRelations()->where('id', $id)->first()
        );

        return response()->json([
            'status' => 'Success get transaction data!',
            'transaction' => $transaction,
        ]); 
    }

    // only admin
    public function destroy($id)
    {
        $transaction = Transaction::find($id);

        // Kalo pas nge-eksekusi kode line 81 gagal, bakal kena error: ErrorException.
        $transaction->card_content;

        // Kalo pas nge-eksekusi kode line 81 berhasil, model bakalan di delete.
        $transaction->delete();

        return response()->json([
            'status' => "Success delete transaction with id {$id}!",
        ]);   
    }

    // only admin
    public function transactionSuccessAction($id)
    {
        $transaction = Transaction::find($id);
        $transaction->status = 1;
        $transaction->save();

        $boxBuyed = $transaction->box;
        $boxBuyed->quantity -= 1;
        $boxBuyed->save();

        $cardBuyed = $transaction->card;
        $cardBuyed->quantity -= 1;
        $cardBuyed->save();

        $itemTransactions = $transaction->itemTransactions;
        foreach ($itemTransactions as $itemTransaction) {
            $item = $itemTransaction->item;
            $item->quantity -= $itemTransaction->quantity;
            $item->save();
        }

        $transaction = new TransactionResource(
            Transaction::withRelations()->where('id', $id)->first()
        );

        return response()->json([
            'status' => 'Transaction status has been changed to success (1)!',
            'transaction' => $transaction,
        ]);         
    }

    // only admin
    public function transactionFailedAction($id)
    {
        $transaction = Transaction::find($id);
        $transaction->status = -1;
        $transaction->save();

        return response()->json([
            'status' => 'Transaction status has been changed to failed (-1)!',
            'transaction' => $transaction,
        ]);         
    }
}