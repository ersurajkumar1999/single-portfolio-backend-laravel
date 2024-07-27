<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <form method="POST" action="{{route('about.create')}}" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <h5 class="card-header">Head Information</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="header_title">Header Title</label>
                            <input type="text" class="form-control {{ $errors->has('header_title') ? 'is-invalid' : '' }}" id="header_title" name="header_title" value="{{ $setting->header_title }}" placeholder="Header Title" />
                            @if ($errors->has('header_title'))
                            <span class="invalid-feedback">
                                {{ $errors->first('header_title') }}
                            </span>
                            @endif
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="banner-image" class="form-label">Banner Image</label>
                            <input type="file" class="form-control {{ $errors->has('banner_image') ? 'is-invalid' : '' }}" id="banner-image" name="banner_image" accept=".jpeg, .jpg, .png" />
                            @if ($errors->has('banner_image'))
                            <span class="invalid-feedback">
                                {{ $errors->first('banner_image') }}
                            </span>
                            @endif
                        </div>
                        <div class="col-md-6 mt-2">
                            <div class="bannert-image">
                                <a target="_blank" href="{{$setting->banner_image}}"> <img src="{{$setting->banner_image}}" alt="about" /></a>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="header_description" class="form-label">Description</label>
                            <textarea name="header_description" class="form-control tinymce-editor {{ $errors->has('header_description') ? 'is-invalid' : '' }}" id="description" placeholder="Header Description">
                            {{ $setting->header_description }}
                            </textarea>
                            @if ($errors->has('header_description'))
                            <span class="invalid-feedback">
                                {{ $errors->first('header_description') }}
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <hr>
                <h5 class="card-header">General Setting Information</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="title">Title</label>
                            <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" id="title" name="title" value="{{ $setting->title }}" placeholder="Title" />
                            @if ($errors->has('title'))
                            <span class="invalid-feedback">
                                {{ $errors->first('title') }}
                            </span>
                            @endif
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
                                <a target="_blank" href="{{$setting->image}}"> <img src="{{$setting->image}}" alt="about" /></a>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div>
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" class="form-control tinymce-editor {{ $errors->has('description') ? 'is-invalid' : '' }}" id="description" placeholder="Description">
                                {{ $setting->description }}
                                </textarea>
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