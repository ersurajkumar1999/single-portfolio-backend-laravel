<div class="row">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header">Testimonial List</h5>
            <div class="add-new-btn">
                <button type="button" class="btn btn-primary add-item"><i class='bx bx-plus-medical'></i></button>
            </div>
            <div class="table-responsive responsive text-nowrap">
                <table class="table table-responsive" id="testimonialTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Developer Name</th>
                            <th>Profession</th>
                            <th>Feedback</th>
                            <th>Rating</th>
                            <th>Status</th>
                            <th>Last Updated</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($testimonial->items as $key=> $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>
                                <div class="project-image">
                                    <a target="_blank" href="{{$item->image}}"><img src="{{$item->image}}" alt={{ $item->name }}></a>
                                </div>
                            </td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->profession }}</td>
                            <td>{!! $item->feedback !!}</td>
                            <td>{{ $item->start }} / 5</td>
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
                        @if ($testimonial->items->isEmpty())
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
                <form id="addItemForm" method="post" action="{{route('testimonial.item.create')}}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="itemId">
                    <div class="row g-2">
                        <div class="col mb-0">
                            <label for="name" class="form-label">Developer Name</label>
                            <input type="text" id="name" class="form-control" placeholder="Developer Name" name="name" required />
                        </div>
                        <div class="col mb-0">
                            <label for="profession" class="form-label">Developer Profession</label>
                            <input type="text" id="profession" class="form-control" name="profession" placeholder="Developer Profession" required />
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col mb-0">
                            <label for="client-image" class="form-label">Client Image</label>
                            <input type="file" class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}" id="client-image" name="image" accept=".jpeg, .jpg, .png" />
                        </div>
                        <div class="col mb-0">
                            <div class="about-image">
                               <a target="_blank" href="{{asset('assets/images/default.png')}}"> <img id="image" src="{{asset('assets/images/default.png')}}" alt="about" /></a>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col mb-0">
                            <label for="dobBasic" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="1">Active</option>
                                <option value="0">In Active</option>
                            </select>
                        </div>
                        <div class="col mb-0">
                            <label for="start" class="form-label">Rating</label>
                            <select name="start" id="start" class="form-control"  required>
                                <option value="0">Select Rating</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col mb-0">
                            <label for="feedback" class="form-label">Description</label>
                            <textarea name="feedback" class="form-control tinymce-editor {{ $errors->has('description') ? 'is-invalid' : '' }}" id="popup_description" placeholder="Description"></textarea>
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
                <form id="addItemForm" method="post" action="{{route('testimonial.item.delete')}}" >
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
       $(document).ready(function () {
            // Initialize DataTables if needed
            var table = $('#testimonialTable').DataTable()
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
                tinyMCE.triggerSave();
                // Check if the textarea is empty
                var content = document.getElementById('popup_description').value;
                if (content.trim() === '') {
                    alert('description is required.');
                    return false;
                }
            });

            $('.add-item').on('click', function (e) {
                $('#addItemForm')[0].reset();
                $('.item-heading').html("Add New Item");
                let model = $('#addItemFormModal');
                model.modal('show');

            });

            $('.edit-item').on('click', function (e) {
                var item = $(this).data('item');
                $('#addItemForm')[0].reset();
                $('.item-heading').html("Update Item");
                setItemValue(item);
                let model = $('#addItemFormModal');
                model.modal('show');

            });
            $('.delete-item').on('click', function (e) {
                $('.item-heading').html("Confirm Item Deletion");
                var item = $(this).data('item');
                $('#deleteItemId').val(item.id);
                $('#addItemForm')[0].reset();
                let model = $('#deleteItemFormModal');
                model.modal('show');
            });
        });

        function addNewItem(){
            $('#addItemForm')[0].reset();
            $('.item-heading').html("Add New Item");
            let model = $('#addItemFormModal');
            model.modal('show');
        }
       
        function setItemValue(item) {
            $('#itemId').val(item.id);
            $('#name').val(item.name);
            $('#profession').val(item.profession);
            // For the image, you can set the src attribute of the img tag
            $('#image').attr('src', item.image);
            tinymce.get('popup_description').setContent(item.feedback);
            $('#status').val(item.status);
            $('#start').val(item.start);
            $('#popup_description').val(item.feedback);
        }
    </script>
