<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <h5 class="card-header">Profile Information</h5>
            <form method="POST" action="{{route('about.create')}}" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="title">Name</label>
                            <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" name="name" value="{{ $user->name }}" placeholder="Name" />
                            @if ($errors->has('name'))
                            <span class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label for="title">User Name</label>
                            <input type="text" class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" id="username" name="username" value="{{ $user->username }}" placeholder="User Name" />
                            @if ($errors->has('username'))
                            <span class="invalid-feedback">
                                {{ $errors->first('username') }}
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label for="gender">Gender</label>
                            <select class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" id="gender" name="gender">
                                <option value="">Please select</option>
                                <option value="Male" {{ $user->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ $user->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                <option value="Other" {{ $user->gender == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @if ($errors->has('gender'))
                            <span class="invalid-feedback">
                                {{ $errors->first('gender') }}
                            </span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label for="dob">Date Of Birth</label>
                            <input type="date" class="form-control {{ $errors->has('dob') ? 'is-invalid' : '' }}" id="dob" name="dob" value="{{ $user->dob }}" />
                            @if ($errors->has('dob'))
                            <span class="invalid-feedback">
                                {{ $errors->first('dob') }}
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label for="profile-image" class="form-label">Profile Image</label>
                            <input type="file" class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}" id="profile-image" name="image" accept=".jpeg, .jpg, .png" />
                            @if ($errors->has('image'))
                            <span class="invalid-feedback">
                                {{ $errors->first('image') }}
                            </span>
                            @endif
                        </div>
                        <div class="col-md-6 mt-2">
                            <div class="about-image">
                                <a target="_blank" href="{{$user->image}}"> <img src="{{$user->image}}" alt="about" /></a>
                            </div>
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