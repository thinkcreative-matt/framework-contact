{{-- @extends('tcadmin::layout') --}}
@extends('admin.layout')

@section('content')

    @include('admin-contact::components.subnav')

    <div class="admin-container container contact">
        <table class="table table-sm">
            <thead>
                
                <th>Company Name</th>
                <th>Created At</th>
                <th></th>
                <th></th>
            </thead>
            <tbody>
            
                
            @empty($contact)
                <tr>
                    <td colspan="4">No contact information is set</td>
                </tr>
            @else
                <tr>
                    <td>{{$contact->title}}</td>
                    <td>{{$contact->created_at->toFormattedDateString()}} <small class="text-muted">{{$post->created_at->diffForHumans()}}</small></td>
                    <td>
                        <div class="btn-group btn-group-sm" role="group" aria-label="Contact Actions">
                            <a class="btn btn-dark text-light btn-sm" href="{{ route('admin.contact.edit', $contact->id) }}">
                                <i class="text-dark fa-pencil"></i>
                                edit
                            </a>
                            <a class="btn btn-light btn-sm" href="{{ route('admin.contact.show', $contact->id ) }}">
                                <i class="text-dark fa-eye"></i>
                                view    
                            </a>
                        </div>
                    </td>
                    <td>
                        <form action="{{ route('admin.contact.destroy', $contact->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="text-white fa-trash"></i>
                                delete
                            </button>   
                        </form>
                    </td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
@endsection
