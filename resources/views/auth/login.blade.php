@extends('layouts.html')
@section('content')
@include('layouts.section')

<section class="login py-5 border-top-1">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-8 align-item-center">
                <div class="border">
                    <h3 class="bg-gray p-4">Login Now</h3>
                    @include('alarms.alarm')
                    <form action="{{route('authenticate')}}"method='POST'>
						@csrf
                        <fieldset class="p-4">
                            <input type="text"  placeholder="Email"name='email' class="border p-3 w-100 my-2">
                              {{-- @error('email')
                                <div class="alert alert-danger">{{isset($message)?$message:''}}</div>
                              @enderror --}}
                            <input type="password" placeholder="Password"name='password' class="border p-3 w-100 my-2">
                            {{-- @error('password')
                            <div class="alert alert-danger">{{isset($message)?$message:''}}</div>
                            @enderror --}}
                            <div class="loggedin-forgot">
                                    <input type="checkbox"name='remember_me' value="remember_me" id="keep-me-logged-in" {{ old('remember_me') ? 'checked' : '' }}>
                                    <label for="keep-me-logged-in" class="pt-3 pb-2">Keep me logged in</label>
                            </div>
                            <button type="submit" class="d-block py-3 px-5 bg-primary text-white border-0 rounded font-weight-bold mt-3">Log in</button>
                            <a id='reset' class="mt-3 d-block  text-primary" href="{{route('reset_password')}}">Forget Password?</a>
                            <a class="mt-3 d-inline-block text-primary" href="{{url("register")}}">Register Now</a>
                        </fieldset>
                    </form>
                    <div id="your_mail">

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--============================
=            Footer            =
=============================-->
@include('layouts.footer')
@endsection
