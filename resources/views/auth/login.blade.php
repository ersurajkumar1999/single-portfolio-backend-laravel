@extends('auth.layout.index')
@section('content')
    <h4 class="mb-2">Welcome to Portfolio! 👋</h4>
    <p class="mb-4">Please sign-in to your account and start the adventure</p>

    <form class="mb-3" action="{{ route('auth.login') }}" method="POST"  >
        @csrf
    <div class="mb-3">
        <label for="email" class="form-label">Email or Username</label>
        <input
        type="text"
        class="form-control @error('email') is-invalid @enderror"
        id="email"
        name="email"
        value="{{ old('email') }}"
        placeholder="Enter your email or username"
        autofocus />
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
    </div>
    <div class="mb-3 form-password-toggle">
        <div class="d-flex justify-content-between">
        <label class="form-label" for="password">Password</label>
        <!-- <a href="auth-forgot-password-basic.html">
            <small>Forgot Password?</small>
        </a> -->
        </div>
        <div class="input-group input-group-merge">
        <input
            type="password"
            id="password"
            class="form-control @error('password') is-invalid @enderror"
            name="password"
            placeholder=""

            aria-describedby="password"
            />
            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="mb-3">
        <div class="form-check">
        <input class="form-check-input" type="checkbox" id="remember-me" name="remember"/>
        <label class="form-check-label" for="remember-me"> Remember Me </label>
        </div>
    </div>
    <div class="mb-3">

        <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
    </div>
    </form>
@endsection

@section('js_script')
    @include('auth.script');
@endsection
