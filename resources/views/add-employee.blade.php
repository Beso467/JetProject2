<x-app-layout>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Employee</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Employees') }}
        </h2>
    </x-slot>


    <div class="py-3">
        <div class="container mx-auto">
            <div class="bg-gray overflow-hidden sm:rounded-lg p-6">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 max-w-lg mx-auto">
            <form method="POST" action="{{ route('employee.store') }}">
                @csrf
                <div class="form-group">
                    <label for="name">Employee Name:</label>
                    <input type="text" class="form-input rounded-md shadow-sm mt-1 block w-full" name="employee_name" id="employee_name" required>
                </div>
                <div class="form-group">
                    <label for="email">Employee Email:</label>
                    <input type="email" class="form-input rounded-md shadow-sm mt-1 block w-full " name="employee_email" id="employee_email" required>
                </div>
                <div class="form-group">
                    <label for="salary">Employee Salary:</label>
                    <input type="number" class="form-input rounded-md shadow-sm mt-1 block w-full " name="employee_salary" id="employee_salary" required>
                </div>
                <button type="submit" class="btn btn-primary" style="background-color: #337ab7; color: #fff;">Add Employee</button>
            </form>
    
            @if(session('success'))
                <div class="mt-3 alert alert-success">{{ session('success') }}</div>
            @endif
        </div>
    </div>
        </div>
    </div>
</body>
</html>
</x-app-layout>
