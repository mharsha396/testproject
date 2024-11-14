@extends('layouts.app')

@section('content')
<div class="container">
    <x-heading>
         Employee Edit
    </x-heading>
    <form action="{{ route('employees.update', $employee->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <x-form-input name="first_name" label="First Name" :value="$employee->first_name" />
        <x-form-input name="last_name" label="Last Name" :value="$employee->last_name" />
        <x-select-input name="company_id" label="Company" :options="$companies->pluck('name', 'id')"  :selected="$employee->company_id" />
        <x-form-input name="email" type="email" label="Email" :value="$employee->email" />
        <x-form-input name="phone" label="Phone" :value="$employee->phone" />
        
        <x-button text="Update Employee" />
    </form>
</div>
@endsection
