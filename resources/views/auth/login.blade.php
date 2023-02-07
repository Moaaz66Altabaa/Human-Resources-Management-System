<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" type="image/x-icon" href="/assets/img/HR_Logo.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/assets/asset/css/bootstrap.min.css">
		<link rel="stylesheet" href="/assets/asset/css/all.min.css">
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="/assets/css/font-awesome.min.css">


		<!-- Main CSS -->
        <link rel="stylesheet" href="/assets/asset/css/style.css">


    <title>Login</title>
  </head>

  <body class="d-flex text-center bg-secondary">

    <form class="form-login" method="POST" action="{{ route('login') }}">
        @csrf

      <div>
      <img src="/assets/img/hr%20logo%20-%20dark%20blue1.png" alt=""  width="200" class="mb-4" />

      <h1 class="h3 mb-3 font-weight-normal" >Login</h1>
        <br>

          @if(Session::has('signInError'))
              <div class="alert alert-danger">
                  {{ Session::get('signInError') }}
                  @php
                      Session::forget('signInError');
                  @endphp
              </div>
          @endif

      <input class="form-control mb-2 ip-3" placeholder="Email address" id="email" type="email" @error('email') is-invalid @enderror name="email" value="{{ old('email') }}" required autocomplete="email" autofocus />

          @error('email')
          <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
          @enderror

      <input class="form-control mb-2 ip-3" placeholder="Password" id="password" type="password" @error('password') is-invalid @enderror name="password" required autocomplete="current-password" />

          @error('password')
          <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
          @enderror

      <div class="checkbox mb-3">
          <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

          <label class="form-check-label" for="remember">
              {{ __('Remember Me') }}
          </label>
      </div>

          <input type="submit" class="btn btn-lg btn-primary btn-block" value="Login"  />

{{--          @if (Route::has('password.request'))--}}
{{--              <a class="btn btn-link" href="{{ route('password.request') }}">--}}
{{--                  {{ __('Forgot Your Password?') }}--}}
{{--              </a>--}}
{{--          @endif--}}
    </div>
    </form>


  </body>
</html>
