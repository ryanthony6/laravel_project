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
                <form action="{{ route('schedules.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="court">Court:</label>
                        <input type="number" id="court" name="court" class="form-control" required min="1"
                            max="6">
                    </div>

                    <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="number" id="price" name="price" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="schedule_date">Tanggal:</label>
                        <input type="date" id="schedule_date" name="schedule_date" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Jam:</label><br>
                        <div class="row">
                            @foreach (range(10, 22) as $hour)
                                <div class="col-3 mb-2"> <!-- Setiap kolom memiliki margin bottom 2 -->
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="hour_{{ $hour }}" name="hours[]" value="{{ $hour }}">
                                        <label class="form-check-label" for="hour_{{ $hour }}">{{ sprintf('%02d', $hour) }}:00</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
                <!-- AKHIR FORM -->
            </div>
        </div>
    </div>
</div>
