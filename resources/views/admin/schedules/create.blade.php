<!-- START FORM -->
<div class="modal fade" id="createScheduleModal" tabindex="-1" aria-labelledby="createScheduleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createScheduleModalLabel">Tambah Jadwal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- START FORM -->
                <form action='{{ route('schedules.store') }}' method='post'>
                    @csrf
                    <div class="mb-3 row">
                        <label for="schedule_date" class="col-sm-2 col-form-label">Tanggal</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name='date' id="date"
                                value="{{ old('date', date('Y-m-d')) }}" min="{{ date('Y-m-d') }}"
                                max="{{ date('Y-m-d', strtotime('+1 week')) }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="court" class="col-sm-2 col-form-label">Lapangan nomor</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name='court' id="court"
                                value="{{ old('court') }}" min="1" max="6" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="price" class="col-sm-2 col-form-label">Harga</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name='price' id="price"
                                value="{{ old('price') }}" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="schedule" class="col-sm-2 col-form-label">Jadwal</label>
                        <div class="col-sm-10">
                            <div class="row">
                                @php
                                    $times = ['09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00'];
                                @endphp
                                @foreach ($times as $time)
                                    <div class="col-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="schedule[]"
                                                id="schedule-{{ $time }}" value="{{ $time }}">
                                            <label class="form-check-label" for="schedule-{{ $time }}">{{ $time }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-10 offset-sm-2">
                            <button type="submit" class="btn btn-primary" name="submit">SIMPAN</button>
                        </div>
                    </div>
                </form>
                <!-- AKHIR FORM -->
            </div>
        </div>
    </div>
</div>
<!-- AKHIR FORM -->
