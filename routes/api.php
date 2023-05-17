<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestcountriesController;

Route::prefix('INAR')->group(function () {
    Route::get('/restcountries', 'RestcountriesController@index');
    Route::get('/restcountries/{countryCode}', 'RestcountriesController@show');
    Route::put('/restcountries/{countryCode}', 'RestcountriesController@update');
    Route::post('/restcountries', 'RestcountriesController@store');
    Route::get('/imdb', 'IMDbController@index');
    Route::get('/imdb/{movieId}', 'IMDbController@show');
    Route::put('/imdb/{movieId}', 'IMDbController@update');
    Route::post('/imdb', 'IMDbController@store');
});
