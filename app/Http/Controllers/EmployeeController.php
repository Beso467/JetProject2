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
    public function showEmployees()
    {
        $employees = Employee::all();
        $employees = Employee::paginate(8);
    
        return view('employees', compact('employees'));
    }
    public function searchEmployees(Request $request)
    {
        $search = $request->query('search');
        $employees = Employee::where('employee_name', 'like', '%' . $search . '%')
            ->orWhere('employee_email', 'like', '%' . $search . '%');
            
            if (!empty($search)) {
                $employees->orWhere('employee_salary', '<=', $search);
            }
        
            $employees = $employees->paginate(8);
        return view('employees', compact('employees'));
    }

public function destroy($delete){

    $data = Employee::find($delete); 
    $data->delete();
  
   return redirect()->route('employee.list')
                    ->with('success','deleted successfully!');
  }

}

