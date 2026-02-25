<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    // Get All emps 
    public function index(){
        return response()->json([Employee::all()]); 
    }

    //Create
    public function store(Request $request){

        $validated = $request->validate([
            "name"=> "required|string",
            "email"=> "required|email|unique:employees",
            "phone"=> "required|string", ]);
            $employee = Employee::create($validated);
            return response()->json(["201"=> $employee]);
    }

    //show single employee
    public function show($id){
        $employee = Employee::findOrFail($id);
        return response()->json( $employee);
    }

    //Update
    public function update(Request $request, $id){
          $employee = Employee::findOrFail($id);
          $employee->update($request->all());
          return response()->json([""=> $employee]);
    }

    //Delete
    public function destroy($id){
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}   

