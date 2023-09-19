<x-app-layout>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Client</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Client') }}
        </h2>
    </x-slot>  
   
    <div class="py-12">
        <div class="container mx-auto">
            <div class="bg-gray overflow-hidden sm:rounded-lg p-6">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 max-w-lg mx-auto">
        
        <form method="POST" action="{{ route('client.store') }}" enctype="multipart/form-data" >
            @csrf
            <div class="form-group">
                <label for="name">Client Name:</label>
                <input type="text" class="form-input rounded-md shadow-sm mt-1 block w-full max-w-xs" name="name" id="name" required>
            </div>
            <div class="form-group">
                <label for="number">Client Phone Number:</label>
                <input type="number" class="form-input rounded-md shadow-sm mt-1 block w-full max-w-xs" name="number" id="number" required>
            </div>
            <label for="profile_picture_path">Profile Picture:</label>
    <input type="file" class="form-control-file" name="profile_picture_path" id="profile_picture_path">
    <br/>
            <button type="submit" class="btn btn-primary">Add Client</button>
        </form>

        @if(session('success'))
            <div class="mt-3 alert alert-success">{{ session('success') }}</div>
        @endif
    </div>
    </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
</x-app-layout>
