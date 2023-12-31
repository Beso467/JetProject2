<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
        <a href="{{ route('pdf.download') }}">Download list as PDF (BETA)</a>
    </x-slot>
    <br/> 
    <div class="py-12, font-size: 10px">
        <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
             
                    <div class="mb-4">
                        @if(session('success'))
                            <div class="mt-3 text-green-500">{{ session('success') }}</div>
                            @endif 
                        @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <br>
                        <form action="{{ route('search-projects') }}" method="GET" class="flex items-center">
                            <input type="text" class="form-input rounded-md shadow-sm mr-2" name="search" id="search" value="{{ request('search') }}" placeholder="Search projects...">
                            <button type="submit" class="btn btn-primary" style="background-color: #337ab7; color: #fff;">Search</button>
                        </form>
                        
                    </div>
                    <div class="table-responsive overflow-x-auto">  
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Project Name
                            </th>
                            <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Project Logo
                            </th>
                            <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Client
                            </th>
                            <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Contract Date y\m\d
                            </th>
                            <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Expected time y\m\d
                            </th>
                            <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Contract Price
                            </th>
                            <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Project Status
                            </th>
                            <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Total Price
                            </th>
                           
                            <th scope="col" class="px-3 py-2 text-left text-xs font-small text-gray-500 uppercase tracking-wider">
                               @if (auth()->check() && auth()->user()->is_admin) 
                            Actions\
                            Completion Date   
                            @else
                            Completion Date
                            @endif
                            </th>
                            <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <form action="{{ route('employee.list') }}" method="GET" class="flex items-center">
                                <button class="btn px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="background-color: #cccccc33; border-style: solid;">View All Employees</button>
                                </form>
                            </th>
                            @if(auth()->check() && auth()->user()->is_admin)
                            <p class="px-3 py-2 text-center font-medium text-gray-500 uppercase tracking-wider">PUBLISHED PROJECTS {{ $publishedProjectsCount }}/{{ $totalProjectsCount }}</p>
                            <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                

                                <form action="{{ route('update-all-projects') }}" method="POST" class="flex items-center">
                                    @csrf
                                    <button class="btn px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="background-color: #cccccc33; border-style: solid;">Publish All</button>
                                    </form>
                            </th>
                            @endif
                        </tr>
                        <style>
                            .text-custom-sm {
                                font-size: 0.80rem;
                                font-weight: semibold;
                            }
                        </style>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @if ($projects->isEmpty())
                        <p>No results found</p>
   
                     
                       @endif
                        @foreach ($projects as $project)
                            <tr>
                                <td class="px-3 py-2 whitespace-nowrap text-sm">{{ $project->projectname }}</td>
                                <td class="px-3 py-2 whitespace-nowrap text-sm"><img src="{{ asset('storage/' . $project->logo_path) }}" height="20px" width="60px" alt="{{ $project->name }} Logo"></td>
                                <td class="px-3 py-2 whitespace-nowrap custom-small-font text-center text-sm" style="font-size: 13.5px;">
                                    {{ $project->client->name }}  <img src="{{ asset('storage/' . $project->client->profile_picture_path) }}" height="20px" width="50px" alt="Profile Picture">
                                </td>
                                <td class="px-3 py-2 whitespace-nowrap text-custom-sm">{{ $project->contract_date }}</td>
                                <td class="px-3 py-2 whitespace-nowrap text-custom-sm">{{ $project->expected_time }}</td>
                                <td class="px-3 py-2 whitespace-nowrap text-sm">{{ $project->contract_price }}</td>
                                <td class="px-3 py-2 whitespace-nowrap text-sm">{{ $project->contract_status }}</td>
                                <td class="px-3 py-2 whitespace-nowrap text-sm">{{ $project->total_price }}</td>
                                <td class="px-3 py-2 whitespace-nowrap text-sm font-medium">
                                @if ($project->contract_status === 'completed' && $project->completion_date <= $project->expected_time)
                                <span class="text-green-500">{{ $project->completion_date }}</span>
                                @elseif($project->contract_status === 'completed' && $project->completion_date > $project->expected_time)
                                    <span class="text-red-500">{{ $project->completion_date }}</span>
                                @elseif (auth()->check() && auth()->user()->is_admin)
                                    <a href="{{ route('show-update-status-form', ['id' => $project->id]) }}" class="btn btn-primary" style="background-color: #337ab7; color: #fff; font-size: 13px;">Edit Status</a>
                                    @else
                                    <p>This project is not completed</p>
                                    @endif
                                </td>                         
                                <td class="px-3 py-2 whitespace-nowrap">
                                    <a href="{{ route('project.employees', ['project' => $project->id]) }}" class="btn btn-primary text-xs" style="background-color: #337ab7; color: #fff; font-size: 13px;">View Employees</a>
                                </td>
                               @if(auth()->check() && auth()->user()->is_admin)
                                <td class="px-3 py-2 whitespace-nowrap text-sm">
                                    <form action="{{ route('update-publish', ['id' => $project->id]) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-primary text-xs py-1 px-2" style="background-color: #337ab7; color: #fff;">
                                            {{ $project->published ? 'Unpublish' : 'Publish' }}
                                        </button>                                        
                                    </form>                                    
                                </td>
                                @endif
                               
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                    </div>
                {{ $projects->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
</html>