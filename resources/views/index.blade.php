<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking History</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}"></script>
</head>
<body>
    <div class="container">
        <h1>Booking History</h1>
        <form method="GET" action="{{ url('/bookings') }}">
            <div class="filter-container">
                <input type="text" name="search" placeholder="Search by name or court" value="{{ request()->query('search') }}">
                <select name="court" value="{{ request()->query('court') }}">
                    <option value="">All Courts</option>
                    <!-- Example options, you might want to populate this dynamically -->
                    <option value="Court 1">Court 1</option>
                    <option value="Court 2">Court 2</option>
                </select>
                <button type="submit">Filter</button>
            </div>
        </form>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Court</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking['id'] }}</td>
                        <td>{{ $booking['name'] }}</td>
                        <td>{{ $booking['court'] }}</td>
                        <td>{{ $booking['date'] }}</td>
                        <td>{{ $booking['time'] }}</td>
                        <td>{{ $booking['created_at'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
