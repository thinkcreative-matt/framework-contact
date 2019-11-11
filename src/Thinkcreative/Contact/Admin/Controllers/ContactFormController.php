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

        // send back the results
        return view('admin-contact::form.create', [
            'form' => new ContactForm
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        dd('contact form show');

        $contact = Contact::where('id', $id)->first();
        return view('admin-contact::show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dd('contact form edit');

        $contact = Contact::where('id', $id)->first();

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
    public function update(Request $request, $slug)
    {
        dd('contact form update');
        // @todo: validate request
        
        $contact = new Contact;
        $contact->address = $request->address;
        $contact->intro = $request->number;
        $contact->body  = $request->email;

        try {

            $post->save();
            Log::debug("{$request->title} updated");
            flash("Post, {$request->title}, updated")->success(); 

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
        dd('contact form destroy');

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
