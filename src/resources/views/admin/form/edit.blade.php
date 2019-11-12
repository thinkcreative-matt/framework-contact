{{--@extends('tcadmin::layout') --}}
@extends('admin.layout')

@section('subnav')
	@include('admin-contact::components.subnav')
@endsection

@section('content')
	<div class="admin-container contact-container container">
		<h1>Create New Contact Form</h1>

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

		<hr>

		{{ Form::model($form, ['route' => [ 'admin.contact.form.update', $contactform->id ], 'method' => 'PUT', 'class' => 'needs-validation', ]) }}
			<div id="createFieldsFormRow">

				<div class="form-row">
					
					@foreach($form as $field)
					
						<div class="form-group col-md-3">
							{{ Form::label('name[]', 'Field Name') }}
							{{ Form::text('name[]', $field->name, ['class' => 'form-control']) }}
						</div>
						<div class="form-group col-md-4">
							{{ Form::label('field[]', 'Field Type') }}
							{{ Form::select('field[]', [ 
								'select' => 'Select (Comma seperate values)', 
								'text' => 'Textbox',
								'textaea' => 'Textarea',
								'checkbox' => 'Checkbox',
								'file' => 'File Upload',
								'email' => 'Email',
								'date' => 'Date'
								], $field->field, ['class' => 'form-control' , 'placeholder' => 'Pick a type...']) }}
						</div>
						<div class="form-group col-md-3">
							{{ Form::label('value[]', 'Field Value') }}
							{{ Form::text('value[]', json_decode($field->value), ['class' => 'form-control ']) }}
						</div>
						<div class="form-group col-md-2 addDeleteBtn d-flex">
							<a class="btn btn-danger deleteRow-createFieldsForm text-light align-self-end">delete</a>
						</div>
					@endforeach

				</div>

				<div class="form-row" id="duplicate-row">
					<div class="form-group col-md-3">
						{{ Form::label('name[]', 'Field Name') }}
						{{ Form::text('name[]', '', ['class' => 'form-control']) }}
					</div>
					<div class="form-group col-md-4">
						{{ Form::label('field[]', 'Field Type') }}
						{{ Form::select('field[]', [ 
							'select' => 'Select (Comma seperate values)', 
							'text' => 'Textbox',
							'textarea' => 'Textarea',
							'checkbox' => 'Checkbox',
							'file' => 'File Upload',
							'email' => 'Email',
							'date' => 'Date'
							], null, ['class' => 'form-control' , 'placeholder' => 'Pick a type...']) }}
					</div>
					<div class="form-group col-md-3">
						{{ Form::label('value[]', 'Field Value') }}
						{{ Form::text('value[]', '', ['class' => 'form-control ']) }}
					</div>
					<div class="form-group col-md-2 addDeleteBtn d-flex">
						<a class="btn btn-danger deleteRow-createFieldsForm text-light align-self-end">delete</a>
					</div>
				</div>
				
			</div>

			<div class="form-row">
				<div class="col-md-12">
					<a href="#" class="btn btn-outline-dark" id="createNew-FormRow_Admin"><i class="fa fa-plus"></i> Add New Row</a>
				</div>
			</div>
			<hr>
			<div class="form-row">
				<div class="form-group col-md-12">
					{{ Form::submit('Update Contact Form', ['class' => 'btn btn-warning']) }}
					<a href="{{route('admin.contact.index')}}" class="btn btn-secondary">Back</a>
				</div>
			</div>
			
		{{ Form::close() }}

	</div>
	<script>
	(function() {
		'use strict';

		function cleanFields(fields) {
			fields.childNodes.forEach(node => {
				//  If we do not have a child return
				if(node.children === undefined)
					return;

				if(node.children[1] !== undefined)
					node.children[1].value = '';

				// clear out any messages that are present
				if(node.classList.contains('alert')) {
					node.remove();
				}
				
			});

			return fields;
		}

		function deleteBtn_Click() {
			let all = document.querySelectorAll('.deleteRow-createFieldsForm ');
			if(all.length <= 1) {
				//  cant be deleted
				let container =  document.querySelector('.contact-container');
 				//  create message
				let message = document.createElement('div');
            		message.className = 'alert alert-danger alert-dismissable';
            		message.innerHTML = 'Can\'t be deleted - Must have one field row';

            	//  add a message to the parents' parent. 
				this.parentNode.parentNode.appendChild(message);
				return false;
			}

			this.parentNode.parentNode.remove();

		}

		const createNewFormRow 	= document.getElementById('createNew-FormRow_Admin');
		const duplicateRow 		= document.getElementById('duplicate-row');
		const deleteBtn 		= document.querySelector('.deleteRow-createFieldsForm ');
		

		deleteBtn.addEventListener('click', deleteBtn_Click);


		createNewFormRow.addEventListener('click', function() {

			let clone 	= duplicateRow.cloneNode(true);
			let form 	= document.getElementById('createFieldsFormRow');
			let cleaned = cleanFields(clone);

			cleaned.querySelector('.deleteRow-createFieldsForm').addEventListener('click', deleteBtn_Click);
			form.appendChild(cleaned);

		});

	})();
	</script>

@endsection
