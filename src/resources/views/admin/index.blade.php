{{-- @extends('tcadmin::layout') --}}
@extends('admin.layout')

@section('subnav')
    <a class="btn btn-light" href="{{route('admin')}}" role="button">Back To Dashboard</a>
@endsection

@section('content')

    <div class="admin-container container contact">
        <h1>Contact Administration</h1>
        <div class="row h-100 py-5">
            @empty($contact)
                <div class="col-md-12 justify-content-center align-items-center h-100 d-flex flex-column">
                    <p class="align-self-center">No contact information is set</p>
                    <a class="btn btn-success" href="{{route('admin.contact.create')}}" role="button">Create New Contact Information</a>
                </div>
            @else
                <div class="col-md-4 border-right">
                    <div class="card" >
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="m-0">Contact Information</h5>
                            <a href="{{route('admin.contact.destroy', $contact->id)}}" class="btn btn-danger">delete</a>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{$contact->companyname}}</h5>
                            <span class="badge badge-info">
                                {{($contact->showform ? 'Show ' : 'Do not show ')}}the form on front page
                            </span>
                        </div>
                        <div class="card-body">
                            @forelse(json_decode($contact->address) as $name => $value)
                                @if($value)
                                    <p>{{ucwords($name)}}: {{$value}}</p>
                                @endif
                            @empty
                            @endforelse
                        </div>
                        <ul class="list-group list-group-flush">
                            @if( empty($contact->email) && empty($contact->number) && empty($contact->direction) )
                                <li class="list-group-item">No information set</li>
                            @endif

                            @if($contact->email)
                                <li class="list-group-item">Email: {{$contact->email}}</li>
                            @endif
                            @if($contact->number)
                                <li class="list-group-item">Tel: {{$contact->number}}</li>
                            @endif
                            @if($contact->direction)
                                <li class="list-group-item">Direction: {{$contact->direction}}</li>
                            @endif
                        </ul>
                        <div class="card-body">
                            <a href="{{route('admin.contact.edit', $contact->id)}}" class="btn btn-dark">edit</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    @empty($contactForm)
                        <div class="col-md-12 justify-content-center align-items-center h-100 d-flex flex-column">
                            <p class="align-self-center">No Form made</p>
                            <a class="btn btn-success" href="{{route('admin.contact.form.create')}}" role="button">Create New Form</a>
                        </div>
                    @else
                        
                    @endif
                </div>
            @endif
        </div>
    </div>
@endsection
