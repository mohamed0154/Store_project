
@if(Auth::guard('admin')->user())
<div class="widget user-dashboard-profile">
    <!-- User Image -->
    <div class="profile-thumb">
        <img src="{{asset('admin/profile/'.Auth::guard('admin')->user()->image)}}" alt="" class="rounded-circle">
    </div>
    <!-- User Name -->
    <h5 class="text-center">{{Auth::guard('admin')->user()->name}}</h5>
    <p>Joined {{Auth::guard('admin')->user()->created_at}}</p>
    <a href="{{route('form_edit_profile',Auth::guard('admin')->id())}}" class="btn btn-main-sm">Edit</a>
</div>
<!-- Dashboard Links -->
<div class="widget user-dashboard-menu">
    <ul>

        <li>
            <a href="{{route('logout')}}"><i class="fa fa-cog"></i> Logout</a>
        </li>
        <li>
            <a href="#" data-toggle="modal" data-target="#deleteaccount"><i class="fa fa-power-off"></i>Delete Account</a>
        </li>
    </ul>
</div>
@else
    <div class="widget user-dashboard-profile">
        <!-- User Image -->
        <div class="profile-thumb">
            <img src="{{asset('user/images/'.Auth::guard('web')->user()->image)}}" alt="" class="rounded-circle">
        </div>
        <!-- User Name -->
        <h5 class="text-center">{{$user->name}}</h5>
        <p>Joined {{Auth::guard('web')->user()->created_at}}</p>

    </div>
    <!-- Dashboard Links -->
    <div class="widget user-dashboard-menu">
        <ul>

            <li>
                <a href="{{route('logout')}}"><i class="fa fa-cog"></i> Logout</a>
            </li>
            <li>
                <a href="#" data-toggle="modal" data-target="#deleteaccount"><i class="fa fa-power-off"></i>Delete Account</a>
            </li>
        </ul>
    </div>

@endif
