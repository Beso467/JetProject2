<x-app-layout>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employee List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Employee List
        </h2>
        <p class="note">Please note that part-time salaries are halved, and the currently viewed salaries are for full-time employees.</p>
    </x-slot>
    <br>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <div class="mx-auto max-w-screen-lg p-6">
                @if(session('success'))
                            <div class="mt-3 text-green-500">{{ session('success') }}</div>
                            @endif 
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
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                @if(auth()->check() && auth()->user()->is_admin)
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Salary</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $employee)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $employee->employee_name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $employee->employee_email }}</td>
                                @if(auth()->check() && auth()->user()->is_admin)
                                <td class="px-6 py-4 whitespace-nowrap">{{ $employee->employee_salary }}</td>
                                
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a class="btn btn-sm btn-danger" href="{{route('employee.destroy',$employee->id)}}">
                                        <i class="fa fa-trash"></i>Delete
                                    </a>
                                </td>
                                @endif

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $employees->links() }}
                    
                </div>
            </div>
        </div>
    </div>
</body>
</html>
</x-app-layout>
