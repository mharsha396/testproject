<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         $companies = Company::query()->get();
         if ($request->ajax()) {
             return DataTables::of($companies)
                 ->addColumn('logo', function ($company) {
                    if(!empty($company->logo)){
                        return '<img src="'.asset('storage/'.$company->logo).'" height="200px" height="200px">';
                    }else{
                        return 'No logo';
                    }
                    
                 })
                 ->addColumn('action', function ($company) {
                    return '<a href="' . route('companies.edit', $company->id) . '" class="btn btn-primary btn-sm">Edit</a>
                    <form action="' . route('companies.destroy', $company->id) . '" method="POST" style="display:inline;" id="delete-form-' . $company->id . '" onclick="return confirm(\'Are you sure?\')">
                        ' . method_field('DELETE') . csrf_field() . '
                        <button type="submit" class="btn btn-danger btn-sm delete-btn">Delete</button>
                    </form>';
                 })
                 ->rawColumns(['action','logo'])
                 ->make(true);
         }
 

        return view('companies.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoName = time() . '.' . $logo->getClientOriginalExtension();
            $logo->storeAs('public', $logoName);  
            $data['logo'] = $logoName; 
        }
        Company::create($data);
        return redirect()->route('companies.index')->with('success', 'Company added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $company = Company::find($id);
        return view('companies.edit',compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyRequest $request, string $id)
    {
        $data = $request->validated();
        $company = Company::find($id);

        if ($request->hasFile('logo')) {
            if ($company->logo && Storage::exists('public/'. $company->logo)) {
                Storage::delete('public/'. $company->logo);
            }

            $logo = $request->file('logo');
            $logoName = time() . '.' . $logo->getClientOriginalExtension();
            $logo->storeAs('public', $logoName);  
            $data['logo'] = $logoName;
        }
        $company->update($data);
        return redirect()->route('companies.index')->with('success', 'Company updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $company = Company::findOrFail($id);

        if ($company->logo && Storage::exists('public/'.$company->logo)) {
            Storage::delete('public/'.$company->logo);
        }
        $company->delete();
        return redirect()->route('companies.index')->with('success', 'Company deleted successfully.');
    }
}
