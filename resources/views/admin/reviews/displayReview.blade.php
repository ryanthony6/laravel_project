@extends('layouts.admin')

@section('content')
    <main class="container px-3 py-3">

        <!-- START DATA -->
        <div class="my-3 p-3 bg-body rounded shadow-sm">

            <!-- TOMBOL TAMBAH DATA -->
            <div class="pb-3">
                <h4>Review from visitors</h4>
            </div>

            <!-- Table -->
            <table class="table table-striped compact cell-border dt-center dt-left" id="dataTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Email</th>
                        <th>Nama</th>
                        <th>Comment</th>
                    </tr>
                </thead>
                <tbody>

                    <?php $i = $visitorReviews->firstItem(); ?>
                    @foreach ($visitorReviews as $review)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $review->email }}</td>
                            <td>{{ $review->name }}</td>
                            <td>{{ $review->message }}</td>
                        </tr>
                        <?php $i++; ?>
                    @endforeach

                </tbody>
            </table>

        </div>
        <!-- AKHIR DATA -->
    </main>
@endsection
