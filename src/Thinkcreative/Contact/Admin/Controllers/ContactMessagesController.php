<?php 

namespace Thinkcreative\Contact\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;




use Thinkcreative\Contact\ContactMessage;


use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

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
		
	}

}