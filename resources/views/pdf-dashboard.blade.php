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
        .small-table th,
        .small-table td {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
        }

        .small-table th {
            background-color: #f0f0f0;
        }

        .text-small {
            font-size: 0.75rem;
        }
    </style>
</head>
<body>
    <table class="table-auto border-collapse w-full small-table">
        <thead>
            <tr>
                <th class="bg-gray-100 border">Project Name</th>
                <th class="bg-gray-100 border">Client</th>
                <th class="bg-gray-100 border">Contract Date (y/m/d)</th>
                <th class="bg-gray-100 border">Expected Time (y/m/d)</th>
                <th class="bg-gray-100 border">Contract Price</th>
                <th class="bg-gray-100 border">Project Status</th>
                <th class="bg-gray-100 border">Total Price</th>
                <th class="bg-gray-100 border">Actions / Completion Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
                <tr>
                    <td class="border">{{ $project->projectname }}</td>
                    <td class="border">{{ $project->client->name }}</td>
                    <td class="border">{{ $project->contract_date }}</td>
                    <td class="border">{{ $project->expected_time }}</td>
                    <td class="border">{{ $project->contract_price }}</td>
                    <td class="border">{{ $project->contract_status }}</td>
                    <td class="border">{{ $project->total_price }}</td>
                    <td class="border">
                        @if ($project->contract_status === 'completed' && $project->completion_date <= $project->expected_time)
                            <span class="text-green-500 text-small">{{ $project->completion_date }}</span>
                        @elseif($project->contract_status === 'completed' && $project->completion_date > $project->expected_time)
                            <span class="text-red-500 text-small">{{ $project->completion_date }}</span>
                        @else
                            <p class="text-small">Not completed</p>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
