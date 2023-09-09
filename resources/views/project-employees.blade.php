<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Project Employees') }}
        </h2>
    </x-slot>

    <div class="container mt-4">
        <h3>Project: {{ $project->projectname }}</h3>
        <br/>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Employee Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Working Hours</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Salary</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($project->employees as $employee)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $employee->employee_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $employee->pivot->working_hours }}</td>
                        <td class="px-6 py-4 whitespace-nowrap"> @if ($employee->pivot->working_hours === 'part_time')
                            {{ $employee->employee_salary / 2 }}
                        @else
                            {{ $employee->employee_salary }}
                        @endif</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
