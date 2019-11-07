<div class="form-row">
	<div class="form-group col-md-12">
		{{ Form::label('companyname', 'Company Name') }}
		{{ Form::text('companyname', $contact->companyname , ['class' => 'form-control', 'required' => 'required']) }}
		<div class="valid-feedback">Looks good!</div>
	</div>
</div>

<div class="form-row">
	<div class="form-group col-md-3">
		{{ Form::label('address[streetname]', 'Street Name') }}
		{{ Form::text('address[streetname]', $contact->address['streetname'], ['class' => 'form-control']) }}
	</div>
	<div class="form-group col-md-3">
		{{ Form::label('address[optionalstreet]', 'Optional Street Name') }}
		{{ Form::text('address[optionalstreet]', $contact->address['optionalstreet'], ['class' => 'form-control']) }}
	</div>
	<div class="form-group col-md-3">
		{{ Form::label('address[locality]', 'County') }}
		{{ Form::text('address[locality]', $contact->address['locality'], ['class' => 'form-control']) }}
	</div>
	<div class="form-group col-md-3">
		{{ Form::label('address[postcode]', 'Post Code') }}
		{{ Form::text('address[postcode]', $contact->address['postcode'], ['class' => 'form-control']) }}
	</div>
</div>
	
<div class="form-row">
	<div class="form-group col-md-4">
		{{ Form::label('number', 'Number') }}
		{{ Form::text('number', $contact->number, ['class' => 'form-control']) }}
	</div>
	<div class="form-group col-md-4">
		{{ Form::label('email', 'Email') }}
		{{ Form::text('email', $contact->email, ['class' => 'form-control ']) }}
	</div>

	<div class="form-group col-md-4">
		{{ Form::label('direction', 'Direction of Form') }}
		{{ Form::select('direction', [ 'horizontal' => 'Side-by-side', 'vertical' => 'Stacked', ], null, ['class' => 'form-control' , 'placeholder' => 'Pick a Direction...']) }}
	</div>

	<div class="form-group  col-md-12">
		<div class="custom-control custom-switch">
			{{ Form::checkbox('showform', $contact->show, NULL , ['class' => 'custom-control-input', 'id' => 'showform']) }}
			{{ Form::label('showform', 'Show form on page', ['class' => 'custom-control-label']) }}
		</div>
	</div>

	<div class="form-group">
		{{ Form::submit('Update Contact Information', ['class' => 'btn btn-warning']) }}
		<a href="{{route('admin.contact.index')}}" class="btn btn-secondary">Back</a>
	</div>
</div>