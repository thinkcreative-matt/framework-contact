<?php 
/**
 * Admin routes
 */

// Ensure we are using the Contact we want to. 
// We will eventually lock this down to 'admin user'
Route::group(['namespace' => 'Thinkcreative\Contact\Admin\Controllers', 'prefix' => 'admin',  'as' => 'admin.', 'middleware' => 'web'], function() {

	// Get the blog posts. We dont need to do anything else here. 
    Route::resource('contact', 'ContactController');
    Route::resource('contact/form', 'ContactFormController');

});

//  Ensure we are using the blog we want to. 
Route::group(['namespace' => 'Thinkcreative\Contact\Controllers'], function() {

	// Get the contact posts. We dont need to do anything else here. 
    Route::get('contact', 'ContactController@index')->name('contact');

});


