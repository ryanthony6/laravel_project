@extends('layouts.admin')

@section('content')
    <!-- START FORM -->
    <form action='{{ url('admin/reviews') }}' method='post'>

        @csrf
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <div class="mb-3 row">
                <label for="name" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name='name' id="name"
                        value="{{ Session::get('name') }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="comment" class="col-sm-2 col-form-label">Comment</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name='comment' rows=5 id="comment" maxlength="255"
                        value="{{ Session::get('comment') }}"></textarea>
                    <div id="charCount">Characters left: 255</div>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="jurus" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SIMPAN</button>
                </div>
            </div>
    </form>
    </div>
    <!-- AKHIR FORM -->
@endsection
