@extends('layouts.mainlayout')

@section('content')
<div class="d-flex justify-content-center align-items-center text-center" style="min-height: 80vh;">
    <div class="container" style="margin-top: 100px;">
        <h1 class="mb-4 text-center">Booking History</h1>
        @if ($bookings->isEmpty())
            <p class="text-center">No bookings found.</p>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center" id="historyTable">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center">Court</th>
                            <th class="text-center">Date</th>
                            <th class="text-center">Time</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $booking)
                            <tr>
                                <td class="text-center">{{ $booking->court }}</td>
                                <td class="text-center">{{ date('l, F j, Y', strtotime($booking->schedule_date)) }}</td>
                                <td class="text-center">{{ date('H:i', strtotime($booking->schedule)) }}</td>
                                <td class="text-center">Rp {{ number_format($booking->price, 0, ',', '.') }}</td>
                                <td class="text-center">{{ ucfirst($booking->status) }}</td>
                                <td class="text-center">
                                    <button class="btn btn-danger btn-cancel-booking" data-booking-id="{{ $booking->id }}">Cancel</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cancelButtons = document.querySelectorAll('.btn-cancel-booking');

        cancelButtons.forEach(button => {
            button.addEventListener('click', function() {
                const bookingId = this.dataset.bookingId;

                if (confirm('Are you sure you want to cancel this booking?')) {
                    fetch(`/cancel-booking/${bookingId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    }).then(response => response.json())
                      .then(data => {
                          if (data.success) {
                              alert('Booking cancelled successfully');
                              location.reload();
                          } else {
                              alert('Failed to cancel booking');
                          }
                      }).catch(error => {
                          console.error('Error:', error);
                          alert('An error occurred while cancelling the booking');
                      });
                }
            });
        });
    });
</script>

@endsection

