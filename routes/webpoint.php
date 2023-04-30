<?php
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => '/webpoint',
    'namespace' => 'webpoint', 'as' => 'api.',
    'middleware' => 'decrypt-key'
], function () {

    Route::get('get-contacts', 'ContactController@getContactList');
    Route::post('add-contact', 'ContactController@addContact');
    Route::post('edit-contact', 'ContactController@editContact');
    Route::delete('delete-contact', 'ContactController@deleteContact');
});