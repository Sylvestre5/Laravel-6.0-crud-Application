@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">

    <h5 class="card-header info-color white-text text-center py-4">
        <strong>Log in</strong>
    </h5>

    <div class="card-body">

        <form class="md-form" style="color: #757575;" method="POST" action="{{ route('login') }}">
				@csrf
           <br>
           <label for="materialLoginFormEmail">E-mail</label>
			<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
            
            <br>
            <label for="materialLoginFormPassword">Password</label>
			<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
            


            <div class="d-flex align-items-center justify-content-between">
                <div class="form-check">
				
					 <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                </div>
                <div>
				
					@if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                </div>
            </div>


            <button type="submit" class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0"">
                                    {{ __('Login') }}
                                </button>

        </form>
    </div>
</div>
        </div>
    </div>
</div>
@endsection
