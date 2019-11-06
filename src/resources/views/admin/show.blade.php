{{-- @extends('tcadmin::layout') --}}
@extends('admin.layout')

@section('content')
<div class="blog-container container">
	
	
	<div class="post card">
		<div class="post-body card-body">

			<h2 class="post-title card-title">{{$post->title}}</h2>
			<h4><small>{{ (!is_null($post->published_at) ? $post->published_at_date : '') }}</small></h4>

			<hr>

			<p><strong>Intro</strong></p>
			<p>{{$post->intro}}</p>

			<p><strong>Limited Body</strong></p>
			<p>{{$post->limited_body}}</p>

			<p><strong>Body</strong></p>
			<p>{{$post->body}}</p>
			
		</div>

		<div class="post-footer card-footer">
			<a href="{{route('admin.blog.index')}}" class="btn btn-secondary">Back</a>
		</div>	
	</div>
	

</div>
@endsection
