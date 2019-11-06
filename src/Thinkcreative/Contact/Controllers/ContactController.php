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

    	$contact = Contact::firstOrFail();

        return view('contact::contact', [
        	'contact' => $contact
        ]);

    }

}