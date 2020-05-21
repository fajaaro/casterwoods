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
});

Route::fallback(function() {
 	return response()->json([
 		'status' => 'Failed!',
 		'message' => 'Not found.',
 	], 404);
})->name('api.fallback');