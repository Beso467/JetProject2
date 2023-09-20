<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Projects</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .employee-list {
            padding: 0px;
        }
        
        .employee-scroll-container {
            max-height: 250px;
            max-width: 800px;
            overflow-y: auto;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 5px;
            box-sizing: border-box;
        }
        
        .employee-item {
            margin-bottom: 5px;
            padding: 5px;
            background-color: #f7f7f7;
            border: 1px solid #e0e0e0;
            border-radius: 3px;
        }
        
        .employee-name {
            font-weight: bold;
            font-size: 0.9rem
        }
        
        .employee-info {
            font-size: 0.7rem;
            color: #555;
        }
        
        /* Adjust checkbox and select width */
        .form-checkbox {
            width: 1rem; /* Adjust the width as needed */
        }
        
        .form-select {
            width: 6rem; /* Adjust the width as needed */
        }
        .note {
         font-size: 13px; /* You can adjust the size as needed */
         color: #777; /* A grey color of your choice */
              }

        .label-width {
         width: 150px; /* Adjust the width as needed */
              }

        </style>
</head>
<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
             Add a Project
            </h2>
        </x-slot>

        <div class="py-3">
            <div class="container mx-auto">
                <div class="bg-gray overflow-hidden sm:rounded-lg p-6">
                    @if(session('warning'))
                        <div class="mb-3 text-red-500">{{ session('warning') }}</div>
                    @endif
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 max-w-lg mx-auto">
                        <form action="{{ route('store-project') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @if(session('success'))
                            <div class="mt-3 text-green-500">{{ session('success') }}</div>
                            @endif
                            <br>
                            <div class="mb-4">
                                <label for="projectname" class="block font-medium text-sm text-gray-700">Enter Project Name</label>
                                <input type="text" class="form-input rounded-md shadow-sm mt-1 block w-full max-w-md" name="projectname" id="projectname" value="{{ old('projectname') }}" required>
                            </div>
                            <div class="mb-4">
                                <label for="client_id" class="block font-medium text-sm text-gray-700">Select Project Client</label>
                                <select class="form-select rounded-md shadow-sm mt-1 block w-full max-w-md" name="client_id" id="client_id" required>
                                    @foreach($clients as $client)
                                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3 text-center">
                                    <label for="contract_date" class="block font-medium text-sm text-gray-700 text-center">Enter Contract Date</label>
                                    <input type="date" class="form-input rounded-md shadow-sm mt-1 block max-w-md mx-auto" name="contract_date" id="contract_date" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="expected_time" class="block font-medium text-sm text-gray-700 text-center">Enter Expected Time</label>
                                    <input type="date" class="form-input rounded-md shadow-sm mt-1 block mx-auto" name="expected_time" id="expected_time">
                                </div>
                            </div>                                                                                                             
                            @error('expected_time')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                            <div class="mb-4">
                                <label for="contract_price" class="block font-medium text-sm text-gray-700">Enter Contract Price</label>
                                <input type="number" class="form-input rounded-md shadow-sm mt-1 block w-full max-w-md" name="contract_price" id="contract_price" required>
                            </div>
                            <div class="mb-4">
                                <label for="contract_status" class="block font-medium text-sm text-gray-700">Enter Project Status</label>
                                <select class="form-select rounded-md shadow-sm mt-1 block w-full max-w-md" name="contract_status" id="contract_status" required>
                                    <option value="planning">Planning</option>
                                    <option value="design">Design</option>
                                    <option value="implementation">Implementation</option>
                                    <option value="testing">Testing</option>
                                    <option value="deployment">Deployment</option>
                                    <option value="maintenance_phase">Maintenance Phase</option>
                                </select>
                            </div>
                                
                            <div class="text-center">
                                <h2 class="font-medium text-gray-700 mb-3">Select Employees:</h2>
                                <p class="note">**Please note that when selecting part-time, the salary halves</p>
                            </div>
                            <div class="employee-scroll-container max-w-lg mx-auto flex flex-wrap justify-between">
                                @foreach ($employees->sortBy('employee_name') as $employee)
                                    <div class="employee-item mb-4 flex items-center">
                                        <label class="block mt-1 employee-label">
                                            <input type="checkbox" class="form-checkbox employee-checkbox employee-info" name="selected_employees[]" value="{{ $employee->id }}">
                                            <span class="employee-name">{{ $employee->employee_name }}</span>
                                            <br>
                                            <span class="employee-info">Salary: {{ $employee->employee_salary }}</span>
                                            <select name="working_hours[{{ $employee->id }}]" class="ml-2 px-2 py-1 rounded-md form-select text-sm block mx-auto">
                                                <option value="full_time">Full Time</option>
                                                <option value="part_time">Part Time</option>
                                            </select>                                                                                        
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            

                            <div class="mt-4">
                                <label class="block font-medium text-sm text-gray-700">
                                    Project Logo:
                                </label>
                                <input type="file" name="logo">
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary" style="background-color: #337ab7; color: #fff;">Add Project</button>
                           
                        </form>
                    </div>
                </div>
            </div>
            </div>
            </div>
        </div>
    
        
        </div>
        </div>
    
        
    </x-app-layout>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

