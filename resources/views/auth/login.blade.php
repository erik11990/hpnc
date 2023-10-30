@extends('auth.app')

@section('content')
    <div class="card-body login-card-body">
        <p class="login-box-msg">Inicial sesión</p>
        <form method="POST" action="{{ route('login') }}">
            @if (session('error'))
                <div id="errorAlert" class="alert alert-danger">
                    {{ session('error') }}
                </div>

                <script>
                    setTimeout(function() {
                        document.getElementById('errorAlert').style.display = 'none';
                    }, 3000);
                </script>
            @endif
            @csrf
            <div class="input-group mb-3">
                <input placeholder="Email" id="email" type="email"
                    class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
                    required autocomplete="email" autofocus>

                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="input-group mb-3">
                <input placeholder="Password" id="password" type="password"
                    class="form-control @error('password') is-invalid @enderror" name="password" required
                    autocomplete="current-password">

                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block">Iniciar sesión</button>
                </div>

            </div>
        </form>
        <p class="mb-0">
            <a href="{{ url('crearusuario') }}" class="text-center">Registrar cuenta</a>
        </p>
    </div>
@endsection
