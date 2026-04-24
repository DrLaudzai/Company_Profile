<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>User Report</title>
    <style>
        body { font-family: sans-serif; }
        h2 { text-align: center; }
        .info { margin-top: 10px; font-size: 12px; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
            font-size: 11px;
        }
        th { background: #eee; }
    </style>
</head>
<body>

<h2>USER REPORT</h2>

<div class="info">
    @if($from && $to)
        Period: {{ $from }} - {{ $to }} <br>
    @endif
    Printed at: {{ now()->format('d M Y H:i') }}
</div>

<table>
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Registered</th>
    </tr>

    @foreach($users as $user)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ ucfirst($user->role) }}</td>
        <td>{{ $user->created_at->format('d M Y') }}</td>
    </tr>
    @endforeach
</table>

</body>
</html>