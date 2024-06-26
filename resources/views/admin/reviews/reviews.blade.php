@extends('layouts.admin')

@section('content')
    <main class="container px-3">

        <!-- START DATA -->
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            @if (session('error'))
                <div id="errorAlert" class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if (session('success'))
                <div id="successAlert" class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <!-- FORM PENCARIAN -->
            <div class="pb-3">
                <h4>Review to Display</h4>
            </div>

            <!-- TOMBOL TAMBAH DATA -->
            <div class="pb-3">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createReviewModal">
                    + Tambah Data
                </button>
            </div>

            <!-- Table -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="col-md-1">No.</th>
                        <th class="col-md-2">Name</th>
                        <th class="col-md-2">Description</th>
                        <th class="col-md-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($reviews->isEmpty())
                        <tr>
                            <td colspan="4">Tidak ada data yang tersedia.</td>
                        </tr>
                    @else
                        <?php $i = $reviews->firstItem(); ?>
                        @foreach ($reviews as $review)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $review->name }}</td>
                                <td>{{ $review->comment }}</td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#editReviewModal{{ $review->id }}">
                                        Edit
                                    </button>
                                    <form action="{{ url('admin/reviews', $review->id) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this schedule?');">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        @endforeach
                    @endif
                </tbody>
            </table>
            
        </div>
        <!-- AKHIR DATA -->
    </main>

    <!-- Modal -->
    <div class="modal fade" id="createReviewModal" tabindex="-1" aria-labelledby="createReviewModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createReviewModalLabel">Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- START FORM -->
                    <form action='{{ url('admin/reviews') }}' method='post'>
                        @csrf
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
                                <textarea class="form-control" name='comment' rows="5" id="comment" maxlength="255">{{ Session::get('comment') }}</textarea>
                                <div id="charCount">Characters left: 255</div>
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

    <!-- Edit Modal -->
    @foreach ($reviews as $review)
        <div class="modal fade" id="editReviewModal{{ $review->id }}" tabindex="-1"
            aria-labelledby="editReviewModalLabel{{ $review->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editReviewModalLabel{{ $review->id }}">Edit Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- START FORM -->
                        <form action='{{ url('admin/reviews', $review->id) }}' method='post'
                            id="editForm{{ $review->id }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3 row">
                                <label for="name" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name='name'
                                        id="edit_name{{ $review->id }}" value="{{ $review->name }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="comment" class="col-sm-2 col-form-label">Comment</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name='comment' rows="5" id="edit_comment{{ $review->id }}" maxlength="255">{{ $review->comment }}</textarea>
                                    <div id="charCount">Characters left: 255</div>
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
    @endforeach
@endsection