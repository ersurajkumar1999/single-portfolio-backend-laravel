<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <form method="POST" action="{{route('resume.create')}}" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <h5 class="card-header">Resume Information</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="title">Title</label>
                            <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" id="title" name="title" value="{{ $resume->title }}" placeholder="Title" />
                            @if ($errors->has('title'))
                            <span class="invalid-feedback">
                                {{ $errors->first('title') }}
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label for="resume" class="form-label">Resume (PDF)</label>
                            <input type="file" class="form-control {{ $errors->has('resume') ? 'is-invalid' : '' }}" id="resume" name="resume" accept=".pdf" />
                            @if ($errors->has('resume'))
                            <span class="invalid-feedback">
                                {{ $errors->first('resume') }}
                            </span>
                            @endif
                        </div>
                        @if($resume->resume)
                            <div class="col-md-6 justify-content-center mt-4">
                                <div class="row">
                                    <div class="col-md-4 col-lg-4 col-4">
                                        <div class="d-flex flex-column align-items-center">
                                            <a href="{{ $resume->resume }}" target="_blank" class="btn btn-primary mb-2">Preview Resume</a>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4 col-4">
                                        <div class="d-flex flex-column align-items-center">
                                            <a href="{{ $resume->resume }}" download class="btn btn-secondary">Download Resume</a>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4 col-4">
                                        <div class="d-flex flex-column align-items-center">
                                        <a href="{{ route('remove.pdf.create') }}" onclick="return confirm('Are you sure you want to remove your resume?')" class="btn btn-danger">Remove Resume</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="row  mt-2">
                        <div class="col-md-12">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" class="form-control tinymce-editor {{ $errors->has('description') ? 'is-invalid' : '' }}" id="description" placeholder="Description">
                            {{ $resume->description }}
                            </textarea>
                            @if ($errors->has('description'))
                            <span class="invalid-feedback">
                                {{ $errors->first('description') }}
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <hr>
                <h5 class="card-header">Sumary Information</h5>
                <div class="card-body">
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label for="education_heading">Education Heading</label>
                            <input type="text" class="form-control {{ $errors->has('education_heading') ? 'is-invalid' : '' }}" id="education_heading" name="education_heading" value="{{ $resume->education_heading }}" placeholder="Education Heading" />
                            @if ($errors->has('education_heading'))
                            <span class="invalid-feedback">
                                {{ $errors->first('education_heading') }}
                            </span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label for="experience_heading">Experience Heading</label>
                            <input type="text" class="form-control {{ $errors->has('experience_heading') ? 'is-invalid' : '' }}" id="experience_heading" name="experience_heading" value="{{ $resume->experience_heading }}" placeholder="Experience Heading" />
                            @if ($errors->has('experience_heading'))
                            <span class="invalid-feedback">
                                {{ $errors->first('experience_heading') }}
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label for="summary_heading">Summary Heading</label>
                            <input type="text" class="form-control {{ $errors->has('summary_heading') ? 'is-invalid' : '' }}" id="summary_heading" name="summary_heading" value="{{ $resume->summary_heading }}" placeholder="Summary Heading" />
                            @if ($errors->has('summary_heading'))
                            <span class="invalid-feedback">
                                {{ $errors->first('summary_heading') }}
                            </span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label for="summary_title">Summary Title</label>
                            <input type="text" class="form-control {{ $errors->has('summary_title') ? 'is-invalid' : '' }}" id="summary_title" name="summary_title" value="{{ $resume->summary_title }}" placeholder="Summary Title" />
                            @if ($errors->has('summary_title'))
                            <span class="invalid-feedback">
                                {{ $errors->first('summary_title') }}
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <label for="summary_content" class="form-label">Summary Content</label>
                            <textarea name="summary_content" class="form-control tinymce-editor {{ $errors->has('summary_content') ? 'is-invalid' : '' }}" id="description" placeholder="Summary Content">
                            {{ $resume->summary_content }}
                            </textarea>
                            @if ($errors->has('summary_content'))
                            <span class="invalid-feedback">
                                {{ $errors->first('summary_content') }}
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
