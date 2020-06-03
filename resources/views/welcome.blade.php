@extends('layouts.master')

@section('title')
Welcome !
@endsection

@section('content')
@include('includes.error-block')
<div class="row">
    <div class="col-md-6">
        <h4>Sign Up</h4>
        <form method="post" action="{{ route('signup') }}">
            @csrf
            <div class="form-group">
                <label for="signup_email">Email address</label>
                <input type="email" class="form-control" id="signup_email" name="email" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="signup_name">Name</label>
                <input type="text" class="form-control" id="signup_name" name="first_name" placeholder="Enter Your Name">
            </div>
            <div class="form-group">
                <label for="signup_password">Password</label>
                <input type="password" class="form-control" id="signup_password" name="password" placeholder="Enter Password">
            </div>
            <button type="submit" class="btn btn-outline-info">SignUp</button>
        </form>
    </div>
    <div class="col-md-6">
        <form action="{{ route('login') }}" method="post">
            @csrf
            <h4>Log In</h4>
            <div class="form-group">
                <label for="login_email">Email address</label>
                <input type="email" class="form-control" id="login_email" name="email" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="login_password">Password</label>
                <input type="password" class="form-control" id="login_password" name="password" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-outline-primary">Login</button>
        </form>
    </div>
</div>
@endsection