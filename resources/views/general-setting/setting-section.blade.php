<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <h5 class="card-header">Setting Information</h5>
            <form method="POST" action="{{route('about.create')}}" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div>
                                <label for="title">Title</label>
                                <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" id="title" name="title" value="{{ $about->title }}" placeholder="Title" />
                                @if ($errors->has('title'))
                                <span class="invalid-feedback">
                                    {{ $errors->first('title') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 mt-2">
                            <div>
                                <label for="about-image" class="form-label">About Image</label>
                                <input type="file" class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}" id="about-image" name="image" accept=".jpeg, .jpg, .png" />
                                @if ($errors->has('image'))
                                <span class="invalid-feedback">
                                    {{ $errors->first('image') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 mt-2">
                            <div class="about-image">
                                <!-- <img src="{{asset('assets/images/default.png')}}" alt="about" /> -->
                               <a target="_blank" href="{{$about->image}}"> <img src="{{$about->image}}" alt="about" /></a>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div>
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" class="form-control tinymce-editor {{ $errors->has('description') ? 'is-invalid' : '' }}" id="description" placeholder="Description">
                                {{ $about->description }}
                                </textarea>
                                <!-- <textarea class="tinymce-editor" id="myeditorinstance" name="body"></textarea> -->
                                @if ($errors->has('description'))
                                <span class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </span>
                                @endif
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
