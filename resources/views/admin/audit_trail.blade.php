
<div class="row">
    <div class="col-lg-12">
        <h4 class="header-title">Audit trail</h4>
    </div>

    <div class="col-12 w-100">
        <table id="table_audit" class="table table-stripe">
            <thead class="text-capitalize bg-dark text-white ">
                <tr >
                    <th  width="20%" class="text-center" >Activity</th>
                    <th  width="20%" class="text-center">Content</th>
                    <th width="20%" class="text-center">Previous Value</th>
                    <th width="20%" class="text-center">Current Value</th>
                    <th width="15%" class="text-center">Created By</th>
                    <th width="20%" class="text-center">Date</th>

                    <th width="10%">Action</th>


                </tr>
            </thead>
            <tbody>


            </tbody>
        </table>
    </div>
</div>

<style>
    table.dataTable {
    table-layout: fixed;
}
</style>
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
            data: 'created_at',
            name: 'created_at'
        },
        {
            data: 'action',
            name: 'action'
        },

    ]

    var coldef = [
        { width: '15%', targets: 0 }, // Activity
        { width: '20%', targets: 1 }, // Content
        { width: '20%', targets: 2 }, // Previous Value
        { width: '20%', targets: 3 }, // Current Value
        { width: '20%', targets: 4 }, // Created By
        { width: '10%', targets: 5 }, // Date
        { width: '10%', targets: 6 }  // Action
    ]
 
    loadTable('#table_audit', "{{ route('admin.audit_trail_get') }}", columns, coldef, 5)
</script>