@extends('layouts.app')

@section('content')
<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-t-85 p-b-20">
            <form method="POST" action="{{ route('login') }}" class="login100-form validate-form">
                        @csrf
				<!--	<span class="login100-form-title p-b-70">
						Welcome
					</span>-->
					<span class="login100-form-avatar">
						<img src="{{ asset('storage/logo.png') }}" alt="AVATAR">
					</span>

					<div class="wrap-input100 validate-input m-t-85 m-b-35" data-validate = "Enter username">
						<input class="input100" type="email" name="email" value="{{ old('email') }}" required  class="@if($errors->get('email')) is_invalid-feedback   @endif ">
						<span class="focus-input100" data-placeholder="Username"></span>
                        @foreach ($errors->get('email') as $error)
                              <div class="invalid-feedback-text">
                                  {{$error}}
                              </div>
                              @endforeach
					</div>

					<div class="wrap-input100 validate-input m-b-50" data-validate="Enter password">
						<input class="input100" type="password" name="password" required value="{{ old('password') }}" class="@if($errors->get('password')) is_invalid-feedback   @endif ">
						<span class="focus-input100" data-placeholder="Password"></span>
                        @foreach ($errors->get('password') as $error)
                              <div class="invalid-feedback-text">
                                  {{$error}}
                              </div>
                              @endforeach
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>

				<!--	<ul class="login-more p-t-190">
						<li class="m-b-8">
							<span class="txt1">
								Forgot
							</span>

							<a class="btn btn-link" href="{{ route('password.request') }}">
								Username / Password?
							</a>
						</li>

						<li>
							<span class="txt1">
								Don’t have an account?
							</span>

							<a href="#" class="txt2">
								Sign up
							</a>
						</li>-->
					</ul>
				</form>
			</div>
		</div>
	</div>
	


   
























<!--<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Foodeals Restaurant</title>


        <!-- Styles -->
 <!--       <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home/') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                       {{--@if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif--}}
                    @endauth
                </div>
            @endif

            <div class="content">
                <img src="{{ asset('storage/images/foodealsResto.png') }}" alt="logo"  width="50%" height="20%">
            </div>
        </div>
    </body>
</html>
-->