@extends('bootstrap')

@section('title', 'Registrasi Kasir')

@section('content')
<div class="container-fluid">
    <div class="row vh-100 justify-content-center align-items-center">
        <div class="col-lg-4 col-md-8 col-12">
            <div class="card shadow">
                <div class="card-header">
                    <h3 class="text-center">Registrasi Kasir</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('kasir.register.submit') }}">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                        </div>

                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email">
                        </div>

                        <div class="form-group mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
                        </div>

                        <div class="form-group mb-3">
                            <label for="password-confirm" class="form-label">Confirm Password</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary w-100">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
