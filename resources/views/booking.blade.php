@extends('layouts.app')

@section('content')
    <div class="container mt-5 booking-info">
        <h1 class="text-center">Court details</h1>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="court-image-placeholder">
                    <img src="{{ asset('images/ss3.png') }}" alt="Court Image" class="img-fluid rounded">
                </div>
            </div>
            <div class="col-md-6">
                <h2>Nama lapangan</h2>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nemo nostrum dolor fugiat deleniti consequuntur ipsam. Accusantium deserunt maiores autem corrupti praesentium consectetur, a eveniet. Voluptates sunt ex repellendus magni libero.</p>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-2">
                <h3>Hari/Tanggal</h3>
                <input type="date" class="form-control" id="booking-date" value="{{ date('Y-m-d') }}">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <h3>Jam main</h3>
                <div class="d-flex flex-wrap">
                    @for ($i = 7; $i < 22; $i++)
                        <button class="btn btn-outline-secondary time-slot m-1" data-time="{{ $i }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00 - {{ str_pad($i+1, 2, '0', STR_PAD_LEFT) }}:00</button>
                    @endfor
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12 text-center">
                <button class="btn btn-success">Book Now</button>
            </div>
        </div>
    </div>
@endsection