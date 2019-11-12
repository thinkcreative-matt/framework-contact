{{-- @extends('tcadmin::layout') --}}
@extends('admin.layout')

@section('subnav')
    @include('admin-blog::components.subnav')
@endsection

@section('content')
<div class="message-container container">
	
	<h1>View Message</h1>

	<hr>
	
	<div class="message card">
		<ul class="list-group list-group-flush">
			@foreach($message->info as $key => $value)
				<li class="list-group-item">{{Str::title(str_replace('_', ' ', $key))}}: {{$value}}</li>
			@endforeach
		</ul>		

		<div class="post-footer card-footer">
			<a href="{{route('admin.contact.messages.index')}}" class="btn btn-secondary">Back</a>
		</div>	
	</div>
	

</div>
@endsection
