<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::name('api.')->namespace('Api')->group(function() {
	Route::get('/categories', 'CategoryController@index')->name('categories.index');
	Route::apiResource('boxes', 'BoxController');
	Route::apiResource('items', 'ItemController');
	Route::apiResource('cards', 'CardController');
	Route::apiResource('transactions', 'TransactionController')->except(['update']);
	Route::get('/transactions/{transaction}/successAction', 'TransactionController@transactionSuccessAction')->name('transactions.successAction');
	Route::get('/transactions/{transaction}/failedAction', 'TransactionController@transactionFailedAction')->name('transactions.failedAction');
	Route::apiResource('premadeBoxes', 'PremadeBoxController');
	Route::apiResource('premadeTransactions', 'PremadeTransactionController')->except(['update']);
	Route::get('/premadeTransactions/{premadeTransaction}/successAction', 'PremadeTransactionController@premadeBoxTransactionSuccessAction')->name('premadeTransactions.successAction');
	Route::get('/premadeTransactions/{premadeTransaction}/failedAction', 'PremadeTransactionController@premadeBoxTransactionFailedAction')->name('premadeTransactions.failedAction');

	Route::apiResource('itemTransactions', 'ItemTransactionController')->except(['index', 'show']);
});

Route::fallback(function() {
 	return response()->json([
 		'status' => 'Failed!',
 		'message' => 'Not found.',
 	], 404);
})->name('api.fallback');