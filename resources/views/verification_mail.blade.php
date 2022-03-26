<!DOCTYPE html>
<html>
<head>
 <title>Auto Verge</title>
</head>
<body>
 
 <p>Dear {{ $booking->customer->name }}, your booking is done successfully.Details is here,</p>

 <div style="overflow-x : auto;">
    <table border=1>
        <thead>
            <tr>
                <th>Booking ID</th>
                <th>Date</th>
                <th>Car Number</th>
                <th>Duration</th>
                <th>Services</th>
                <th>Taken Back</th>
                <th>Notes</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $booking->id }}</td>
                <td>{{ \Illuminate\Support\Carbon::parse($booking->date)->format("d/m/Y") }}</td>
                <td>{{ $booking->car_number }}</td>
                <td>{{ $booking->duration }} {{ $booking->duration > 1 ? 'days' : 'day' }}</td>
                <td>
                    {{ implode(',',$booking->services()->pluck('type')->toArray()) }}
                </td>
                <td>{{ $booking->is_taken_back ? "Yes": "No" }}</td>
                <td>{{ $booking->notes }}</td>
            </tr>
        </tbody>
    </table>
 </div>

 
</body>
</html>