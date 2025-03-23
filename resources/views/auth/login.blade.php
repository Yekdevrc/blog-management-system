@extends('auth.layout')
@section('content')
    <div class="text-center">
        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/lotus.webp" style="width: 185px;"
            alt="logo">
        <h4 class="mt-1 mb-5 pb-1">Sign in</h4>
    </div>

    <form method="post" action="{{ route('login') }}">
        @csrf
        <div class="form-outline mb-4">
            <label class="form-label" for="form2Example11">Email</label>
            <input type="email" name="email" value="{{old('email')}}" id="form2Example11" class="form-control @error('email')
                is-invalid
            @enderror" placeholder="email address" />
            @if ($errors->has('email'))
                <div class="invalid-feedback">
                    {{ $errors->first('email') }}
                </div>
            @endif
        </div>

        <div class="form-outline mb-4">
            <label class="form-label" for="form2Example22">Password</label>
            <input type="password" name="password" id="form2Example22" placeholder="Password" class="form-control @error('password')
                is-invalid                
            @enderror" />
            @if ($errors->has('password'))
                <div class="invalid-feedback">
                    {{ $errors->first('password') }}
                </div>
            @endif
        </div>

        <div class="text-center pt-1 mb-5 pb-1">
            <button type="submit" class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3"
                >Log
                in</button><br>
            @if (Route::has('password.request'))
                <a class="text-muted" href="{{ route('password.request') }}">Forgot password?</a>
            @endif
        </div>
    </form>

        <div class="d-flex align-items-center justify-content-center pb-4">
            <p class="mb-0 me-2">Don't have an account?</p>
            <a href="{{route('register')}}" class="btn btn-outline-danger">Create
                new</a>
        </div>

@endsection
