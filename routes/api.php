<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::name('api.')->namespace('Api')->group(function() {
	Route::apiResource('boxes', 'BoxController');
	Route::apiResource('items', 'ItemController');
	Route::apiResource('cards', 'CardController');
	Route::apiResource('transactions', 'TransactionController');
	Route::get('/transactions/{transaction}/successAction', 'TransactionController@transactionSuccessAction')->name('transactions.successAction');
	Route::get('/transactions/{transaction}/failedAction', 'TransactionController@transactionFailedAction')->name('transactions.failedAction');

	Route::apiResource('itemTransactions', 'ItemTransactionController')->except(['index', 'show']);
});

Route::fallback(function() {
 	return response()->json([
 		'status' => 'Failed!',
 		'message' => 'Not found.',
 	], 404);
})->name('api.fallback');