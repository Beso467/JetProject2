<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Project;
use App\Models\client;
use App\Models\Employee;

class ProjectController extends Controller
{
    public function searchEmployees(Request $request)
    {
        $clients = Client::all();
        $employees = Employee::query();
    
        $search = $request->input('search');
        if ($search) {
            $employees->where('employee_name', 'like', '%' . $search . '%');
        }
    
        $employees = $employees->get();
    
        return view('projectform', compact('clients', 'employees'));
    }
    
    
    public function form(Request $request)
    {
        $clients = Client::all();
        $employeesQuery = Employee::query(); // Create a query instance
    
        $search = $request->input('search');
        if ($search) {
            $employeesQuery->where('employee_name', 'like', '%' . $search . '%');
        }
    
        $employees = $employeesQuery->paginate(10000); // Change the number to control items per page
    
        return view('projectform', compact('clients', 'employees'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'projectname' => 'required',
            'contract_date' => 'required|date',
            'contract_price' =>'required|numeric',
            'contract_status' => 'required',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'expected_time' => 'nullable|date|after:contract_date',

        ]);
        $selectedEmployees = $request->input('selected_employees', []);
    $totalSalaries = 0;

    foreach ($selectedEmployees as $employeeId) {
        $employee = Employee::findOrFail($employeeId);
        $totalSalaries += $employee->employee_salary;
    }

    $contractPrice = $request->input('contract_price');

    if ($totalSalaries > $contractPrice) {
        return redirect()->back()->with('warning', 'Warning: Total employee salaries exceed the contract price.');
    }

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
        }
        
       $project = Project::create([
            'projectname' => $request->input('projectname'),
            'client_id' => $request->input('client_id'),
            'contract_date' => $request->input('contract_date'),
            'contract_price' => $request->input('contract_price'),
            'contract_status' => $request->input('contract_status'),
            'expected_time' => $request->input('expected_time'),
            'logo_path' => $logoPath, 
          
            

        ]);
       
    $selectedEmployees = $request->input('selected_employees', []);
    $workingHours = $request->input('working_hours', []);

    
    foreach ($selectedEmployees as $employeeId) {
        $workingHour = isset($workingHours[$employeeId]) ? $workingHours[$employeeId] : null;
        $project->employees()->attach($employeeId, ['working_hours' => $workingHour]);
    }

    

       

        return redirect()->Route('add.project')->with('success', 'Project added successfully!');


    }

    public function showProjectEmployees($projectId)
{
    $project = Project::findOrFail($projectId);
    return view('project-employees', compact('project'));
}

   

    public function GetClient(){
        $clients = Client::all(); 
        return view('projectform', compact('clients'));
    }

    public function viewProjects()
    {
        $projects = Project::all();
        $projects = Project::paginate(8);
        return view('dashboard', compact('projects'));
    }
    public function searchProjects(Request $request)
{
    $search = $request->query('search');
    $projects = Project::where('projectname', 'like', '%' . $search . '%')
        ->orWhere('contract_status', 'like', '%' . $search . '%')
        ->orWhere('total_price', 'like', '%' . $search . '%')
        ->orWhereHas('client', function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        })
        ->paginate(8);

    return view('dashboard', compact('projects'));
}
    
public function updateStatus(Request $request, $id)
{
    $project = Project::findOrFail($id);
    
    $request->validate([
        'contract_status' => 'required|in:planning,design,implementation,testing,deployment,maintenance_phase,completed',
    ]);
    
    if ($request->input('contract_status') === 'completed') {
        $request->validate([
            'total_price' => 'required|numeric',
            'completion_date' => 'required|date',
        ]);

        $project->update([
            'contract_status' => $request->input('contract_status'),
            'total_price' => $request->input('total_price'),
            'completion_date' => $request->input('completion_date'),
        ]);

        return redirect()->back()->with('success', 'Project status, total price, and completion date updated successfully.');
    } else {
        // If contract status is not "completed," update only the status
        $project->update([
            'contract_status' => $request->input('contract_status'),
        ]);

        return redirect()->back()->with('success', 'Project status updated successfully.');
    }
}



    

public function showUpdateStatusForm($id)
{
    $project = Project::findOrFail($id);
    $statuses = ['planning', 'design', 'implementation', 'testing', 'deployment', 'maintenance_phase', 'completed'];
    
    
    return view('update-status', compact('project', 'statuses'));
}


    
}