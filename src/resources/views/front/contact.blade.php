<div class="contact-container container">
	<div class="post card" itemscope itemtype="http://schema.org/Organization">
		<h2 class="post-title card-title">Contact Details</h2>
		<div class="post-body card-body">
			

			<h3><span itemprop="name">{{$contact->companyname}}</span></h3>
			<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
				<h4 class="description">Main address:</h4>
				<hr>
				<span itemprop="streetAddress" class="street-name">{{$contact->address['streetname']}}</span>
				@empty($contact->address['optionalstreet'])
				@else
					<span class="street-name">{{$contact->address['optionalstreet']}}</span>
				@endif
				<span itemprop="addressLocality" class="localilty">{{$contact->address['locality'] }}</span>
				<span itemprop="postalCode" class="post-code">{{$contact->address['postcode']}}</span>
			</div>

			<ul>
				@if($contact->number)
				<li>Tel:<span itemprop="telephone">{{$contact->number}}</span></li>
				@endif
				
				@if($contact->email)
				<li>E-mail: <span itemprop="email">{{$contact->email}}</span></li>
				@endif
			</ul>
		</div>
	</div>
	@if($contact->showform)
		{{ Form::model($contact, ['route' => [ 'contact.savemessage'], 'method' => 'POST', 'class' => 'needs-validation']) }}
			@foreach($contact->form as $field)

			<div class="form-group">
				{{Form::label(Str::snake($field->name), ucwords($field->name), ['class' => 'form-control'])}}
				@if($field->field == 'select' )
                    {{ Form::{ucwords($field->field)} (Str::snake($field->name), json_decode($field->formatted_values), null, ['class' => 'form-control']) }}
                @else
                    {{ Form::{ucwords($field->field)} (Str::snake($field->name), json_decode($field->formatted_values),  ['class' => 'form-control']) }}
                @endif
			</div>
            @endforeach

            {{Form::submit('Send Message', ['class' => 'btn btn-primary'])}}
		{{Form::close()}}
	@endif
</div>
