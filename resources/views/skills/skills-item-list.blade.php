<div class="row">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header">Skill List</h5>
            <div class="add-new-btn">
                <button type="button" class="btn btn-primary" onclick="addNewItem()" id=""><i class='bx bx-plus-medical'></i></button>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table" id="userTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Value</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($skill->items as $key=> $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->value }}</td>
                            <td>
                                <span class="{{ $item->status == 1 ? 'text-success' : 'text-danger' }}">
                                    {{ $item->status == 1 ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                <a href="javascript:void(0)" onclick="editItem({{$item}})"><i class='edit-icon bx bxs-edit-alt'></i></a>
                                <a href="javascript:void(0)" onclick="deleteItem({{$item}})"><i class='delete-icon bx bxs-trash'></i></a>
                            </td>
                        </tr>
                        @endforeach
                        @if ($skill->items->isEmpty())
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
            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addItemForm" method="post" action="{{route('skill.item.create')}}">
                    @csrf
                    <input type="hidden" name="id" id="itemId">
                    <div class="row g-2">
                        <div class="col-12 mb-0">
                            <label for="text" class="form-label">Name</label>
                            <input type="text" id="name" class="form-control" placeholder="name" name="name" required />
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col mb-0">
                            <label for="value" class="form-label">Value</label>
                            <input type="number" id="value" class="form-control" placeholder="123" name="value" required />
                        </div>
                        
                    </div>
                    <div class="row mt-2">
                        <div class="col-12 mb-0">
                            <label for="dobBasic" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control"  required>
                                <option value="1">Active</option>
                                <option value="0">In Active</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
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
            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addItemForm" method="post" action="{{route('skill.item.delete')}}">
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            // Initialize DataTables if needed
            var table = $('#userTable').DataTable();
        });

        function addNewItem(){
            $('#addItemForm')[0].reset();
            $('.item-heading').html("Add New Item");
            let model = $('#addItemFormModal');
            model.modal('show');
        }
        function editItem(item){
            $('#addItemForm')[0].reset();
            $('.item-heading').html("Update Item");
            setItemValue(item);
            let model = $('#addItemFormModal');
            model.modal('show');
        }

        function deleteItem(item){
            $('.item-heading').html("Confirm Item Deletion");
            console.log("item", item);
            $('#deleteItemId').val(item.id);
            $('#addItemForm')[0].reset();
            let model = $('#deleteItemFormModal');
            model.modal('show');
        }

        function setItemValue(item) {
            $('#itemId').val(item.id);
            $('#name').val(item.name);
            $('#value').val(item.value);
            $('#status').val(item.status);
        }
    </script>
