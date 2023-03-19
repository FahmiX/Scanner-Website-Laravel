@extends('bootstrap')

@section('title', 'Login Kasir')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header" style="justify-content:center">
                        Login Kasir
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('kasir.login.submit') }}">
                            @csrf
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required autocomplete="current-password">
                            </div>
                            <div class="gap-2">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>

                            <div class="mt-3 gap-2">
                                <a href="{{ route('kasir.register') }}">Register</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
