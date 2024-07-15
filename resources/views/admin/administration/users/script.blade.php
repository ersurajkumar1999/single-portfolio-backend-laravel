<script type="text/javascript">
    $(document).ready( function () {
        // $('#userTable').DataTable();
        var table = $('#userTable').DataTable({
            processing: true,
            serverSide: true,
            // fixedHeader: true,
            responsive: true,
            ajax: "{{ route('users.index') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    } );
</script>
