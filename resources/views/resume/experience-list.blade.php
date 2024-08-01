<div class="row">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header">Experience List</h5>
            <div class="add-new-btn">
                <button type="button" class="btn btn-primary add-experience" id="add-experience"><i class='bx bx-plus-medical'></i></button>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table" id="linkTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Job Role</th>
                            <th>Duration</th>
                            <th>Location</th>
                            <th>Job Description</th>
                            <th>Status</th>
                            <th>Last Updated</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($experiences as $key=> $experience)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $experience->job_role }}</td>
                            <td>{{ $experience->duration }}</td>
                            <td>{{ $experience->location }}</td>
                            <td>{!! $experience->job_description !!}</td>
                            <td>
                                <span class="{{ $experience->status == 1 ? 'text-success' : 'text-danger' }}">
                                    {{ $experience->status == 1 ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>{{ $experience->updated_at->format('d-m-Y h:i A') }}</td>
                            <td>
                                <a href="javascript:void(0)" class="edit-experience" data-item="{{ json_encode($experience) }}"><i class='edit-icon bx bxs-edit-alt'></i></a>
                                <a href="javascript:void(0)" class="delete-experience" data-item="{{$experience}}"><i class='delete-icon bx bxs-trash'></i></a>
                            </td>
                        </tr>
                        @endforeach
                        @if ($experiences->isEmpty())
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
<div class="modal fade" id="addExperienceFormModal" tabindex="-1" role="dialog" aria-labelledby="addExperienceFormModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title item-heading"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addExperienceForm" method="post" action="{{route('experience.create')}}">
                    @csrf
                    <input type="hidden" name="id" id="experienceId">
                    <div class="row g-2">
                        <div class="col mb-0">
                            <label for="job_role" class="form-label">Job Role</label>
                            <input type="text" id="job_role" class="form-control" placeholder="Job Role" name="job_role" required />
                        </div>
                        <div class="col mb-0">
                            <label for="duration" class="form-label">Duration</label>
                            <input type="text" id="duration" class="form-control" placeholder="Duration" name="duration" required />
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col mb-0">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" id="location" class="form-control" placeholder="Location" name="location" required />
                        </div>
                        <div class="col mb-0">
                            <label for="dobBasic" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="1">Active</option>
                                <option value="0">In Active</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col mb-0">
                            <label for="job_description" class="form-label">Job Description</label>
                            <textarea name="job_description" class="form-control tinymce-editor {{ $errors->has('job_description') ? 'is-invalid' : '' }}" id="job_description" placeholder="Job Description"></textarea>
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
<div class="modal fade" id="deleteExperienceFormModal" tabindex="-1" role="dialog" aria-labelledby="deleteExperienceFormModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title item-heading"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addExperienceForm" method="post" action="{{route('experience.delete')}}">
                    @csrf
                    <input type="hidden" name="delete_experience_id" id="deleteexperienceId">

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
        tinymce.init({
            selector: 'textarea#job_description', // Replace this CSS selector to match the placeholder element for TinyMCE
            height: 300,
            menubar: false,
            plugins: 'code table lists',
            toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
        });

        // Synchronize TinyMCE content with the underlying textarea before form submission
        $('#addExperienceForm').on('submit', function() {
            tinyMCE.triggerSave();
            // Check if the textarea is empty
            var content = document.getElementById('job_description').value;
            if (content.trim() === '') {
                alert('Job Description is required.');
                return false;
            }
        });

        $('.add-experience').on('click', function(e) {
            $('#addExperienceForm')[0].reset();
            $('.item-heading').html("Add New Experience");
            let model = $('#addExperienceFormModal');
            model.modal('show');

        });
        $('.edit-experience').on('click', function(e) {
            var item = $(this).data('item');
            $('#addExperienceForm')[0].reset();
            $('.item-heading').html("Update Experience");
            setItemValue(item);
            let model = $('#addExperienceFormModal');
            model.modal('show');

        });
        $('.delete-experience').on('click', function(e) {
            $('.item-heading').html("Confirm Experience Deletion");
            var item = $(this).data('item');
            $('#deleteexperienceId').val(item.id);
            $('#addExperienceForm')[0].reset();
            let model = $('#deleteExperienceFormModal');
            model.modal('show');
        });
    });

    function setItemValue(item) {
        $('#experienceId').val(item.id);
        $('#job_role').val(item.job_role);
        $('#duration').val(item.duration);
        $('#location').val(item.location);
        tinymce.get('job_description').setContent(item.job_description);
        $('#status').val(item.status);
    }
</script>