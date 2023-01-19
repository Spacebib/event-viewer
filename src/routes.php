<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'EventViewerController@index')->name('index');
Route::get('/dashboard', 'EventViewerController@index')->name('dashboard');
Route::get('/events', 'EventViewerController@index')->name('events');
Route::get('/events/{id}', 'EventViewerController@show')->name('show');
Route::get('/event-stream/{aggregateId}', 'EventViewerController@index')->name('events');

Route::prefix('api')->group(function () {
    Route::get('/events', 'EventsController@index')->name('event-viewer.events.index');
    Route::get('/events/{id}', 'EventsController@show')->name('event-viewer.events.show');
    Route::get('/event-types', 'EventsController@eventTypes')->name('event-viewer.eventTypes');
    Route::get('/event-types', 'EventsController@eventTypes')->name('event-viewer.eventTypes');
    Route::get('/stats', 'DashboardStatsController@index')->name('event-viewer.stats.index');
});
