@extends('admin.index')


@section('content')


<div class="col-lg-12">
    <a href="{{ route('admin.courses.form') }}" class="btn btn-flat btn-primary mb-3 ">Add Course</a>
</div>

<div class="col-12 ">
    <table id="table_audit" class="table table-stripe">
        <thead class="text-capitalize bg-dark text-white ">
            <tr>
                <th width="20%" class="text-center">Course Name</th>
                <th width="20%" class="text-center">Course Code</th>
                <th width="20%" class="text-center">Description</th>
                <th width="20%" class="text-center">Posted</th>
                <th width="15%" class="text-center">Status</th>
                <th width="20%" class="text-center">Created Date</th>

                <th width="10%">Action</th>


            </tr>
        </thead>
        <tbody class="text-center">
        </tbody>
    </table>
</div>
<style>
    table.dataTable {
        table-layout: fixed;
    }
</style>
<script>
    var columns = [{
            data: 'course_name',
            name: 'course_name'
        }, {
            data: 'course_code',
            name: 'course_code'
        }, {
            data: 'description',
            name: 'description'
        }, {
            data: 'post_flag',
            name: 'post_flag'
        },
        {
            data: 'active_flag',
            name: 'active_flag'
        },
        {
            data: 'created_at',
            name: 'created_at'
        },
        {
            data: 'action',
            name: 'action'
        },

    ]

    var coldef = [{
            width: '15%',
            targets: 0
        }, // Activity
        {
            width: '20%',
            targets: 1
        }, // Content
        {
            width: '20%',
            targets: 2,
            className: 'ellipsis'
        }, // Previous Value
        {
            width: '20%',
            targets: 3,
            className: 'ellipsis'

        }, // Current Value,
        {
            width: '20%',
            targets: 4
        }, // Created By
        {
            width: '10%',
            targets: 5
        }, // Date
        {
            width: '10%',
            targets: 6
        } // Action
    ]

    loadTable('#table_audit', "{{ route('admin.courses_get') }}", columns, coldef, 5)
</script>

@include('common.datatables')

<script src="{{ asset('courses/courses.js') }}"></script>

@endsection