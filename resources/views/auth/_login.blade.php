@extends('layouts.default')
@section('title', 'Login')
@section('content')

    <div class="container">

        <form action="{{ route('signIn') }}" method="POST">
            @csrf
            @error('failed')
                <p class="error">{{ $message }}</p>
            @enderror
            <div class="mb-3">
                <label for="userInputEmail" class="form-label">Email </label>
                <input type="email" name="email" required class="form-control error" id="userInputEmail"
                    aria-describedby="emailHelp">

            </div>
            <div class="mb-3">
                <label for="inputPassword" class="form-label">Password</label>
                <input type="password" name="password" required class="form-control error" id="inputPassword">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" name="rememberMe" class="form-check-input" id="rememberMe">
                <label class="form-check-label" for="rememberMe">Remember me?</label>
            </div>
            <button type="submit" class="btn btn-primary">Sign In</button>
        </form>
    </div>
@endsection
