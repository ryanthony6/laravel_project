@foreach ($schedules as $date => $courts)
@foreach ($courts as $court => $scheduleGroup)
    @foreach ($scheduleGroup as $schedule)
        <div class="modal fade" id="editScheduleModal{{ $schedule->id }}" tabindex="-1"
            aria-labelledby="editScheduleModalLabel{{ $schedule->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editScheduleModalLabel{{ $schedule->id }}">Edit Jadwal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- START FORM -->
                        <form action="{{ route('schedules.update', $schedule->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="court">Court:</label>
                                <input type="number" id="court" name="court" class="form-control" required
                                    min="1" max="6" value="{{ $schedule->court }}">
                            </div>

                            <div class="form-group">
                                <label for="price">Price:</label>
                                <input type="number" id="price" name="price" class="form-control" required
                                    value="{{ $schedule->price }}">
                            </div>

                            <div class="form-group">
                                <label for="schedule_date">Tanggal:</label>
                                <input type="date" id="schedule_date" name="schedule_date" class="form-control" required
                                    value="{{ $date }}" min="{{ date('Y-m-d') }}"
                                    max="{{ date('Y-m-d', strtotime('+1 week')) }}">
                            </div>

                            <div class="form-group">
                                <label>Jam:</label><br>
                                <div class="row">
                                    @foreach (range(10, 21) as $hour)
                                        <div class="col-3 mb-2">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input"
                                                    id="hour_{{ $hour }}_edit_{{ $schedule->id }}" name="hours[]"
                                                    value="{{ $hour }}" {{ in_array($hour, $scheduleGroup->pluck('schedule')->map(function ($datetime) {
                                                        return (new DateTime($datetime))->format('H');
                                                    })->toArray()) ? 'checked' : '' }}>
                                                <label class="form-check-label"
                                                    for="hour_{{ $hour }}_edit_{{ $schedule->id }}">{{ sprintf('%02d', $hour) }}:00</label>
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
    @endforeach
@endforeach
@endforeach