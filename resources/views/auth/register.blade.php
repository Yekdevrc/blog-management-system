@extends('auth.layout')
@section('content')
    <div class="text-center">
        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/lotus.webp" style="width: 185px;"
            alt="logo">
        <h4 class="mt-1 mb-5 pb-1">create new account</h4>
    </div>

    <form method="post" action="{{ route('register') }}">
        @csrf
        <div class="form-outline mb-4">
            <label class="form-label" for="form2Example11">Name <span class="text-danger"> *</span></label>
            <input type="text" name="name" value="{{old('name')}}" id="form2Example11" class="form-control @error('name')
                is-invalid
            @enderror" placeholder="Full name" />
            @if ($errors->has('name'))
                <div class="invalid-feedback">
                    {{ $errors->first('name') }}
                </div>
            @endif
        </div>
        <div class="form-outline mb-4">
            <label class="form-label" for="form2Example11">Email <span class="text-danger"> *</span></label>
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
            <label class="form-label" for="form2Example22">Password <span class="text-danger"> *</span></label>
            <input type="password" name="password" id="form2Example22" placeholder="Password" class="form-control @error('password')
                is-invalid                
            @enderror" />
            @if ($errors->has('password'))
                <div class="invalid-feedback">
                    {{ $errors->first('password') }}
                </div>
            @endif
        </div>

        <div class="form-outline mb-4">
            <label class="form-label" for="form2Example22">Confirmed Password <span class="text-danger"> *</span></label>
            <input type="password" name="password_confirmation" id="form2Example22" placeholder="Password" class="form-control @error('password_confirmation')
                is-invalid                
            @enderror" />
            @if ($errors->has('password_confirmation'))
                <div class="invalid-feedback">
                    {{ $errors->first('password_confirmation') }}
                </div>
            @endif
        </div>

        <div class="text-center pt-1 mb-5 pb-1">
            <button type="submit" class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3"
                >Create new account</button>
        </div>
    </form>

        <div class="d-flex align-items-center justify-content-center pb-4">
            <p class="mb-0 me-2">already have an account?</p>
            <a href="{{route('login')}}" class="btn btn-outline-danger">sign in</a>
        </div>

@endsection
