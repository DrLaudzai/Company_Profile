@extends('layouts.admin')

@section('title', 'Reports')

@section('content')

<div class="card">

    <h3>User Report</h3>

    <form method="GET" class="filter-form">
        <div class="date-group">
            <label>From</label>
            <input type="date" name="from" value="{{ request('from') }}">
        </div>

        <div class="date-group">
            <label>To</label>
            <input type="date" name="to" value="{{ request('to') }}">
        </div>

        <button type="submit" class="btn-primary">Filter</button>

        <a href="{{ route('reports.export.pdf', request()->query()) }}"
           class="btn-export">
            Export PDF
        </a>
    </form>


    {{-- Table --}}
    <table class="custom-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Registered</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ ucfirst($user->role) }}</td>
                <td>
                    {{ \Carbon\Carbon::parse($user->created_at)->translatedFormat('d F Y') }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

        {{-- Grafik --}}
    <div class="chart-container">
        <canvas id="userChart"></canvas>
    </div>

</div>

@endsection

<script>
const ctx = document.getElementById('userChart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: {!! json_encode(array_keys($monthly->toArray())) !!},
        datasets: [{
            label: 'Users per Month',
            data: {!! json_encode(array_values($monthly->toArray())) !!},
        }]
    },
});
</script>