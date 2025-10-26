<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $employee->name }} - Clients</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            padding: 40px;
        }
        .table-container {
            width: 80%;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #007bff;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #e9ecef;
        }
        .btn, .back-btn {
            display: inline-block;
            padding: 6px 12px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 500;
        }
        .btn:hover, .back-btn:hover {
            background-color: #0056b3;
        }
        .no-data {
            text-align: center;
            color: #777;
            padding: 15px 0;
        }
        .back-btn {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="table-container">
    <h1>Clients of {{ $employee->name }}</h1>

    @if($employee->clients->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Client Name</th>
                    <th>Related User</th>
                    <th>User ID</th>
                    <th>Client ID</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employee->clients as $index => $client)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $client->name }}</td>
                        <td>{{ $client->user->name ?? 'N/A' }}</td>
                        <td>{{ $client->user_id }}</td>
                        <td>{{ $client->id }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="no-data">No clients found for this employee.</div>
    @endif

    <a href="{{ route('employees.index') }}" class="back-btn">← Back to Employee List</a>
</div>

</body>
</html>
