@extends('layouts.app')
@section('title', 'SignUp')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/login_style.css') }}">
@endsection
@section('content')
    <div class="login-box">
        <h2>Sign Up</h2>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Oh snap!</strong> {{ $error }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

            @endforeach
        @endif
        <form method="post" action="{{ route('signup') }}">
            @csrf
            <div class="user-box">
                <input type="text" name="name" required="">
                <label>Name</label>
            </div>
            <div class="user-box">
                <input type="text" name="email" required="">
                <label>Email</label>
            </div>
            <div class="user-box">
                <input type="password" name="password" required="">
                <label>Password</label>
            </div>
            <div class="user-box">
                <a href="{{ route('login') }}">I have account</a>
            </div>


            <input type="submit" value="Sign up">
        </form>

    </div>
@endsection
