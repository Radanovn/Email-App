<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'ContactController@index')->name('home');

// Contacts
Route::delete('/contacts/delete-multiple', 'ContactController@destroyMultiple')->name('contacts.delete-multiple');
Route::post('/contacts/import', 'ContactController@import')->name('contacts.import');
Route::resource('contacts', 'ContactController');

// Groups
Route::delete('/groups/delete-multiple', 'GroupController@destroyMultiple')->name('groups.delete-multiple');
Route::post('/groups/add-contacts', 'GroupController@addContacts')->name('groups.add-contacts');
Route::resource('groups', 'GroupController');
Route::get('/groups/{group}/contacts', 'GroupController@getContacts')->name('groups.get-contacts');

// Campaigns
Route::resource('campaigns', 'CampaignController');
