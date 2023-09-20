<x-app-layout>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> {{ $project->projectname }}:  Employees</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $project->projectname }}:  Employees
        </h2>
    </x-slot>

    <div class="py-3">
        <div class="container mx-auto">
            <div class="bg-gray overflow-hidden sm:rounded-lg p-6">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 max-w-lg mx-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Employee Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Working Hours</th>
                    @if(auth()->check() && auth()->user()->is_admin)
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Salary</th>
                     @endif
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($project->employees as $employee)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $employee->employee_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $employee->pivot->working_hours }}</td>
                        @if(auth()->check() && auth()->user()->is_admin)
                        <td class="px-6 py-4 whitespace-nowrap"> @if ($employee->pivot->working_hours === 'part_time')
                            {{ $employee->employee_salary / 2 }}
                        @else
                            {{ $employee->employee_salary }}
                        @endif</td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</html>
</x-app-layout>
