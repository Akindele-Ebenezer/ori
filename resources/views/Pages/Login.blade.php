@extends('Layouts.Layout-1')
@php session()->put('APP_NAME', 'VESSEL AVAILABILITY') @endphp
@section('Title', 'Login - ' . session()->get('APP_NAME')) 

@section('Content')
    <div class="company-logo">
        <img src="{{ asset('Images/company-logo.png') }}" alt="">
    </div>
    <div class="loader-2" style="visibility: hidden;">
        <div class="x">
            <img src="{{ asset('images/loader-2.gif') }}" alt=""> 
        </div>
        <div>
            <p></p>
            <h2>MARINE SERVICE</h2>
            <h3>software solutions</h3>
        </div>
    </div>
    @include('Components.Loader.Loader1')
    <div class="Login" style="transition: background-image 4s ease; background-image: url('{{ asset('images/bg-2.jpg') }}'); background-size: cover; background-position: center">
        <div class="inner"> 
            <form class="LoginForm" action="{{ route('Auth') }}" method="POST">
                @csrf
                <img src="{{ asset('images/orilogo.jpeg') }}" alt=""> 
                <h2>Login to your account</h2>
                <p class="error-login error {{ session()->has('Error') ? 'Show' : '' }}">{{ session()->get('Error') }}</p>
                <label for="">Email</label>
                <br>
                <input type="email" placeholder="Enter your email.." name="Email">
                <br>
                <label for="">Password</label>
                <br>
                <input type="password" name="Password">
                <br>
                <button class="LoginButton">Login &#8594;</button>
            </form>
        </div>
    </div>
    <script src="{{ asset('/js/Pages/Login.js') }}"></script>
@endsection
