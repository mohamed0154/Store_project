
@extends('layouts.html')

@section('content')
@include('layouts.section')
<section class="user-profile section">
	<div class="container">
		<div class="row">
			<div class="col-md-10 offset-md-1 col-lg-3 offset-lg-0">
                @include('profiles.profile')
                @include('admin.modal')
			</div>
			<div class="col-md-10 offset-md-1 col-lg-9 offset-lg-0">
				<!-- Edit Profile Welcome Text -->
				<div class="widget welcome-message">
					@include('alarms.alarm')
					<h2>{{website_translation('Edit profile')}}</h2>

				</div>
				<!-- Edit Personal Info -->
				<div class="row">
					<div class="col-lg-6 col-md-6">
						<div class="widget personal-info">

							<h3 class="widget-header user">{{website_translation('Edit Personal Information')}}</h3>
							<form action="{{route('edit_user_profile',$user->id)}}"method='post' enctype='multipart/form-data'>
								<!-- First Name -->@csrf
								<div class="form-group">
									<label for="first-name">{{website_translation('New Name')}}</label>
									<input type="text"name='name' class="form-control" id="first-name">
								</div>
                                   @error('name')
									   <div class="alert alert-danger">{{$message}}</div>
								   @enderror
                                <div class="form-group choose-file d-inline-flex">
                                    <i class="fa fa-user text-center px-3"></i>
                                    <input type="file"name='image' class="form-control-file mt-2 pt-1" id="input-file">
                                </div>
                                @error('image')
                                <div class="alert alert-danger">{{$message}}</div>
                                @enderror


                                <button class="btn btn-transparent">{{website_translation('Save My Changes')}}</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="widget personal-info">

                            <h3 class="widget-header user">{{website_translation('Edit Personal Information')}}</h3>
                            <form action="{{route('edit_user_profile',$user->id)}}"method='post'>
                                         @csrf
                                <div class="form-group">
                                    <label for="current-email">{{website_translation('Current Email')}}</label>
                                    <input type="email" name='email' class="form-control" id="current-email">
                                </div>
                                @error('email')
                                <div class="alert alert-danger">
                                    {{$message}}
                                </div>
                                @enderror
                                <!-- New email -->
                                <div class="form-group">
                                    <label for="new-email">{{website_translation('New Email')}}</label>
                                    <input type="email" name='new_email' class="form-control" id="new-email">
                                </div>
                                @error('new_email')
                                <div class="alert alert-danger">
                                    {{$message}}
                                </div>
                                @enderror
                                <button class="btn btn-transparent">{{website_translation('Save My Changes')}}</button>
                            </form>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <div class="widget personal-info">

                            <h3 class="widget-header user">{{website_translation('Edit Personal Information')}}</h3>
                            <form action="{{route('edit_user_profile',$user->id)}}"method='post'>
                                     @csrf

                                <div class="form-group">
                                    <label for="new-password">{{website_translation('Current Password')}}</label>
                                    <input type="password"name='password' class="form-control" id="new-password">
                                </div>
                                @error('password')
                                <div class="alert alert-danger">{{$message}}</div>
                                @enderror

							<div class="form-group">
								<label for="new-password">{{website_translation('New Password')}}</label>
								<input type="password"name='new_password' class="form-control" id="new-password">
							</div>
							@error('new_password')
							<div class="alert alert-danger">{{$message}}</div>
						@enderror
							<!-- Confirm New Password -->
							<div class="form-group">
								<label for="confirm-password">{{website_translation('Confirm New Password')}}</label>
								<input type="password"name='confirm_password' class="form-control" id="confirm-password">
							</div>
							@error('confirm_password')
							<div class="alert alert-danger">{{$message}}</div>
						@enderror
							<!-- Submit Button -->


							<!-- Submit Button -->
                                <button class="btn btn-transparent">{{website_translation('Save My Changes')}}</button>
                            </form>

                        </div>
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

@section('scripts')
@include('accounts.delete_account')
@endsection
