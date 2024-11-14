@extends('layouts.app')

@section('content')
<x-heading>
    Edit Company
</x-heading>
<div class="row">
    <div class="col-md-10">
        <!-- Form to edit company -->
        <form action="{{ route('companies.update', $company->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')  
            <x-form-input name="name" label="Company Name" value="{{ old('name', $company->name) }}" />
            <x-form-input name="email" type="email" label="Email" value="{{ old('email', $company->email) }}" />
            <x-form-input name="logo" type="file" label="Logo" />

            @if($company->logo)
                <div class="mt-2">
                    <label>Current Logo:</label>
                    <img src="{{ asset('storage/' . $company->logo) }}" width="100" height="100" alt="Current Logo">
                </div>
            @endif
            <x-form-input name="website" label="Website" value="{{ old('website', $company->website) }}" />
            <x-button text="Update Company" />
        </form>
    </div>
</div>
@endsection
