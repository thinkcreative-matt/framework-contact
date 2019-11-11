<?php 

namespace Thinkcreative\Contact;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Str;

// use Collective\Html\FormFacade;

class ContactForm extends Model
{

	/**
	 * Set the default blog post table to be `blog`
	 * @var string
	 */
	protected $table = 'contact_form';

	protected $fillable = [];


	public function getFormattedValuesAttribute($value)
	{

		$name = $this->attributes['name'];
		$value = json_decode($this->attributes['value']);

		if(strpos($value, ',') !== false)
		{
			//  We have an arrray, lets make a side assoc so we can pass it to Form::xxx($values);
			 $array = [];
			
			$new = collect(explode(',', $value))->map(function ($item, $value) use (&$array) {
				$key = str_replace(' ', '_', $item);
				
				$array[$key] = $item;
				
				return true;				
			});

			return json_encode($array);
		}

		return json_encode($value);

	}

	public function form() 
	{
		return $this->hasMany('Thinkcreative\\Contact\\ContactForm');
	}

}