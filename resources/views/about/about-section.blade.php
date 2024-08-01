<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <h5 class="card-header">About Information</h5>
            <form method="POST" action="{{route('about.create')}}" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="title">Title</label>
                            <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" id="title" name="title" value="{{ $about->title }}" placeholder="Title" />
                            @if ($errors->has('title'))
                            <span class="invalid-feedback">
                                {{ $errors->first('title') }}
                            </span>
                            @endif
                        </div>
                        <div class="col-md-12">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" class="form-control tinymce-editor {{ $errors->has('description') ? 'is-invalid' : '' }}" id="description" placeholder="Description">
                            {{ $about->description }}
                            </textarea>
                            @if ($errors->has('description'))
                            <span class="invalid-feedback">
                                {{ $errors->first('description') }}
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <label for="my_title">My Title</label>
                            <input type="text" class="form-control {{ $errors->has('my_title') ? 'is-invalid' : '' }}" id="my_title" name="my_title" value="{{ $about->my_title }}" placeholder="My Title" />
                            @if ($errors->has('my_title'))
                            <span class="invalid-feedback">
                                {{ $errors->first('my_title') }}
                            </span>
                            @endif
                        </div>
                        <div class="col-md-12">
                            <label for="my_description" class="form-label">My Description</label>
                            <textarea name="my_description" class="form-control tinymce-editor {{ $errors->has('my_description') ? 'is-invalid' : '' }}" id="description" placeholder="My Description">
                            {{ $about->my_description }}
                            </textarea>
                            @if ($errors->has('my_description'))
                            <span class="invalid-feedback">
                                {{ $errors->first('my_description') }}
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-check" style="float: right;">
                                <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
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