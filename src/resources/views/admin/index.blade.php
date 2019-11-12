{{-- @extends('tcadmin::layout') --}}
@extends('admin.layout')

@section('subnav')
    <a class="btn btn-light" href="{{route('admin')}}" role="button">Back To Dashboard</a>
    <a class="btn btn-light" href="{{route('admin.contact.messages.index')}}" role="button">View Messages <span class="badge badge-dark text-light">{{$unread ?? 0 }}</span></a>
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
                <div class="col-md-6 border-right">
                    <div class="card" >
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="m-0">Contact Information</h5>
                            <form action="{{ route('admin.contact.destroy', $contact->id) }}" method="POST" class="mb-0">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="text-white fa-trash"></i>
                                    delete
                                </button>   
                            </form>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{$contact->companyname}}</h5>
                            <span class="badge badge-info">
                                {{($contact->showform ? 'Show ' : 'Do not show ')}}the form on front page
                            </span>
                        </div>
                        <div class="card-body">
                            
                            @forelse($contact->address as $name => $value)
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
                <div class="col-md-6">
                    @empty($contact->form)
                        <div class="col-md-12 justify-content-center align-items-center h-100 d-flex flex-column">
                            <p class="align-self-center">No Form made</p>
                            <a class="btn btn-success" href="{{route('admin.contact.form.create')}}" role="button">Create New Form</a>
                        </div>
                    @else
                        <div class="card" >
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="m-0">Form Details</h5>
                                <form action="{{ route('admin.contact.form.destroy', $contact->id) }}" method="POST" class="mb-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="text-white fa-trash"></i>
                                        delete
                                    </button>   
                                </form>
                            </div>
                            <ul class="list-group list-group-flush">
                                @foreach($contact->form as $field)

                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p class="strong">Name: {{$field->name}}</p>
                                                <p>Field Type: {{ucwords($field->field)}}</p>
                                            </div>
                                            <div class="col-md-6">
                            
                                                @if($field->field == 'select' )
                                                    {{ Form::{ucwords($field->field)} ($field->name, json_decode($field->formatted_values), null, ['class' => 'form-control']) }}
                                                @else
                                                    {{ Form::{ucwords($field->field)} ($field->name, json_decode($field->formatted_values),  ['class' => 'form-control']) }}
                                                @endif
                                                
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                                
                            <div class="card-body">
                                <a href="{{route('admin.contact.form.edit', $contact->id)}}" class="btn btn-dark">edit</a>
                            </div>
                        </div>
                        
                    @endif
                </div>
            @endif
        </div>
    </div>
@endsection





