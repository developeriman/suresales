@extends('frontend.layout')
@section('page_title','Login')
@section('content')

<!-- Page Title -->
<!-- <div class="page-title-area">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="title-content">
                    <h2>Login</h2>
                    <ul>
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li>
                            <span>Login</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="title-img">
        <img src="{{ asset('frontend/images/page-title1.jpg') }}" alt="About">
        <img src="{{ asset('frontend/images/shape16.png') }}" alt="Shape">
        <img src="{{ asset('frontend/images/shape17.png') }}" alt="Shape">
        <img src="{{ asset('frontend/images/shape18.png') }}" alt="Shape">
    </div>
</div> -->
<!-- End Page Title -->

<!-- User -->
<div class="user-area ptb-100">
    <div class="container" style="margin-top: 30px;">

        <div class="user-item">
            <form action="{{ url('/login') }}" method="POST">
                @csrf
                <h2>{{ GoogleTranslate::trans('Login', app()->getLocale()) }}</h2>

                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Your Email:">
                    @if ($errors->has('email'))
                        <span class="text-danger validation-message">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password:">
                    @if ($errors->has('password'))
                        <span class="text-danger validation-message">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                @if ($errors->has('loginError'))
                    <div class="text-danger validation-message">{{ $errors->first('loginError') }}</div>
                @endif
                <button type="submit" class="btn common-btn">
                    Login
                    <img src="{{ asset('frontend/images/shape1.png') }}" alt="Shape">
                    <img src="{{ asset('frontend/images/shape2.png') }}" alt="Shape">
                </button>

                <h5>Didn't Have An Account? <a href="{{ url('/register') }}">Register</a></h5>

            </form>
        </div>

    </div>
</div>
<!-- End User -->

@endsection