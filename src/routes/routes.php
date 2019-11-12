<?php 
/**
 * Admin routes
 */

// Ensure we are using the Contact we want to. 
// We will eventually lock this down to 'admin user'
Route::group(['namespace' => 'Thinkcreative\Contact\Admin\Controllers', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'web'], function() {

	// Get the blog posts. We dont need to do anything else here. 
    Route::resource('contact', 'ContactController', ['except' => ['show'] ]);
    
    Route::resource('contact/form', 'ContactFormController', ['as'=>'contact', 'except' => ['show', 'index']]);

    Route::get('contact/messages', 'ContactMessagesController@index')->name('contact.messages.index');
    Route::get('contact/messages/{id}', 'ContactMessagesController@show')->name('contact.messages.show');

});

//  Ensure we are using the blog we want to. 
Route::group(['namespace' => 'Thinkcreative\Contact\Controllers'], function() {

	// Get the contact posts. We dont need to do anything else here. 
    Route::get('contact', 'ContactController@index')->name('contact');

    Route::post('contact', 'ContactController@saveMessage')->name('contact.savemessage');

});


