<?php 

namespace Thinkcreative\Contact\Controllers;

use App\Http\Controllers\Controller;
use Thinkcreative\Contact\Contact;


class ContactController extends Controller {


    /**
     * We only need to disply the Contact Information
     * @return [Array] [return a collection of contact information]
     */
    public function index() 
    {
        //  Return 404 if we dont have a contact us page. 
    	$contact = Contact::firstOrFail();

        return view('contact::contact', [
        	'contact' => $contact
        ]);

    }

}