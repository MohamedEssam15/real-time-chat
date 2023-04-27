@extends('layouts.app')
@section('title', 'SignUp')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/login_style.css') }}">
@endsection
@section('content')
<div class="login-box">
    <h2>Sign in</h2>
    <form method="post" action="{{route('signin')}}">
    @csrf
      <div class="user-box">
        <input type="text" name="email" required="">
        <label>Email</label>
      </div>
      <div class="user-box">
        <input type="password" name="password" required="">
        <label>Password</label>
      </div>
      <div class="user-box">
        <a href="{{ route('signup') }}">Register Now</a>
      </div>


      <input type="submit" value="login">

    </form>
  </div>
@endsection
