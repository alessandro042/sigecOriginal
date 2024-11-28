@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="container-fluid d-flex justify-content-center align-items-center min-vh-100">
    <div class="row justify-content-center w-100">
        <div class="col-md-4">
            <div class="card shadow-lg border-0 rounded-3" style="background: rgba(255, 255, 255, 0.85);">
                <div class="card-header text-center rounded-top">
                    <h2 class="active">{{ __('Login') }}</h2>
                </div>
                <div class="card-body p-4">
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <form id="login-form" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email Address') }}</label>
                            <div class="input-group">
                                <span class="input-group-text" id="email-addon"><i class="bi bi-envelope"></i></span>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus aria-describedby="email-addon">
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <div class="input-group">
                                <span class="input-group-text" id="password-addon"><i class="bi bi-lock"></i></span>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" aria-describedby="password-addon">
                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>

                        <div class="d-grid mb-3">
                            <input type="submit" class="fadeIn fourth btn btn-primary" value="{{ __('Login') }}" style="cursor: pointer;">
                        </div>

                        @if (Route::has('password.request'))
                        <div class="text-center">
                            <a class="underlineHover" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('login-form').addEventListener('submit', function(event) {
            event.preventDefault(); // Evita el envío normal del formulario

            let form = event.target;
            let formData = new FormData(form);

            fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.redirect) {
                        Swal.fire({
                            title: 'Éxito!',
                            text: data.success || '¡Inicio de sesión exitoso!',
                            icon: 'success',
                            confirmButtonText: 'Ok',
                            confirmButtonColor: '#3085d6',
                            background: '#f4f4f9',
                            titleColor: '#333',
                            textColor: '#555'
                        }).then(function() {
                            window.location.href = data.redirect;
                        });
                    } else if (data.error) {
                        Swal.fire({
                            title: 'Error!',
                            text: data.error || 'Ocurrió un error al iniciar sesión.',
                            icon: 'error',
                            confirmButtonText: 'Ok',
                            confirmButtonColor: '#d33',
                            background: '#f4f4f9',
                            titleColor: '#333',
                            textColor: '#555'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    });
</script>
@endsection
@endsection