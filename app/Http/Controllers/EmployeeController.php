<?php
namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class EmployeeController extends Controller
{
    public function create()
    {
        return view('add-employee');
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_name' => 'required',
            'employee_email' => 'required|email|unique:employees',
            'employee_salary' => 'required|numeric',
        ]);

        Employee::create([
            'employee_name' => $request->input('employee_name'),
            'employee_email' => $request->input('employee_email'),
            'employee_salary' => $request->input('employee_salary'),
        ]);

        return redirect()->route('employee.create')->with('success', 'Employee Added!');
    }
}

