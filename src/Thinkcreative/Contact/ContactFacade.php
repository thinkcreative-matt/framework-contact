<?php 

namespace Thinkcreative\Contact;

use Illuminate\Suppoort\Facades\Facade;

class ContactFacade extends Facade
{

	protected static function getFacadeAccessor()
	{
		return 'contact';
	}

}
