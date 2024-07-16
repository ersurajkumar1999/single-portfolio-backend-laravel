<div class="row">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header">About List</h5>
            <div class="add-new-btn">

                <button class="btn btn-primary">Add Item</button>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table" id="userTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Text</th>
                            <th>Icon</th>
                            <th>Number</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($about->items as $key=> $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->text }}</td>
                            <td>{{ $item->icon }}</td>
                            <td>{{ $item->number }}</td>
                            <td>{{ $item->status }}</td>
                            <td>
                                <button class="btn btn-primary">Edit</button>
                                <button class="btn btn-danger">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                        @if ($about->items->isEmpty())
                        <tr>
                            <td colspan="5">No items found.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready( function () {
        // $('#userTable').DataTable();
        var table = $('#userTable').DataTable();
    } );
</script>