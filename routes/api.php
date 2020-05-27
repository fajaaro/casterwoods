<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::name('api.')->namespace('Api')->group(function() {
	Route::post('/login', 'LoginController@login')->name('login');
	Route::post('/register', 'RegisterController@register')->name('register');

	Route::get('/isAdmin/{api_token}', 'ValidationController@validateAPIToken')->name('checkIsAdmin');

	Route::get('/checkKey/{order_key}', 'TransactionController@checkIfKeyExist')->name('transactions.checkKey');

	Route::get('/categories', 'CategoryController@index')->name('categories.index');
	Route::post('/categories', 'CategoryController@store')->name('categories.store');
	Route::get('/categories/{category}', 'CategoryController@show')->name('categories.show');

	Route::get('/couriers', 'CourierController@index')->name('couriers.index');
	
	Route::apiResource('boxes', 'BoxController');

	Route::apiResource('items', 'ItemController');

	Route::apiResource('cards', 'CardController');

	Route::apiResource('transactions', 'TransactionController')->except(['update']);

	Route::get('/transactions/{transaction}/successAction', 'TransactionController@transactionSuccessAction')->name('transactions.successAction');
	Route::get('/transactions/{transaction}/failedAction', 'TransactionController@transactionFailedAction')->name('transactions.failedAction');

	Route::get('/premadeBoxCategories', 'PremadeBoxCategoryController@index')->name('premadeBoxCategories.index');
	Route::post('/premadeBoxCategories', 'PremadeBoxCategoryController@store')->name('premadeBoxCategories.store');
	Route::get('/premadeBoxCategories/{premade_box_category}', 'PremadeBoxCategoryController@show')->name('premadeBoxCategories.show');

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