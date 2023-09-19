<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Project;
use App\Models\client;
use App\Models\Employee;
use PDF;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class ProjectController extends Controller
{

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
        $uploadedLogo = $request->file('logo');
        $extension = 'webp'; // Force extension to be 'webp'
        $randomName = Str::random(10); // Generate a random name for the image, e.g., 10 characters long
        $logoPath = $uploadedLogo->storeAs('logos', $randomName . '.' . $extension, 'public');
    
        // Compress the uploaded image
        $image = Image::make(storage_path("app/public/{$logoPath}"));
        $image->encode($extension, 30); // Compress as WebP with 80% quality (adjust as needed)
        $image->save(storage_path("app/public/{$logoPath}")); // Overwrite the original image
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
        if(auth()->check() && auth()->user()->is_admin){
            $projects = Project::all();
            $projects = Project::paginate(8);
            $publishedProjectsCount = Project::where('published', 1)->count();
            $totalProjectsCount = Project::count();
            
            return view('dashboard', compact('projects', 'publishedProjectsCount', 'totalProjectsCount'));
        }
        else {
            $projects = Project::where('published', true)->paginate(8);

            return view('dashboard', compact('projects'));
        }
       
    }
    public function searchProjects(Request $request)
{
    if(auth()->check() && auth()->user()->is_admin){
        $publishedProjectsCount = Project::where('published', 1)->count();
        $totalProjectsCount = Project::count();
        $search = $request->query('search');
        $projects = Project::where('projectname', 'like', '%' . $search . '%')
        ->orWhere('contract_status', 'like', '%' . $search . '%')
        ->orWhere('total_price', 'like', '%' . $search . '%')
        ->orWhereHas('client', function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        })
        ->paginate(8);
        return view('dashboard', compact('projects', 'publishedProjectsCount', 'totalProjectsCount'));
    } else {
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

    
}
public function updatePublish($id)
{
    $project = Project::findOrFail($id);
    $project->update(['published' => !$project->published]);

    return redirect()->back()->with('success', 'Project publish status updated successfully.');
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

public function generateHtmlToPDF()
{
    // Fetch your project data
    $projects = Project::all();

    // Pass the data to your view
    $data = [
        'projects' => $projects,
    ];

    // Create a PDF instance
    $pdf = PDF::loadHTML(view('pdf-dashboard', $data)->render());
    $papersize = array(0,0,280,430);
    // Set the custom paper size
    $pdf->setPaper($papersize);

    // Download the PDF
    return $pdf->download('dashboard.pdf');
}

public function updateALLProjects(Request $request)
{
    Project::query()->update(['published' => 1]);
    return redirect()->back()->with('success', 'All projects have been published.');


}

    
}