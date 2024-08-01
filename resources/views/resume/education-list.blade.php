<div class="row">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header">Educations List</h5>
            <div class="add-new-btn">
                <button type="button" class="btn btn-primary add-education" id="add-education"><i class='bx bx-plus-medical'></i></button>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table" id="educationTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Course Name</th>
                            <th>Batch</th>
                            <th>Course Content</th>
                            <th>Status</th>
                            <th>Last Updated</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($educations as $key=> $education)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $education->course_name }}</td>
                            <td>{{ $education->batch }}</td>
                            <td>{!! $education->course_content !!}</td>
                            <td>
                                <span class="{{ $education->status == 1 ? 'text-success' : 'text-danger' }}">
                                    {{ $education->status == 1 ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>{{ $education->updated_at->format('d-m-Y h:i A') }}</td>
                            <td>
                                <a href="javascript:void(0)" class="edit-education" data-item="{{ json_encode($education) }}"><i class='edit-icon bx bxs-edit-alt'></i></a>
                                <a href="javascript:void(0)" class="delete-education" data-item="{{$education}}"><i class='delete-icon bx bxs-trash'></i></a>
                            </td>
                        </tr>
                        @endforeach
                        @if ($educations->isEmpty())
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
<div class="modal fade" id="addeducationFormModal" tabindex="-1" role="dialog" aria-labelledby="addIeducationFormModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title item-heading"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addEducationForm" method="post" action="{{route('education.create')}}">
                    @csrf
                    <input type="hidden" name="id" id="educationId">
                    <div class="row g-2">
                        <div class="col mb-0">
                            <label for="course_name" class="form-label">Course Name</label>
                            <input type="text" id="course_name" class="form-control" placeholder="Course Name" name="course_name" required />
                        </div>
                        <div class="col mb-0">
                            <label for="batch" class="form-label">Batch</label>
                            <input type="text" id="batch" class="form-control" placeholder="Batch" name="batch" required />
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col mb-0">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="education_status" class="form-control" required>
                                <option value="1">Active</option>
                                <option value="0">In Active</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col mb-0">
                            <label for="course_content" class="form-label">Course Content</label>
                            <textarea name="course_content" class="form-control tinymce-editor {{ $errors->has('course_content') ? 'is-invalid' : '' }}" id="course_content" placeholder="Course Content"></textarea>
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
<div class="modal fade" id="deleteEducationFormModal" tabindex="-1" role="dialog" aria-labelledby="deleteEducationFormModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title item-heading"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="deleteEducationForm" method="post" action="{{route('education.delete')}}">
                    @csrf
                    <input type="hidden" name="delete_education_id" id="deleteEducationId">

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
        var table = $('#educationTable').DataTable()
        tinymce.init({
            selector: 'textarea#course_content', // Replace this CSS selector to match the placeholder element for TinyMCE
            height: 300,
            menubar: false,
            plugins: 'code table lists',
            toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
        });

        // Synchronize TinyMCE content with the underlying textarea before form submission
        $('#addEducationForm').on('submit', function() {
            tinyMCE.triggerSave();
            var content = document.getElementById('course_content').value;
            if (content.trim() === '') {
                alert('Course Content is required.');
                return false;
            }
        });

        $('.add-education').on('click', function(e) {
            $('#addEducationForm')[0].reset();
            $('.item-heading').html("Add New Education");
            let model = $('#addeducationFormModal');
            model.modal('show');

        });
        $('.edit-education').on('click', function(e) {
            var item = $(this).data('item');
            $('#addEducationForm')[0].reset();
            $('.item-heading').html("Update Education11");
            $('#educationId').val(item.id);
            $('#course_name').val(item.course_name);
            $('#batch').val(item.batch);
            $('#education_status').val(item.status);
            tinymce.get('course_content').setContent(item.course_content);
        
            let model = $('#addeducationFormModal');
            model.modal('show');

        });
        $('.delete-education').on('click', function(e) {
            $('.item-heading').html("Confirm Education Deletion");
            var item = $(this).data('item');
            $('#deleteEducationId').val(item.id);
            $('#deleteEducationForm')[0].reset();
            let model = $('#deleteEducationFormModal');
            model.modal('show');
        });
    });
</script>