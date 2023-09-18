<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <style>
        /* Add custom styles here */
        .list-item {
            margin-bottom: 1rem;
        }

        .text-small {
            font-size: 0.75rem;
        }
    </style>
</head>
<body>
    @foreach ($projects as $project)
       @if ($project->published)
    
        <div class="list-item" style="page-break-after: always">
            <img src="{{  public_path('storage/' . $project->logo_path) }}" height="100px" width="100px" alt="{{ $project->name }} Logo">
            <h4 class="text-primary">{{ $project->projectname }}</h4>
            <p><strong>Client:</strong> {{ $project->client->name }}</p>
            <p><strong>Contract Date (y/m/d):</strong> {{ $project->contract_date }}</p>
            <p><strong>Expected Time (y/m/d):</strong> {{ $project->expected_time }}</p>
            <p><strong>Contract Price:</strong> {{ $project->contract_price }}</p>
            <p><strong>Project Status:</strong> {{ $project->contract_status }}</p>
            <p><strong>Total Price:</strong> {{ $project->total_price }}</p>
            <p class="text-small">
                @if ($project->contract_status === 'completed' && $project->completion_date <= $project->expected_time)
                    <span class="text-success">Completion Date: {{ $project->completion_date }}</span>
                @elseif($project->contract_status === 'completed' && $project->completion_date > $project->expected_time)
                    <span class="text-danger">Completion Date: {{ $project->completion_date }}</span>
                @else
                    <span class="text-muted">Status: Not completed</span>
                @endif
            </p>
        </div>
        @endif
    @endforeach
</body>
</html>
