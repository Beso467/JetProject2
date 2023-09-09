<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <br/> 
    <div class="py-12, font-size: 10px">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <div class="mb-4">
                        @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                        <form action="{{ route('search-projects') }}" method="GET" class="flex items-center">
                            <input type="text" class="form-input rounded-md shadow-sm mr-2" name="search" id="search" value="{{ request('search') }}" placeholder="Search projects...">
                            <button type="submit" class="btn btn-primary" style="background-color: #337ab7; color: #fff;">Search</button>
                        </form>
                    </div>
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
                                    Actions\
                                    Completion Date   
                            </th>
                        </tr>
                        <style>
                            .text-custom-sm {
                                font-size: 0.80rem; /* for date values */
                                font-weight: semibold;
                            }
                        </style>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
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
                                    @if ($project->contract_status === 'completed')
                                    {{ $project->completion_date }}
                                @else
                                    <a href="{{ route('show-update-status-form', ['id' => $project->id]) }}" class="btn btn-primary" style="background-color: #337ab7; color: #fff; font-size: 13px;">Edit Status</a>
                                @endif
                                </td>
                                <td class="px-3 py-2 whitespace-nowrap">
                                    <a href="{{ route('project.employees', ['project' => $project->id]) }}" class="btn btn-primary text-xs" style="background-color: #337ab7; color: #fff; font-size: 13px;">View Employees</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $projects->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
