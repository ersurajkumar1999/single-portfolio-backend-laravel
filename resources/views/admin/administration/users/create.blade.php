@extends('admin.layout.main')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4">
    <span class="text-muted fw-light">Administrator /</span> User / Create
    </h4>
    <div class="row mb-4">
        <div class="col-md-12 mb-4 mb-md-0">
            <div class="card">
            <h5 class="card-header">User Information</h5>
                <div class="card-body">
                    <form class="browser-default-validation" method="POST" action="{{ route('users.store') }}">
                        @csrf
                        <div class="col-12">
                            <h6>1. User Details</h6>
                            <hr class="mt-0">
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label" for="first_name">First Name <span class="input-required">*</span></label>
                                    <input type="text" name="first_name" class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" id="first_name" placeholder="John" value="{{ old('first_name') }}">
                                    @if ($errors->has('first_name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('first_name') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label" for="last_name">Last Name <span class="input-required">*</span></label>
                                    <input type="text" name="last_name" class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" id="last_name" placeholder="Doe" value="{{ old('last_name') }}">
                                    @if ($errors->has('last_name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('last_name') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label" for="username">User Name <span class="input-required">*</span></label>
                                    <input type="text" name="username" class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" id="username" placeholder="john123" value="{{ old('username') }}">
                                    @if ($errors->has('username'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('username') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label" for="email">Email <span class="input-required">*</span></label>
                                    <input type="text" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" placeholder="Doe" value="{{ old('email') }}">
                                    @if ($errors->has('email'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-6">
                                <div class="form-password-toggle">
                                    <label class="form-label" for="password">Password <span class="input-required">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <input
                                            type="password"
                                            class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                            id="password"
                                            name="password"
                                            placeholder="**********"
                                            aria-describedby="basic-default-password"
                                        />
                                        <span class="input-group-text cursor-pointer" id="basic-default-password">
                                            <i class="bx bx-hide"></i>
                                        </span>
                                    </div>
                                    @if ($errors->has('password'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('password') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-password-toggle">
                                    <label class="form-label" for="password_confirmation">Confirm Password <span class="input-required">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <input
                                            type="password"
                                            class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                                            id="password_confirmation"
                                            name="password_confirmation"
                                            placeholder="**********"
                                            aria-describedby="basic-default-password"
                                        />
                                        <span class="input-group-text cursor-pointer" id="basic-default-password">
                                            <i class="bx bx-hide"></i>
                                        </span>
                                    </div>
                                    @if ($errors->has('password_confirmation'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('password_confirmation') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <h6>2. Account Setting</h6>
                                <hr class="mt-0">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label" for="role">Role </label>
                                    <select name="role" id="role" class="form-control">
                                        <option value="">Select Role</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
@section('js_script')
    @include('admin.administration.users.script')
@endsection
