<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Employee List
        </h2>
        <p class="note">Please note That part time salaries are halved and the current viewed salaries are full time</p>
    </x-slot>
    <br>
    
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
    <div class="mx-auto max-w-screen-lg p-6">
        <form action="{{ route('search-employees') }}" method="GET" class="flex items-center">
            @csrf
            @method('GET')
            <input type="text" class="form-input rounded-md shadow-sm mr-2" name="search" id="search" value="{{ request('search') }}" placeholder="Search employees...">
            <button type="submit" class="btn btn-primary" style="background-color: #337ab7; color: #fff;">Search</button>
        </form>
        <div class="table-responsive">
            <table class="w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone Number</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Salary</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $employee)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $employee->employee_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $employee->employee_email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $employee->employee_salary}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$employees->links()}}
        </div>
    </div>
    </div>
</div>
</x-app-layout>
