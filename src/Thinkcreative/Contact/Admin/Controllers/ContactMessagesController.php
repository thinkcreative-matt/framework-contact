<?php 

namespace Thinkcreative\Contact\Admin\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

use Thinkcreative\Contact\ContactMessage;

class ContactMessagesController extends Controller
{
	public function index()
	{
		$unread = ContactMessage::unread()->get();
		$read = ContactMessage::read()->get();

		return view('admin-contact::messages.index', compact('unread', 'read'));
	}

	public function show($id)
	{
		$message = ContactMessage::findOrFail($id);
		$now = Carbon::now();
		

		try {

			$message->read_at =  $now;

			$message->save();

		} catch(QueryException $e) {
			Log::error('Update Read At -- ' . $e);
            flash('Something went wrong. Please try again')->error();

            return redirect()->back();
		}

		return view('admin-contact::messages.show', compact('message'));

	}

}