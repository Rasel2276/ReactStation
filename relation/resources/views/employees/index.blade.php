<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employees & Clients</title>
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
        .btn {
            display: inline-block;
            padding: 6px 12px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .no-data {
            text-align: center;
            color: #777;
            padding: 15px 0;
        }
    </style>
</head>
<body>

<div class="table-container">
    <h1>Employee Client Overview</h1>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Employee Name</th>
                <th>Total Users</th>
                <th>Total Clients</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($employees as $index => $emp)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $emp->name }}</td>
                    <td>{{ $emp->users->count() }}</td>
                    <td>{{ $emp->clients->count() }}</td>
                    <td>
                        <a class="btn" href="{{ route('employees.clients', $emp->id) }}">View Clients</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="no-data">No employees found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

</body>
</html>
