{{-- @extends('tcadmin::layout') --}}
@extends('admin.layout')

@section('subnav')
	@include('admin-contact::components.subnav')
@endsection

@section('content')
    <div class="admin-container container contact">
		<h1>Edit Contact Information</h1>

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

		{{ Form::model($contact, ['route' => [ 'admin.contact.update', $contact->id ], 'method' => 'PUT', 'class' => 'needs-validation']) }}

			@include('admin-contact::components.form')

			<div class="form-group">
				{{ Form::submit('Update Contact Information', ['class' => 'btn btn-warning']) }}
				<a href="{{route('admin.contact.index')}}" class="btn btn-secondary">Back</a>
			</div>
			
		{{ Form::close() }}
	</div>
@endsection