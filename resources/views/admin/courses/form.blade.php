@extends('admin.index')


@section('content')


<div class="col-lg-12">
    <a href="{{ route('admin.courses') }}" class="btn btn-flat btn-primary mb-3 ">Back</a>
</div>


@include('common.datatables')

<script src="{{ asset('courses/courses.js') }}"></script>

@endsection