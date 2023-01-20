<?php

use Illuminate\Support\Facades\Route;

Route::prefix('api')->group(function () {
    Route::get('/events', 'EventsController@index')->name('events.index');
    Route::get('/events/{id}', 'EventsController@show')->name('events.show');
    Route::get('/event-types', 'EventsController@eventTypes')->name('eventTypes');
    Route::get('/stats', 'DashboardStatsController@index')->name('stats.index');
});
Route::get('/{view?}', 'EventViewerController@index')
    ->where('view', '(.*)')->name('index');
