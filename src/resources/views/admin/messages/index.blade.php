{{-- @extends('tcadmin::layout') --}}
@extends('admin.layout')

@section('subnav')
    <a class="btn btn-light" href="{{route('admin')}}" role="button">Back To Dashboard</a>
@endsection

@section('content')
	<div class="admin-container container message">
		<h1>View All Messages</h1>
		<hr>
		<h2>Unread</h2>
			<table class="table table-sm">
				<thead>
					<th>id</th>
					<th>snippet</th>
					<th>created</th>
					<th></th>
				</thead>
				<tbody>
					@forelse($unread as $message)
					
						<tr>
							<td>{{$message->id}}</td>
							<td>{{$message->snippet}}</td>
							<td>{{$message->created_at->format('d-m-Y')}}</td>
							<td>
								<div class="btn-group btn-group-sm" role="group" aria-label="Password Actions">
		                            <a class="btn btn-dark text-light btn-sm" href="{{ route('admin.contact.messages.show', $message->id) }}">
		                                <i class="text-dark fa-pencil"></i>
		                                view
		                            </a>
		                            
		                        </div>
							</td>
						</tr>
					@empty
		                <tr>
		                    <td colspan="2">No unread messages available to show</td>
		                </tr>
		            @endif
				</tbody>
			</table>
		<hr>

		<h2>Read</h2>

		<table class="table table-sm">
				<thead>
					<th>id</th>
					<th>snippet</th>
					<th>read</th>
					<th>created</th>
					<th></th>
				</thead>
				<tbody>
					@forelse($read as $message)
						<tr>
							<td>{{$message->id}}</td>
							<td>{{$message->snippet}}</td>
							<td>{{$message->created_at->diffForHumans()}}</td>
							<td>{{$message->created_at->format('d-m-Y')}}</td>
							<td>
								<div class="btn-group btn-group-sm" role="group" aria-label="Password Actions">
		                            <a class="btn btn-dark text-light btn-sm" href="{{ route('admin.contact.messages.show', $message->id) }}">
		                                <i class="text-dark fa-pencil"></i>
		                                view
		                            </a>
		                            
		                        </div>
							</td>
						</tr>
					@empty
		                <tr>
		                    <td colspan="2">No read messages</td>
		                </tr>
	           		@endif
				</tbody>
			</table>

	</div>


@endsection