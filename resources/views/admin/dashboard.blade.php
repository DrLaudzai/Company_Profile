@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<div class="cards">
    <div class="card">
        <h3>Total Users</h3>
        <p>{{ \App\Models\User::count() }}</p>
    </div>

    <div class="card">
        <h3>Revenue</h3>
        <p>Rp 15.000.000</p>
    </div>

    <div class="card">
        <h3>Projects</h3>
        <p>8 Active</p>
    </div>

    <div class="card">
        <h3>Reports</h3>
        <p>32</p>
    </div>
</div>

<div class="chart-container">
    <canvas id="myChart"></canvas>
</div>

<div class="table-container">
    <h3>Recent Users</h3>
    <div class="table-container">
        <h3>Recent Users</h3>
        <table>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Created</th>
            </tr>

            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at->format('d M Y') }}</td>
            </tr>
            @endforeach

        </table>
    </div>
</div>

<script>
const ctx = document.getElementById('myChart');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Jan','Feb','Mar','Apr','May','Jun'],
        datasets: [{
            label: 'Revenue',
            data: [12,19,8,15,22,30],
            borderWidth: 2
        }]
    }
});
</script>

@endsection