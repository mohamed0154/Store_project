@extends('layouts.html')
@section('content')
    @include('layouts.section')
<section class="login py-5 border-top-1">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-8 align-item-center">
                <div class="border border">
                    @include('alarms.alarm')
                    <h3 class="bg-gray p-4">Register Now</h3>
                    <form action="{{route('store_user')}}"method='POST'enctype='multipart/form-data'>
                        @csrf
                        <fieldset class="p-4">
                            <input type="name"name='name' placeholder="Name*" class="border p-3 w-100 my-2">
                            @error('name')
							<div class="text text-success">{{$message}}</div>
						    @enderror
                            <input type="email"name='email' placeholder="Email*" class="border p-3 w-100 my-2">
                            @error('email')
							<div class="text text-success">{{$message}}</div>
						    @enderror
                            <input type="password"name='password' placeholder="Password*" class="border p-3 w-100 my-2">
                            @error('password')
							<div class="text text-success">{{$message}}</div>
						     @enderror
                            <input type="password"name='confirmation_password' placeholder="Confirm Password*" class="border p-3 w-100 my-2">
                            @error('confirmation_password')
							<div class="text text-success">{{$message}}</div>
						     @enderror
                             <div class="form-group choose-file d-inline-flex">
                                <i class="fa fa-user text-center px-3"></i>
                               <input type="file"name='image'placeholder="Image" class="form-control-file mt-2 pt-1" id="input-file">
                             </div>
                             @error('image')
                             <div class="text text-success">{{$message}}</div>
                              @enderror
                            <div class="loggedin-forgot d-inline-flex my-3">
                                    <input type="checkbox" id="registering" class="mt-1">
                                    <label for="registering" class="px-2">By registering, you accept our <a class="text-primary font-weight-bold" href="terms-condition.html">Terms & Conditions</a></label>
                            </div>
                            <button type="submit" class="d-block py-3 px-4 bg-primary text-white border-0 rounded font-weight-bold">Register Now</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--============================ !>
    @include('layouts.footer')
@endsection
