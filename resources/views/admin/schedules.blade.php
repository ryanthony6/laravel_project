@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Schedule Management</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

  
        <button type="submit" class="btn btn-primary mt-3">Save Changes</button>
    </form>
</div>
@endsection
