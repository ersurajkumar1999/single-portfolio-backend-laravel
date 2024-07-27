<div class="row">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header">Contacts List</h5>
            <div class="add-new-btn">
                <button type="button" class="btn btn-primary" onclick="addNewItem()" id=""><i class='bx bx-plus-medical'></i></button>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table" id="contactTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Number</th>
                            <th>Email</th>
                            <th>Subjact</th>
                            <th>Message</th>
                            <th>Status</th>
                            <th>Last Updated</th>
                            <th>Closed Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
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
                <form id="addItemForm" method="post" action="{{route('about.item.create')}}">
                    @csrf
                    <input type="hidden" name="id" id="itemId">
                    <div class="row g-2">
                        <div class="col mb-0">
                            <label for="text" class="form-label">Text</label>
                            <input type="text" id="text" class="form-control" placeholder="Text" name="text" required />
                        </div>
                        <div class="col mb-0">
                            <label for="icon" class="form-label">Icon</label>
                            <input type="text" id="icon" class="form-control" name="icon" required />
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-0">
                            <label for="number" class="form-label">Number</label>
                            <input type="number" id="number" class="form-control" placeholder="123" name="number" required />
                        </div>
                        <div class="col mb-0">
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
                <form id="addItemForm" method="post" action="{{route('about.item.delete')}}">
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
    @section('js_script')


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
            $('#text').val(item.text);
            $('#icon').val(item.icon);
            $('#number').val(item.number);
            $('#status').val(item.status);
        }
    </script>

<script type="text/javascript">
  $(function () {

    var table = $('#contactTable').DataTable({
        processing: true,
        serverSide: true,
        // responsive: true,
        ajax: "{{ route('contact.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'name', name: 'name'},
            {data: 'phone', name: 'phone'},
            {data: 'email', name: 'email'},
            {data: 'subject', name: 'subject'},
            {data: 'message', name: 'message'},
            {data: 'status', name: 'status', orderable: false, searchable: false},
            {data: 'updated_at', name: 'updated_at', orderable: false, searchable: false},
            {data: 'closed_date', name: 'closed_date'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

  });
</script>
@endsection
