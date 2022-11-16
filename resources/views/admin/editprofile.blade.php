@extends('layouts.html')
@section('content')
    @include('layouts.section')
    <!--==================================
=            User Profile            =
===================================-->
    <section class="dashboard section">
        <!-- Container Start -->
        <div class="container">
            <!-- Row Start -->
            <div class="row">
                <div class="col-md-10 offset-md-1 col-lg-4 offset-lg-0">
                    <div class="sidebar">
                        <!-- User Widget -->

                    @include('profiles.profile')
                    <!-- delete-account modal -->
                        <!-- delete account popup modal start-->
                        <!-- Modal -->
                        @include('admin.modal')
                        <!-- delete account popup modal end-->
                        <!-- delete-account modal -->

                    </div>
                </div>


                <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0">

                    <div class="row">
                        <div class="col-lg-12 col-md-6">
                            <div class="widget personal-info">
                                @include('alarms.alarm')

                                <h3 class="widget-header user">Edit Information</h3>
                                <form action="{{route('edit_profile',Auth::guard('admin')->id())}}"method='post' enctype='multipart/form-data'>
                                     @csrf
                                    <!-- Name -->
                                    <div class="form-group">
                                        <label for="first-name">Edit Name</label>
                                        <input type="text"name='name' value="{{$admin->name}}" class="form-control" id="first-name">
                                    </div>
                                    @error('name')
                                    <div class="text text-success">{{$message}}</div>
                                    @enderror

                                     <!--New Email -->

                                    <div class="form-group">
                                        <label for="current-email">Edit Email</label>
                                        <input type="email" value="{{$admin->email}}" name='email' class="form-control" id="current-email">
                                    </div>

                                         <!-- Id -->
                                         <input type="hidden"name="id"value="{{$admin->id}}">

                                         <!-- Password -->

                                    <div class="form-group">
                                        <label for="new-password">New Password</label>
                                        <input type="password"name='password'class="form-control" id="new-password">
                                    </div>
                                    @error('password')
                                    <div class="text text-success">{{$message}}</div>
                                    @enderror
                                <!-- Confirm New Password -->
                                    <div class="form-group">
                                        <label for="confirm-password">Confirm New Password</label>
                                        <input type="password"name='confirmation_password' class="form-control" id="confirm-password">
                                    </div>
                                    @error('confirmation_password')
                                    <div class="text text-success">{{$message}}</div>
                                    @enderror

                                     <!-- Image -->

                                    <div class="form-group choose-file d-inline-flex">
                                        <i class="fa fa-user text-center px-3"></i>
                                        <input type="file"name='image' class="form-control-file mt-2 pt-1" id="input-file">
                                    </div>
                                    @error('image')
                                    <div class="text text-success">{{$message}}</div>
                                    @enderror
                                    <button class="btn btn-transparent">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>


            </div>
            <!-- Row End -->
        </div>
        <!-- Container End -->
    </section>
    <!--============================
    =            Footer            =
    =============================-->

    @include('layouts.footer')
@endsection

@section('scripts')
<script>
  @include('accounts.delete_account');  
</script>
@endsection