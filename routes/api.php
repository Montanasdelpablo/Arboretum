<?php

Route::group( [ 'middleware' => 'auth:api' ], function()
{

});

// Unprotected routes here
Route::get( '/plants', 'PlantController@index' );

Route::post( '/login', 'UserController@login' );
Route::post( '/register', 'UserController@register' );
Route::post( '/forgotpassword', 'UserController@forgotpw' );

Route::get( '/logout', 'HomeController@logout' );

// Colors
Route::get( '/colors', 'ColorController@index' );
Route::post( '/colors', 'ColorController@store' );
Route::get( '/colors/{color}', 'ColorController@show' );
Route::get( '/colors/{color}/edit', 'ColorController@edit' );
Route::put( '/colors/{color}', 'ColorController@update' );
Route::get( '/colors/{search}/search', 'ColorController@search' );
Route::delete( '/colors/{color}', 'ColorController@destroy' );

// Crossings
Route::get( '/crossings', 'CrossingController@index' );
Route::post( '/crossings', 'CrossingController@store' );
Route::get( '/crossings/{crossing}', 'CrossingController@show' );
Route::get( '/crossings/{crossing}/edit', 'CrossingController@edit' );
Route::put( '/crossings/{crossing}', 'CrossingController@update' );
Route::get( '/crossings/{search}/search', 'CrossingController@search' );
Route::delete( '/colors/{color}', 'ColorController@destroy' );

// Groups
Route::get( '/groups', 'GroupController@index' );
Route::post( '/groups', 'GroupController@store' );
Route::get( '/groups/{group}', 'GroupController@show' );
Route::get( '/groups/{group}/edit', 'GroupController@edit' );
Route::put( '/groups/{group}', 'GroupController@update' );
Route::get( '/groups/{search}/search', 'GroupController@search' );
Route::delete( '/colors/{color}', 'ColorController@destroy' );

// Months
Route::get( '/months', 'MonthController@index' );
Route::post( '/months', 'MonthController@store' );
Route::get( '/months/{month}', 'MonthController@show' );
Route::get( '/months/{month}/edit', 'MonthController@edit' );
Route::put( '/months/{month}', 'MonthController@update' );
Route::get( '/months/{search}/search', 'MonthController@search' );
Route::delete( '/months/{month}', 'MonthController@destroy' );

// Plants
Route::post( '/plants', 'PlantController@store' );
Route::post( '/plants/import', 'PlantController@import' );
Route::get( '/plants/{plant}', 'PlantController@show' );
Route::get( '/plants/{plant}/edit', 'PlantController@edit' );
Route::put( '/plants/{plant}', 'PlantController@update' );
Route::get( '/plants/{search}/search', 'PlantController@search' );
Route::delete( '/plants/{plant}', 'PlantController@destroy' );

// Priorities
Route::get( '/priorities', 'PriorityController@index' );
Route::post( '/priorities', 'PriorityController@store' );
Route::get( '/priorities/{priority}', 'PriorityController@show' );
Route::get( '/priorities/{priority}/edit', 'PriorityController@edit' );
Route::put( '/priorities/{priority}', 'PriorityController@update' );
Route::get( '/priorities/{search}/search', 'PriorityController@search' );
Route::delete( '/priorities/{priority}', 'PriorityController@destroy' );

// Sexes
Route::get( '/sexes', 'SexController@index' );
Route::post( '/sexes', 'SexController@store' );
Route::get( '/sexes/{sex}', 'SexController@show' );
Route::get( '/sexes/{sex}/edit', 'SexController@edit' );
Route::put( '/sexes/{sex}', 'SexController@update' );
Route::get( '/sexes/{search}/search', 'SexController@search' );
Route::delete( '/sexes/{sex}', 'SexController@destroy' );

// Sizes
Route::get( '/sizes', 'SizeController@index' );
Route::post( '/sizes', 'SizeController@store' );
Route::get( '/sizes/{size}', 'SizeController@show' );
Route::get( '/sizes/{size}/edit', 'SizeController@edit' );
Route::put( '/sizes/{size}', 'SizeController@update' );
Route::get( '/sizes/{search}/search', 'SizeController@search' );
Route::delete( '/sizes/{size}', 'SizeController@destroy' );

// Species
Route::get( '/species', 'SpecieController@index' );
Route::post( '/species', 'SpecieController@store' );
Route::get( '/species/{specie}', 'SpecieController@show' );
Route::get( '/species/{specie}/edit', 'SpecieController@edit' );
Route::put( '/species/{specie}', 'SpecieController@update' );
Route::get( '/species/{search}/search', 'SpecieController@search' );
Route::delete( '/species/{specie}', 'SpecieController@destroy' );

// Suppliers
Route::get( '/suppliers', 'SupplierController@index' );
Route::post( '/suppliers', 'SupplierController@store' );
Route::get( '/suppliers/{supplier}', 'SupplierController@show' );
Route::get( '/suppliers/{supplier}/edit', 'SupplierController@edit' );
Route::put( '/suppliers/{supplier}', 'SupplierController@update' );
Route::get( '/suppliers/{search}/search', 'SupplierController@search' );
Route::delete( '/suppliers/{supplier}', 'SupplierController@destroy' );

// Synonyms
Route::get( '/synonyms', 'SynonymController@index' );
Route::post( '/synonyms', 'SynonymController@store' );
Route::get( '/synonyms/{synonym}', 'SynonymController@show' );
Route::get( '/synonyms/{synonym}/edit', 'SynonymController@edit' );
Route::put( '/synonyms/{synonym}', 'SynonymController@update' );
Route::get( '/synonyms/{search}/search', 'SynonymController@search' );
Route::delete( '/synonyms/{synonym}', 'SynonymController@destroy' );

// Treetypes
Route::get( '/treetypes', 'TreetypeController@index' );
Route::post( '/treetypes', 'TreetypeController@store' );
Route::get( '/treetypes/{treetype}', 'TreetypeController@show' );
Route::get( '/treetypes/{treetype}/edit', 'TreetypeController@edit' );
Route::put( '/treetypes/{treetype}', 'TreetypeController@update' );
Route::get( '/treetypes/{search}/search', 'TreetypeController@search' );
Route::delete( '/treetypes/{treetype}', 'TreetypeController@destroy' );

// Types
Route::get( '/types', 'TypeController@index' );
Route::post( '/types', 'TypeController@store' );
Route::get( '/types/{type}', 'TypeController@show' );
Route::get( '/types/{type}/edit', 'TypeController@edit' );
Route::put( '/types/{type}', 'TypeController@update' );
Route::get( '/types/{search}/search', 'TypeController@search' );
Route::delete( '/types/{type}', 'TypeController@destroy' );

// Subspecies
Route::get( '/subspecies', 'subspecieController@index' );
Route::post( '/subspecies', 'subspecieController@store' );
Route::get( '/subspecies/{subspecie}', 'subspecieController@show' );
Route::get( '/subspecies/{subspecie}/edit', 'subspecieController@edit' );
Route::put( '/subspecies/{subspecie}', 'subspecieController@update' );
Route::get( '/subspecies/{search}/search', 'subspecieController@search' );
Route::delete( '/subspecies/{subspecie}', 'subspecieController@destroy' );

// Winners
Route::get( '/winners', 'WinnerController@index' );
Route::post( '/winners', 'WinnerController@store' );
Route::get( '/winners/{winner}', 'WinnerController@show' );
Route::get( '/winners/{winner}/edit', 'WinnerController@edit' );
Route::put( '/winners/{winner}', 'WinnerController@update' );
Route::get( '/winners/{search}/search', 'WinnerController@search' );
Route::delete( '/winners/{winner}', 'WinnerController@destroy' );

// Names
Route::get( '/names', 'NameController@index' );
Route::post( '/names', 'NameController@store' );
Route::get( '/names/{name}', 'NameController@show' );
Route::get( '/names/{name}/edit', 'NameController@edit' );
Route::put( '/names/{name}', 'NameController@update' );
Route::get( '/names/{search}/search', 'NameController@search' );
Route::delete( '/names/{name}', 'NameController@destroy' );

// Users
Route::get( '/users', 'UserController@index' );
Route::post( '/users', 'UserController@store' );
Route::get( '/users/{user}', 'UserController@show' );
Route::get( '/users/{user}/edit', 'UserController@edit' );
Route::put( '/users/{user}', 'Userontroller@update' );
Route::get( '/users/{user}/search', 'UserController@search' );
Route::delete( '/users/{user}', 'UserController@destroy' );

// Test login
Route::get('/testlogin', 'UserController@testLogin');
