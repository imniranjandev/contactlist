@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg p-4">
        <h2 class="text-center text-primary">Upload XML File</h2>
        
        <!-- Upload Form -->
        <form action="{{ route('upload.xml') }}" method="POST" enctype="multipart/form-data" class="mb-4">
            @csrf
            <div class="mb-3">
                <label for="xml_file" class="form-label fw-bold">Select XML File:</label>
                <input type="file" class="form-control @error('xml_file') is-invalid @enderror" name="xml_file" required>
                @error('xml_file')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-success w-100">Upload & Save</button>
        </form>

        <!-- Success Message -->
        @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('skipped') > 0)
    <div class="alert alert-danger">
        {{ session('skipped') }} duplicates skipped.
    </div>
@endif
    </div>

    <!-- Display Uploaded Contacts -->
    @if($contacts->count() > 0)
    <div class="card shadow-lg p-4 mt-4">
        <h3 class="text-center text-primary">Uploaded Contacts</h3>
        <table class="table table-striped table-bordered">
            <thead class="bg-primary text-white text-center">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Phone</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contacts as $index => $contact)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->phone }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection
