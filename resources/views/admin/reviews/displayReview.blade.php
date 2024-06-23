
@extends('layouts.admin')

<style>
    .dt-length .dt-input {
        margin-right: 10px !important;
    }
</style>

@section('content')


    <main class="container px-3 py-3">

        <!-- START DATA -->
        <div class="my-3 p-3 bg-body rounded shadow-sm">

            <!-- TOMBOL TAMBAH DATA -->
            <div class="pb-3">
                <h4>Review from visitors</h4>
            </div>

            <!-- Table -->
            <table class="table table-striped" id="dataTable">
                <thead>
                    <tr>
                        <th class="col-md-1">No</th>
                        <th class="col-md-1">Email</th>
                        <th class="col-md-2">Nama</th>
                        <th class="col-md-2">Comment</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($visitorReviews->isEmpty())
                        <tr>
                            <td colspan="4">Tidak ada data yang tersedia.</td>
                        </tr>
                    @else
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
                    @endif
                </tbody>
            </table>
            {{ $visitorReviews->withQueryString()->links() }}
        </div>
        <!-- AKHIR DATA -->
    </main>

@endsection
