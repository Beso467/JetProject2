<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Employees') }}
        </h2>
    </x-slot>

    <div class="container mt-4">
        <br/>
        <form method="POST" action="{{ route('employee.store') }}">
            @csrf
            <div class="form-group">
                <label for="name">Employee Name:</label>
                <input type="text" class="form-control" name="employee_name" id="employee_name" required>
            </div>
            <div class="form-group">
                <label for="email">Employee Email:</label>
                <input type="email" class="form-control" name="employee_email" id="employee_email" required>
            </div>
            <div class="form-group">
                <label for="salary">Employee Salary:</label>
                <input type="number" class="form-control" name="employee_salary" id="employee_salary" required>
            </div>
            <button type="submit" class="btn btn-primary" style="background-color: #337ab7; color: #fff;">Add Employee</button>
        </form>

        @if(session('success'))
            <div class="mt-3 alert alert-success">{{ session('success') }}</div>
        @endif
    </div>
</x-app-layout>
