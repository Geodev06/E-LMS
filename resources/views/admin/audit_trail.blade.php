@include('common.datatables')

<div class="row">
    <div class="col-lg-12">
        <h4 class="header-title">Audit trail</h4>
    </div>

    <div class="col-12 w-100">
        <table id="table_audit" class="table table-stripe">
            <thead class="text-capitalize bg-dark text-white">
                <tr>
                    <th>Activity</th>
                    <th>Content</th>
                    <th width="20%">Previous Value</th>
                    <th>Current Value</th>
                    <th>Created By</th>
                    <th>Action</th>


                </tr>
            </thead>
            <tbody>


            </tbody>
        </table>
    </div>
</div>

<script>
    var columns = [{
            data: 'activity',
            name: 'activity'
        }, {
            data: 'content',
            name: 'content'
        }, {
            data: 'prev_value',
            name: 'prev_value'
        }, {
            data: 'current_value',
            name: 'current_value'
        },
        {
            data: 'created_by',
            name: 'created_by'
        },
        {
            data: 'action',
            name: 'action'
        },

    ]

 
    loadTable('#table_audit', "{{ route('admin.audit_trail_get') }}", columns, 5)
</script>