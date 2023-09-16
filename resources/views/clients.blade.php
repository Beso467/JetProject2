<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Client List
        </h2>
    </x-slot>
    <br>
    
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
    <div class="mx-auto max-w-screen-lg p-6">
        <form action="{{ route('search-clients') }}" method="GET" class="flex items-center">
            @csrf
            @method('GET')
            <input type="text" class="form-input rounded-md shadow-sm mr-2" name="search" id="search" value="{{ request('search') }}" placeholder="Search clients...">
            <button type="submit" class="btn btn-primary" style="background-color: #337ab7; color: #fff;">Search</button>
        </form>
        <br>
        <div class="table-responsive">
            <table class="w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone Number</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Profile Picture</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clients as $client)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $client->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $client->number }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($client->profile_picture_path)
                                <img src="{{ asset('storage/' . $client->profile_picture_path) }}" alt="{{ $client->name }}" class="h-12 w-12 rounded-full">
                            @else
                                <span class="inline-block h-12 w-12 bg-gray-200 rounded-full"></span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                
            </table>
            {{$clients->links()}}
        </div>
    </div>
</div>
</div>
    
</x-app-layout>
