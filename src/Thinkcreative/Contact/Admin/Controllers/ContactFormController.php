<?php 

namespace Thinkcreative\Contact\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use Thinkcreative\Contact\Contact;
use Thinkcreative\Contact\ContactForm;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class ContactFormController extends Controller
{
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $info = ContactForm::all();

        //  If we already have some, we just need to update what we have.
        if( is_null($info) ) {
            $whereTo = 'admin-contact::form.create';
            $info = new Contact;
        } else {
            $whereTo = 'admin-contact::form.edit';
        }
        
        // send back the results
        return view($whereTo, [
            'form' => $info,
            'contactform' => Contact::first()
        ]);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   

        // @todo: validate request

        // Get the form to associate the fields with.
        $parent = Contact::first();
        //  Check to see how many fields were posted. 
        $count = count($request->field);
        // make sure we have an equal amount in all columns ['field', 'value', 'name']
        if($count !== count($request->value) || $count !== count($request->name) ) 
        {
            flash('We have uneven amounts of data. Try again please.')->error();
            return redirect()->back();
        }

        try {

            foreach($request->field as $index => $fieldValue)
            {
                if(is_null($request->field))
                    continue;

                $field = new ContactForm;
                $field->contact_id = $parent->id;
                $field->field = $fieldValue;
                $field->value = json_encode($request->value[$index]);
                $field->name = $request->name[$index];
                $field->save();

            }

            Log::debug("Contact Form Created");
            flash("Contact Form Created")->success(); 

        } catch(QueryException $e) {
            Log::error('Create Contact Form -- ' . $e);
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

        if(is_null($contact)) 
        {
            // bail, contact information isn't there. 
            abort(404, 'weird... This contact information and form isn\'t available.');
        }

        $info = ContactForm::where('contact_id', $id)->get();

        return view('admin-contact::form.edit', [
            'form' => $info,
            'contactform' => $contact
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        // @todo: validate request
        
        //  Check to see how many fields were posted. 
        $count = count($request->field);
        // make sure we have an equal amount in all columns ['field', 'value', 'name']
        if($count !== count($request->value) || $count !== count($request->name) ) 
        {
            flash('We have uneven amounts of data. Try again please.')->error();
            return redirect()->back();
        }

        try {

            //  Lets remove all the previous fields ready to create new ones. 
            ContactForm::where('contact_id', $id)->delete();

            foreach($request->field as $index => $fieldValue)
            {   
                if(is_null($request->field))
                    continue;

                $field = new ContactForm;
                $field->contact_id = $id;
                $field->field = $fieldValue;
                $field->value = json_encode($request->value[$index]);
                $field->name = $request->name[$index];
                $field->save();

            }

            Log::debug("Contact Form Updated");
            flash("Contact Form Updates")->success(); 

        } catch(QueryException $e) {
            Log::error('Update Contact Form -- ' . $e);
            flash('Something went wrong. Please try again')->error();
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
        // dd('contact form destroy');
        // $contact = Contact::find($id)->firstOrFail();
        // try {
        //     $contact->delete();
        //     Log::debug("Contact Information deleted");
        //     flash("Contact Information deleted")->error(); 
        // } catch(QueryException $e) {
        //     Log::error('Contact Information Deleted -- ' . $e);
        //     flash("Something went wrong. Please try again")->warning();
        // }
        // return redirect()->route('admin.contact.index');
        
    }
}
