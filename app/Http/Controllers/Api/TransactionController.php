<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transaction\StoreTransaction;
use App\Http\Requests\Transaction\UpdateTransaction;
use App\Http\Resources\Transaction as TransactionResource;
use App\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    // Belom Beres Semua

    public function index()
    {
        //
    }

    public function store(StoreTransaction $request)
    {
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

    public function update(UpdateTransaction $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
