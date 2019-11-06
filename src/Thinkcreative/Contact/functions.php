<?php 

if(! function_exists('contact')) {
	// Aloow people to just call all the defaults for the blog. 
	function contact() 
	{
		// Load up a new instance of  
		// whatever your alias is. 
		$contact = app('contact');

		$contact->first();

	}
}