@extends('admin.layouts.app')

@section('content')
<div class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Contact Messages</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.contact.index') }}">Contact Messages</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Message Details</li>
                </ol>
            </nav>
        </div>
    </div>

    <h6 class="mb-0 text-uppercase">Message Details</h6>
    <hr/>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">From: {{ $contact->name }}</h5>
            <p class="card-text"><strong>Email:</strong> {{ $contact->email_address }}</p>
            <p class="card-text"><strong>Message:</strong></p>
            <p class="border p-3">{{ $contact->message }}</p>
            <p><strong>Status:</strong> 
                @if ($contact->status == 1)
                    <span class="badge bg-success">Read</span>
                @else
                    <span class="badge bg-danger">Unread</span>
                @endif
            </p>
            <a href="{{ route('admin.contact.index') }}" class="btn btn-secondary">Back</a>
            <form action="{{ route('admin.contact.delete', $contact->id) }}" method="POST" style="display:inline;">
                @csrf 
                @method('DELETE')
                <input type="submit" value="Delete" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this message?')">
            </form>
        </div>
    </div>
</div>
@endsection
