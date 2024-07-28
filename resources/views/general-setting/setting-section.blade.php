<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <form method="POST" action="{{route('general-setting.create')}}" enctype="multipart/form-data">
                @csrf
                @method('POST')
                {{$errors}}
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
                            <label for="header_description" class="form-label">Header Description</label>
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
                        <div class="col-md-12 mt-2">
                            <label for="title">Contact Title</label>
                            <input type="text" class="form-control {{ $errors->has('contact_title') ? 'is-invalid' : '' }}" id="contact_title" name="contact_title" value="{{ $setting->contact_title }}" placeholder="Contact Title" />
                            @if ($errors->has('contact_title'))
                            <span class="invalid-feedback">
                                {{ $errors->first('contact_title') }}
                            </span>
                            @endif
                        </div>
                        <div class="col-md-12 mt-2">
                            <label for="contact_description" class="form-label">Contact Description</label>
                            <textarea name="contact_description" class="form-control tinymce-editor {{ $errors->has('contact_description') ? 'is-invalid' : '' }}" id="description" placeholder="Description">
                            {{ $setting->contact_description }}
                            </textarea>
                            @if ($errors->has('contact_description'))
                            <span class="invalid-feedback">
                                {{ $errors->first('contact_description') }}
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-3">
                            <label for="employment_type">Employment Type</label>
                            <select class="form-control {{ $errors->has('employment_type') ? 'is-invalid' : '' }}" id="employment_type" name="employment_type">
                                <option value="">Select Employment Type</option>
                                @foreach ($employmentTypes as $type)
                                <option value="{{ $type }}" {{ old('employment_type', $setting->employment_type) == $type ? 'selected' : '' }}>
                                    {{ $type }}
                                </option>
                                @endforeach
                            </select>
                            @if ($errors->has('employment_type'))
                            <span class="invalid-feedback">
                                {{ $errors->first('employment_type') }}
                            </span>
                            @endif
                        </div>
                        <div class="col-md-3">
                            <label for="hourly_rate_min">Hourly Min Rate</label>
                            <input type="number" class="form-control {{ $errors->has('hourly_rate_min') ? 'is-invalid' : '' }}" id="hourly_rate_min" name="hourly_rate_min" value="{{ $setting->hourly_rate_min }}" placeholder="" />
                            @if ($errors->has('hourly_rate_min'))
                            <span class="invalid-feedback">
                                {{ $errors->first('hourly_rate_min') }}
                            </span>
                            @endif
                        </div>
                        <div class="col-md-3">
                            <label for="hourly_rate_max">Hourly Max Rate</label>
                            <input type="number" class="form-control {{ $errors->has('hourly_rate_max') ? 'is-invalid' : '' }}" id="hourly_rate_max" name="hourly_rate_max" value="{{ $setting->hourly_rate_max }}" placeholder="0" />
                            @if ($errors->has('hourly_rate_max'))
                            <span class="invalid-feedback">
                                {{ $errors->first('hourly_rate_max') }}
                            </span>
                            @endif
                        </div>
                        <div class="col-md-3">
                            <label for="currency_type">Currency Type</label>
                            <select name="currency_type" id="currency_type" class="form-control {{ $errors->has('currency_type') ? 'is-invalid' : '' }}">
                                <option value="USD">USD ($)</option>
                                <option value="INR">INR (₹)</option>
                            </select>
                            @if ($errors->has('currency_type'))
                            <span class="invalid-feedback">
                                {{ $errors->first('currency_type') }}
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label for="number1">Contact Permanent Number </label>
                            <input type="number" class="form-control {{ $errors->has('number1') ? 'is-invalid' : '' }}" id="number1" name="number1" value="{{ $setting->number1 }}" placeholder="Contact Permanent Number" />
                            @if ($errors->has('number1'))
                            <span class="invalid-feedback">
                                {{ $errors->first('number1') }}
                            </span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label for="number2">Contact Alternate Number </label>
                            <input type="number" class="form-control {{ $errors->has('number2') ? 'is-invalid' : '' }}" id="number2" name="number2" value="{{ $setting->number2 }}" placeholder="Contact Alternate" />
                            @if ($errors->has('number2'))
                            <span class="invalid-feedback">
                                {{ $errors->first('number2') }}
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label for="email1">Contact Permanent Email</label>
                            <input type="email" class="form-control {{ $errors->has('email1') ? 'is-invalid' : '' }}" id="email1" name="email1" value="{{ $setting->email1 }}" placeholder="Contact Permanent Email" />
                            @if ($errors->has('email1'))
                            <span class="invalid-feedback">
                                {{ $errors->first('email1') }}
                            </span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label for="email2">Contact Alternate Email</label>
                            <input type="email" class="form-control {{ $errors->has('email2') ? 'is-invalid' : '' }}" id="email2" name="email2" value="{{ $setting->email2 }}" placeholder="Contact Alternate Email" />
                            @if ($errors->has('email2'))
                            <span class="invalid-feedback">
                                {{ $errors->first('email2') }}
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label for="address">Address </label>
                            <textarea name="address" id="address" class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" placeholder="Address">{{ $setting->address }}</textarea>
                            @if ($errors->has('address'))
                            <span class="invalid-feedback">
                                {{ $errors->first('address') }}
                            </span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label for="city">City </label>
                            <input type="text" class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" id="city" name="city" value="{{ $setting->city }}" placeholder="City" />
                            @if ($errors->has('city'))
                            <span class="invalid-feedback">
                                {{ $errors->first('city') }}
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label for="state">State</label>
                            <input type="text" class="form-control {{ $errors->has('state') ? 'is-invalid' : '' }}" id="state" name="state" value="{{ $setting->state }}" placeholder="State" />
                            @if ($errors->has('state'))
                            <span class="invalid-feedback">
                                {{ $errors->first('state') }}
                            </span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label for="country">Country</label>
                            <input type="text" class="form-control {{ $errors->has('country') ? 'is-invalid' : '' }}" id="country" name="country" value="{{ $setting->country }}" placeholder="Country" />
                            @if ($errors->has('country'))
                            <span class="invalid-feedback">
                                {{ $errors->first('country') }}
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label for="title">Theme Color</label>
                            <input type="color" class="form-control {{ $errors->has('theme_color') ? 'is-invalid' : '' }}" id="theme_color" name="theme_color" value="{{ $setting->theme_color }}" placeholder="Contact Title" />
                            @if ($errors->has('theme_color'))
                            <span class="invalid-feedback">
                                {{ $errors->first('theme_color') }}
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <label for="copyright_description" class="form-label">Copyright Description</label>
                            <textarea name="copyright_description" class="form-control tinymce-editor {{ $errors->has('copyright_description') ? 'is-invalid' : '' }}" id="description" placeholder="copyright_description">
                            {{ $setting->copyright_description }}
                            </textarea>
                            @if ($errors->has('copyright_description'))
                            <span class="invalid-feedback">
                                {{ $errors->first('copyright_description') }}
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