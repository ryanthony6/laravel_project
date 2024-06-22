@extends('layouts.admin')

@section('content')
    <!-- START FORM -->
    <div class="modal fade" id="createScheduleModal" tabindex="-1" aria-labelledby="createScheduleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createScheduleModalLabel">Tambah User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- START FORM -->
                    <form action='' method='post'>
                        @csrf
                        <div class="mb-3 row">
                            <label for="name" class="col-sm-2 col-form-label">Lapangan nomor</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name='name' id="name"
                                    value="{{ Session::get('name') }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="price" class="col-sm-2 col-form-label">Harga</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name='price' id="price"
                                    value="{{ Session::get('price') }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="schedule" class="col-sm-2 col-form-label">Jadwal</label>
                            <div class="col-sm-10">
                                <input type="radio" class="form-control" name='schdule' id="schedule"
                                    value="{{ Session::get('password') }}">
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
@endsection
