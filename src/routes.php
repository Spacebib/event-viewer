<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'EventViewerController@index')->name('index');
Route::get('/{aggregateId}', 'EventViewerController@show')->name('show');
