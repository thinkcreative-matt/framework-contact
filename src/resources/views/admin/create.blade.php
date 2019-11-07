{{--@extends('tcadmin::layout') --}}
@extends('admin.layout')

@section('subnav')
	@include('admin-contact::components.subnav')
@endsection

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

			@include('admin-contact::components.form')
			
		{{ Form::close() }}

	</div>
@endsection
