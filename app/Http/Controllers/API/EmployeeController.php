<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');  // Protect route with Sanctum
    }

    public function index()
    {
        
        $employees = Employee::with('company')->get();  

        return response()->json($employees);
    }
}
