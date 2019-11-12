<?php 

namespace Thinkcreative\Contact;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Str;

use Thinkcreative\Contact\ContactForm;

// use Collective\Html\FormFacade;

class ContactMessage extends Model
{

	/**
	 * Set the default blog post table to be `blog`
	 * @var string
	 */
	protected $table = 'contact_messages';

	protected $fillable = [];

	protected $dates = ['read_at'];

	public function getSnippetAttribute($value)
	{

		$index = Str::snake(ContactForm::first()->name);
		
		return collect(json_decode($this->attributes['information']))->get($index);
		
	}

	public function scopeUnread($query)
	{
		return $query->whereNull('read_at');
	}

	public function scopeRead($query)
	{
		return $query->whereNotNull('read_at');
	}
	

}