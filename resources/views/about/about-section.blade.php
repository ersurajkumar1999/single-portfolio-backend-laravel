<div class="row">
    <div class="col-md-12">
    <div class="card mb-4">
        <h5 class="card-header">About Information</h5>
        <form method="POST" action="{{route('about.create')}}">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="row">
            <div class="col-md-6">
                <div>
                    <label for="name">Name</label>
                    <input
                    type="text"
                    class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                    id="name"
                    name="name"
                    value=""
                    placeholder="Role Name" />
                    @if ($errors->has('name'))
                        <span class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div>
                    <label for="display_name" class="form-label">Display Name</label>
                    <input
                    type="text"
                    class="form-control"
                    id="display_name"
                    name="display_name"
                    value=""
                    placeholder="Display Name" />
                    <!-- <span> We'll never share your details with anyone else.</span> -->
                </div>
            </div>
            <div class="col-md-12">
                <div>
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description"  class="form-control" id="description" placeholder="Description">description</textarea>

                    <!-- <span>  We'll never share your details with anyone else.</span> -->
                </div>
            </div>
            </div>
        </div>
        <div class="card-footer text-muted">
            <div class="row">
            <div class="col-md-12">
                <div class="form-check" style="float: right;">
                <a href="{{route('about.index')}}" class="btn btn-primary">Back</a>
                <input type="hidden" name="type" value="role">
                <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
            </div>
        </div>
        </form>
    </div>
    </div>
</div>
