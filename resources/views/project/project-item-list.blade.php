<div class="row">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header">Project List</h5>
            <div class="add-new-btn">
                <button type="button" class="btn btn-primary" onclick="addNewItem()" id=""><i class='bx bx-plus-medical'></i></button>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table" id="projectTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Title</th>
                            <!-- <th>description</th> -->
                            <th>Link</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($project->items as $key=> $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>
                                <div class="project-image">
                                    <a target="_blank" href="{{$item->image}}"><img src="{{$item->image}}" alt="project"></a>
                                </div>
                            </td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->title }}</td>
                            <td> {!! $item->link ? '<a target="_blank" href="'. $item->link .'">View</a>' : 'N/A' !!}</td>
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
                        @if ($project->items->isEmpty())
                        <tr>
                            <td colspan="8" class="text-center align-middle">No items found.</td>
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
                <form id="addItemForm" method="post" action="{{route('project.item.create')}}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="itemId">
                    <div class="row">
                        <div class="col mb-0">
                            <label for="name" class="form-label">Project Name</label>
                            <input type="text" id="name" class="form-control" placeholder="Project Name" name="name" required />
                        </div>
                        <div class="col mb-0">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" id="project-title" class="form-control" name="title" placeholder="Title" required />
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col mb-0">
                            <label for="project-image" class="form-label">Project Image</label>
                            <input type="file" class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}" id="project-image" name="image" accept=".jpeg, .jpg, .png" />
                        </div>
                        <div class="col mb-0">
                            <div class="about-image">
                               <a target="_blank" href="{{asset('assets/images/default.png')}}"> <img id="image" src="{{asset('assets/images/default.png')}}" alt="about" /></a>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col mb-0">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" class="form-control tinymce-editor {{ $errors->has('description') ? 'is-invalid' : '' }}" id="popup_description" placeholder="Description"></textarea>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col mb-0">
                            <label for="link" class="form-label">Link</label>
                            <input type="text" id="link" class="form-control" placeholder="Link" name="link" />
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
                <form id="addItemForm" method="post" action="{{route('project.item.delete')}}">
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
    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">
       $(document).ready(function () {
            // Initialize DataTables if needed
            var table = $('#projectTable').DataTable();

            // <!-- description -->
            tinymce.init({
                selector: 'textarea#popup_description', // Replace this CSS selector to match the placeholder element for TinyMCE
                height: 300,
                menubar: false,
                plugins: 'code table lists',
                toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
            });

            // Synchronize TinyMCE content with the underlying textarea before form submission
            $('#addItemForm').on('submit', function() {
                alert("hello");
                tinyMCE.triggerSave();
                // Check if the textarea is empty
                var content = document.getElementById('popup_description').value;
                if (content.trim() === '') {
                    alert('description is required.');
                    return false;
                }
            });
        });

        function addNewItem(){
            $('#addItemForm')[0].reset();
            $('#project-image').attr('required', 'required');
            $('#image').attr('src', "{{asset('assets/images/default.png')}}");
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
            console.log("item11", item);
            $('#itemId').val(item.id);
            $('#project-title').val(item.title);
            $('#name').val(item.name);
            // $('#image').val(item.image);
            tinymce.get('popup_description').setContent(item.description); // Set the content of TinyMCE editor
            $('#link').val(item.link);
            $('#status').val(item.status);
            // Set image preview
            $('#project-image').removeAttr('required');
            $('#image').attr('src', item.image);
            
        }
    </script>
