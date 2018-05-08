<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Colors
Route::get('/colors', 'ColorController@index');
Route::post('/colors', 'ColorController@create');
Route::get('/colors/{color}/edit', 'ColorController@edit');
Route::put('/colors/{color}', 'ColorController@update');
Route::get('/colors/{search}/search', 'ColorController@search');

// Crossings
Route::get('/crossings', 'CrossingController@index');
Route::post('/crossings', 'CrossingController@create');
Route::get('/crossings/{crossing}/edit', 'CrossingController@edit');
Route::put('/crossings/{crossing}', 'CrossingController@update');
Route::get('/crossings/{search}/search', 'CrossingController@search');

// Groups
Route::get('/groups', 'GroupController@index');
Route::post('/groups', 'GroupController@create');
Route::get('/groups/{group}/edit', 'GroupController@edit');
Route::put('/groups/{group}', 'GroupController@update');
Route::get('/groups/{search}/search', 'GroupController@search');

// Months
Route::get('/months', 'MonthController@index');
Route::post('/months', 'MonthController@create');
Route::get('/months/{month}/edit', 'MonthController@edit');
Route::put('/months/{month}', 'MonthController@update');
Route::get('/months/{search}/search', 'MonthController@search');

// Plants
Route::get('/plants', 'PlantController@index');
Route::post('/plants', 'PlantController@create');
Route::get('/plants/{plant}/edit', 'PlantController@edit');
Route::put('/plants/{plant}', 'PlantController@update');
Route::get('/plants/{search}/search', 'PlantController@search');

// Priorities
Route::get('/priorities', 'PriorityController@index');
Route::post('/priorities', 'PriorityController@create');
Route::get('/priorities/{priority}/edit', 'PriorityController@edit');
Route::put('/priorities/{priority}', 'PriorityController@update');
Route::get('/priorities/{search}/search', 'PriorityController@search');

// Sexes
Route::get('/sexes', 'SexController@index');
Route::post('/sexes', 'SexController@create');
Route::get('/sexes/{sex}/edit', 'SexController@edit');
Route::put('/sexes/{sex}', 'SexController@update');
Route::get('/sexes/{search}/search', 'SexController@search');

// Sizes
Route::get('/sizes', 'SizeController@index');
Route::post('/sizes', 'SizeController@create');
Route::get('/sizes/{size}/edit', 'SizeController@edit');
Route::put('/sizes/{size}', 'SizeController@update');
Route::get('/sizes/{search}/search', 'SizeController@search');

// Species
Route::get('/species', 'SpecieController@index');
Route::post('/species', 'SpecieController@create');
Route::get('/species/{specie}/edit', 'SpecieController@edit');
Route::put('/species/{specie}', 'SpecieController@update');
Route::get('/species/{search}/search', 'SpecieController@search');

// Suppliers
Route::get('/suppliers', 'SupplierController@index');
Route::post('/suppliers', 'SupplierController@create');
Route::get('/suppliers/{supplier}/edit', 'SupplierController@edit');
Route::put('/suppliers/{supplier}', 'SupplierController@update');
Route::get('/suppliers/{search}/search', 'SupplierController@search');

// Synonyms
Route::get('/synonyms', 'SynonymController@index');
Route::post('/synonyms', 'SynonymController@create');
Route::get('/synonyms/{synonym}/edit', 'SynonymController@edit');
Route::put('/synonyms/{synonym}', 'SynonymController@update');
Route::get('/synonyms/{search}/search', 'SynonymController@search');

// Treetypes
Route::get('/treetypes', 'TreetypeController@index');
Route::post('/treetypes', 'TreetypeController@create');
Route::get('/treetypes/{treetype}/edit', 'TreetypeController@edit');
Route::put('/treetypes/{treetype}', 'TreetypeController@update');
Route::get('/treetypes/{search}/search', 'TreetypeController@search');

// Types
Route::get('/types', 'TypeController@index');
Route::post('/types', 'TypeController@create');
Route::get('/types/{type}/edit', 'TypeController@edit');
Route::put('/types/{type}', 'TypeController@update');
Route::get('/types/{search}/search', 'TypeController@search');

// Varieties
Route::get('/varieties', 'VarietyController@index');
Route::post('/varieties', 'VarietyController@create');
Route::get('/varieties/{variety}/edit', 'VarietyController@edit');
Route::put('/varieties/{variety}', 'VarietyController@update');
Route::get('/varieties/{search}/search', 'VarietyController@search');

// Winners
Route::get('/winners', 'WinnerController@index');
Route::post('/winners', 'WinnerController@create');
Route::get('/winners/{winner}/edit', 'WinnerController@edit');
Route::put('/winners/{winner}', 'WinnerController@update');
Route::get('/winners/{search}/search', 'WinnerController@search');