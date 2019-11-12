<?php 

namespace Thinkcreative\Contact\Controllers;

use App\Http\Controllers\Controller;
use Thinkcreative\Contact\Contact;
use Thinkcreative\Contact\ContactForm;
use Thinkcreative\Contact\ContactMessage;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;


class ContactController extends Controller {


    /**
     * We only need to disply the Contact Information
     * @return [Array] [return a collection of contact information]
     */
    public function index() 
    {
        //  Return 404 if we dont have a contact us page. 
        $contact = Contact::with('form')->firstOrFail();

        return view('contact::contact', [
            'contact' => $contact
        ]);

    }

    public function saveMessage(Request $request)
    {

        $information = collect($request->except('_token'))->toJSON();
        try {
            $message = new ContactMessage;
            $message->information = $information;
            $message->save();

            //  Notify someone of an emeil.... 

            Log::debug("New message sent");
            flash("Contact Form Created")->success();

        } catch (QueryException $e) {

            Log::error('New message created error -- ' . $e);
            flash('Something went wrong. Please try again')->error();

        }
        
        return redirect()->route('contact');

    }

}