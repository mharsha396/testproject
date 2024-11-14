@extends('layouts.app')

@section('content')
<x-heading>
     Employee Create
</x-heading>

<div class="row">
    <div class="col-md-8">
        <form action="{{ route('employees.store') }}" method="POST">
            @csrf
            <x-form-input name="first_name" label="First Name" />
            <x-form-input name="last_name" label="Last Name" />
            <x-select-input name="company_id" label="Company" :options="$companies->pluck('name', 'id')" :selected="old('company_id')" />
            <x-form-input name="email" type="email" label="Email" />
            <x-form-input name="phone" label="Phone" />
            <x-button text="Create Employee" />
        </form>
    </div>
</div>
@endsection
