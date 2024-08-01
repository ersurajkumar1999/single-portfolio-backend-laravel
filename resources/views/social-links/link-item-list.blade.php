<div class="row">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header">Social Media Links</h5>
            <div class="add-new-btn">
                <button type="button" class="btn btn-primary" onclick="addNewItem()" id=""><i class='bx bx-plus-medical'></i></button>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table" id="linkTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Platform</th>
                            <th>Icon</th>
                            <th>Link</th>
                            <th>Status</th>
                            <th>Last Updated</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $key=> $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->platform }}</td>
                            <td>{{ $item->icon }}</td>
                            <td> <a target="_blank" href="{{ $item->link }}">{{ $item->platform }}</a> </td>
                            <td>
                                <span class="{{ $item->status == 1 ? 'text-success' : 'text-danger' }}">
                                    {{ $item->status == 1 ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>{{ $item->updated_at->format('d-m-Y h:i A') }}</td>
                            <td>
                                <a href="javascript:void(0)" class="edit-item" data-item="{{ json_encode($item) }}"><i class='edit-icon bx bxs-edit-alt'></i></a>
                                <a href="javascript:void(0)" class="delete-item" data-item="{{$item}}"><i class='delete-icon bx bxs-trash'></i></a>
                            </td>
                        </tr>
                        @endforeach
                        @if ($items->isEmpty())
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

<!--Add or Update Item Modal -->
<div class="modal fade" id="addItemFormModal" tabindex="-1" role="dialog" aria-labelledby="addItemFormModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title item-heading"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addItemForm" method="post" action="{{route('social-link.create')}}">
                    @csrf
                    <input type="hidden" name="id" id="itemId">
                    <div class="row g-2">
                        <div class="col mb-0">
                            <label for="platform" class="form-label">Platform</label>
                            <input type="text" id="platform" class="form-control" placeholder="Platform" name="platform" required />
                        </div>
                        <div class="col mb-0">
                            <label for="icon" class="form-label">Icon</label>
                            <input type="text" id="icon" class="form-control" placeholder="Icon" name="icon" required />
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col mb-0">
                            <label for="link" class="form-label">Link</label>
                            <input type="url" id="link" class="form-control" placeholder="Link" name="link" required />
                        </div>
                        <div class="col mb-0">
                            <label for="dobBasic" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="1">Active</option>
                                <option value="0">In Active</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer mt-2">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--Item Delete Modal -->
<div class="modal fade" id="deleteItemFormModal" tabindex="-1" role="dialog" aria-labelledby="deleteItemFormModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title item-heading"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addItemForm" method="post" action="{{route('social-link.delete')}}">
                    @csrf
                    <input type="hidden" name="delete_item_id" id="deleteItemId">

                    <div class="row g-2">
                        <div class="col mb-0">
                            <div>Are you sure you want to delete this item?</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-danger">Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        var table = $('#linkTable').DataTable()
        $('.add-item').on('click', function(e) {
            $('#addItemForm')[0].reset();
            $('.item-heading').html("Add New Link");
            let model = $('#addItemFormModal');
            model.modal('show');

        });
        $('.edit-item').on('click', function(e) {
            var item = $(this).data('item');
            $('#addItemForm')[0].reset();
            $('.item-heading').html("Update Link");
            setItemValue(item);
            let model = $('#addItemFormModal');
            model.modal('show');

        });
        $('.delete-item').on('click', function(e) {
            $('.item-heading').html("Confirm Link Deletion");
            var item = $(this).data('item');
            $('#deleteItemId').val(item.id);
            $('#addItemForm')[0].reset();
            let model = $('#deleteItemFormModal');
            model.modal('show');
        });
    });

    function addNewItem() {
        $('#addItemForm')[0].reset();
        $('.item-heading').html("Add New Item");
        let model = $('#addItemFormModal');
        model.modal('show');
    }

    function setItemValue(item) {
        $('#itemId').val(item.id);
        $('#platform').val(item.platform);
        $('#icon').val(item.icon);
        $('#link').val(item.link);
        $('#status').val(item.status);
    }
</script>