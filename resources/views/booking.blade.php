@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 mb-4">
                <div class="card custom-card">
                    <h2 class="card-header text-center">Court 1</h2>
                    <div class="card-body">
                        <img src="{{ asset('images/Ss3.png') }}" alt="Gambar Lapangan" class="img-fluid rounded mb-3">
                        <div class="mb-3">
                            <label for="date1" class="form-label">Tanggal:</label>
                            <input type="date" class="form-control" id="date1" name="date1" value="{{ date('Y-m-d') }}">
                        </div>
                        <div class="mb-3">
                            <label for="time1" class="form-label">Jam main:</label>
                            <div class="d-flex flex-wrap">
                                @for ($i = 7; $i < 22; $i++)
                                    <button class="btn btn-outline-secondary time-slot m-1" data-time="{{ $i }}" data-court="1">
                                        {{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00 - {{ str_pad($i+1, 2, '0', STR_PAD_LEFT) }}:00
                                    </button>
                                @endfor
                            </div>
                        </div>
                        <div class="mb-3">
                            <p class="price-text">Harga: Rp <span id="total-price">0</span></p>
                        </div>
                        <button id="book-now-btn" class="btn btn-success w-100">Book Now</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection