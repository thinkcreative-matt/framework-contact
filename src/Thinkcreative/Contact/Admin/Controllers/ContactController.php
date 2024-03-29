<?php 

namespace Thinkcreative\Contact\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;



use Thinkcreative\Contact\Contact;
use Thinkcreative\Contact\ContactMessage;
use Thinkcreative\Contact\Http\Requests\StoreContact;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $unread = ContactMessage::unread()->count();
        
        //  Do nothing and send back the results
        return view('admin-contact::index', [
            'contact' => Contact::with('form')->first(),
            'unread' => $unread
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $info = Contact::first();

        //  If we already have some, we just need to update what we have.
        if( is_null($info) ) {
            $whereTo = 'admin-contact::create';
            $info = new Contact;
        } else {
            $whereTo = 'admin-contact::edit';
        }

        // send back the results
        return view($whereTo, [
            'contact' => $info
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContact $request)
    {   
         
        $contact = new Contact;
        $contact->companyname = $request->companyname;
        $contact->address = json_encode($request->address);
        $contact->number = $request->number;
        $contact->email  = $request->email;
        $contact->showform = ($request->showform == 'on' ? 1 : 0 );
        $contact->direction = $request->direction;

        try {

            $contact->save();
            Log::debug("Contact Information Created");
            flash("Contact Information Created")->success(); 

        } catch(QueryException $e) {
            Log::error('Create Contact -- ' . $e);
            flash('Something went wrong. Please try again')->error();
        }

        return redirect()->route('admin.contact.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contact = Contact::where('id', $id)->first();
        
        // convert the address details - Now on model
        $contact->address = $contact->address;

        if(is_null($contact)) 
        {
            // bail, contact information isn't there. 
            abort(404, 'weird... This contact information isn\'t available.');
        }
        
        return view('admin-contact::edit', [
            'contact' => $contact
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreContact $request, $id)
    {

        
        $contact = Contact::where('id', $id)->first();

        $contact->companyname = $request->companyname;
        $contact->address = json_encode($request->address);
        $contact->number = $request->number;
        $contact->email  = $request->email;
        $contact->showform = ($request->showform == 'on' ? 1 : 0 );
        $contact->direction = $request->direction;

        try {

            $contact->save();
            Log::debug("contact information updated");
            flash("Contact Information updated")->success(); 

        } catch(QueryException $e) {
            Log::error('Update Blog -- ' . $e);
            flash("Something went wrong. Please try again")->danger();
        }

        return redirect()->route('admin.contact.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Contact::find($id)->firstOrFail();

        try {

            $contact->delete();
            Log::debug("Contact Information deleted");
            flash("Contact Information deleted")->error(); 

        } catch(QueryException $e) {
            Log::error('Contact Information Deleted -- ' . $e);
            flash("Something went wrong. Please try again")->warning();
        }

        return redirect()->route('admin.contact.index');
        
    }
}
