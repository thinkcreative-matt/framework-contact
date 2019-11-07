<?php 

namespace Thinkcreative\Contact;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Str;

class Contact extends Model
{

	/**
	 * Set the default blog post table to be `blog`
	 * @var string
	 */
	protected $table = 'contact';

	protected $fillable = [];

	protected $casts = [
		'showform' => 'boolean'
	];

	public function getAddressAttribute()
	{	
		if( !empty($this->attributes) ) {
			return collect(json_decode($this->attributes['address']));
			
		} else {
			return $this->attributes['address'] = '';
		}
	}

	public function form() 
	{
		return $this->hasMany('Thinkcreative\\Contact\\ContactForm');
	}

}