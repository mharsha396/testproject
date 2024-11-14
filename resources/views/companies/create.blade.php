@extends('layouts.app')

@section('content')
<x-heading>
    Company Create
</x-heading>
<div class="row">
    <div class="col-md-10">
        <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <x-form-input name="name" label="Company Name" />
            <x-form-input name="email" type="email" label="Email" />
            <x-form-input name="logo" type="file" label="Logo" />
            <x-form-input name="website" label="Website" />
            <x-button text="Create Company" />
        </form>
    </div>

</div>
   
@endsection
