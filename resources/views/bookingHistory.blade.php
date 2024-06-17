@extends('layouts.app')

@section('content')
<div class="container mt-5 d-flex justify-content-center">
  <div class="col-md-10 booking-history-container">
    <h2 class="mb-4 text-center">Booking History</h2>
    <table class="table table-bordered">
      <thead class="table-dark">
        <tr>
          <th scope="col">Number</th>
          <th scope="col">Court</th>
          <th scope="col">Date</th>
          <th scope="col">Playtime</th>
          <th scope="col">Price</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">1</th>
          <td>2</td>
          <td>12/11/2023</td>
          <td>09:00-10:00</td>
          <td>100,000</td>
        </tr>
        <tr>
          <th scope="row">2</th>
          <td>2</td>
          <td>12/12/2024</td>
          <td>09:00-10:00, 10:00-11:00, 11:00-12:00, 12:00-13:00, 13:00-14:00</td>
          <td>200,000</td>
        </tr>
      </tbody>
    </table>
    <div class="button-center">
        <a href={{ route('home') }} type="button" class="btn btn-primary btn-block justify-content-center align-items-center">Back to home</a>
    </div>
  </div>
</div>
@endsection