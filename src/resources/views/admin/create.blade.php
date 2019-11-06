{{--@extends('tcadmin::layout') --}}
@extends('admin.layout')

@section('content')
	<div class="contact-container container">
		<h1>Create New Contact Information </h1>

		@if ($errors->any())
		    <div class="alert alert-danger">
		        <ul>
		        	<h4>Fix the errors below</h4>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif

		{{ Form::model($contact, ['route' => [ 'admin.contact.store' ], 'method' => 'POST', 'class' => 'needs-validation']) }}
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
					<div class="form-check">
						{{ Form::checkbox('showform', $contact->show, NULL , ['class' => 'form-check-input']) }}
						{{ Form::label('showform', 'Show form on page', ['class' => 'form-check-label']) }}
					</div>
				</div>

				<div class="form-group">
					{{ Form::submit('Create Contact Information', ['class' => 'btn btn-success']) }}
					<a href="{{route('admin.contact.index')}}" class="btn btn-secondary">Back</a>
				</div>
			</div>
		{{ Form::close() }}

	</div>
@endsection
