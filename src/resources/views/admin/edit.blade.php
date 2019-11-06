{{-- @extends('tcadmin::layout') --}}
@extends('admin.layout')

@section('content')
	<div class="blog-container container">
		<h1>Edit blog post</h1>

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

		{{ Form::model($post, ['route' => [ 'admin.blog.update', $post->slug ], 'method' => 'PUT' ]) }}	
			<div class="form-group">
				{{ Form::label('title', 'Title') }}
				{{ Form::text('title', $post->title, ['class' => 'form-control']) }}
			</div>
			<div class="form-group">
				{{ Form::label('slug', 'Slug') }}
				{{ Form::text('slug', $post->slug, ['class' => 'form-control']) }}
			</div>
			<div class="form-group">
				{{ Form::label('intro', 'Intro') }}
				{{ Form::textarea('intro', $post->intro, ['class' => 'form-control']) }}
			</div>
			<div class="form-group">
				{{ Form::label('body', 'Body') }}
				{{ Form::textarea('body', $post->body, ['class' => 'form-control']) }}
			</div>
			<div class="form-group">
				{{ Form::label('status', 'Status') }}
				{{ Form::select('status', [ 'draft' => 'Draft', 'published' => 'Published', 'unpublished' => 'Unpublished' ], null, ['class' => 'form-control' , 'placeholder' => 'Pick a Status...']) }}
			</div>
			<div class="form-group">
				{{ Form::submit('Update Post', ['class' => 'btn btn-warning']) }}
				<a href="{{route('admin.blog.index')}}" class="btn btn-secondary">Back</a>
			</div>
		{{ Form::close() }}
	</div>
@endsection