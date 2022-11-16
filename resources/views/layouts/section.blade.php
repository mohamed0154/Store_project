


<section>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<nav class="navbar navbar-expand-lg navbar-light navigation">
					<a class="navbar-brand" href="">
                    <div id="logo"> MF</div>
                    </a>

                    <div id="shopp">
                        @if(Auth::guard('web')->user())
                       <a  href="{{route('make_order')}}">
                        <span id='cartStyle' class="badge bg-primary rounded-pill">
                       {{isset($subcategories_cart) && count($subcategories_cart) > 0
                                      ?array_sum($subcategories_cart):null}}
                         </span> <img class="cart"  src="{{asset('user/icons/shopping-cart.png')}}">
                         @endif
                        </a>

                </div>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
					 aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>


			         @if(auth()->guard('admin')->user()  || auth()->user())
					     <div class="collapse navbar-collapse" id="navbarSupportedContent">
						      <ul class="navbar-nav ml-auto main-nav ">

                        @if(Auth::guard('web')->user())
							<li class="nav-item active">
								<a class="nav-link" href="{{route('home')}}">{{website_translation("Home")}}</a>
							</li>
                        @else
                            <li class="nav-item active">
								<a class="nav-link" href="{{route('dashboard')}}">{{website_translation("Dashboard")}}</a>
							</li>
                        @endif


						@if(Auth::guard('admin')->user())
                            <li class="nav-item dropdown dropdown-slide">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="">{{website_translation("Main Categories")}}<span><i class="fa fa-angle-down"></i></span>
                                </a>
                                    <!-- Dropdown list -->
                              <div class="dropdown-menu">

                                <a class="dropdown-item" href="{{route('all_maincategories')}}">{{website_translation("Main Categories")}}</a>
                                <a class="dropdown-item" href="{{route('create_maincategory')}}">{{website_translation("Add Main Categories")}}</a>

                              </div>

                            </li>


                                <li class="nav-item dropdown dropdown-slide">
                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="">{{website_translation("Subcategories")}}<span><i class="fa fa-angle-down"></i></span>
                                    </a>
                                    <!-- Dropdown list -->
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{route('create_parent')}}">{{website_translation("Add parent of subcategories")}}</a>
                                        <a class="dropdown-item" href="{{route('all_subcategories')}}">{{website_translation("Subcategories")}}</a>
                                        <a class="dropdown-item" href="{{route('create_subcategory')}}">{{website_translation("Add Subcategories")}}</a>
                                        <a class="dropdown-item" href="{{route('add_images_subcategory')}}">{{website_translation("Add Images")}}</a>
                                        <a class="dropdown-item" href="{{route('add_specifications')}}">{{website_translation("Add Specifications")}}</a>
                                    </div>
                                </li>


                                <li class="nav-item dropdown dropdown-slide">
                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="">{{website_translation("Vendors")}}<span><i class="fa fa-angle-down"></i></span>
                                    </a>

                                    <!-- Dropdown list -->
                                    <div class="dropdown-menu">

                                        <a class="dropdown-item" href="{{route('all_vendors')}}">{{website_translation('All Vendors')}}</a>
                                        <a class="dropdown-item" href="{{route('create_vendor')}}">{{website_translation('Add Vendor')}}</a>

                                    </div>
                                </li>
                            @endif

                            @if(Auth::guard('web')->user())
                                <li class="nav-item active">
                                    <a class="nav-link" href="{{route('all_stores')}}">{{website_translation('All Stores')}}</a>
                                </li>
                            @endif

							<li id='hide_lang' class="nav-item dropdown dropdown-slide lang-style" >
								<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="">{{website_translation("Lang")}}<span><i class="fa fa-angle-down"></i></span>
								</a>
								<!-- Dropdown list -->
								<div class="dropdown-menu">

                                    @foreach(App\Models\Lang::all() as $lang)
                                        @if($lang->getActive())

                                        <a data-toggle="tooltip" data-placement="top" title="{{$lang->abbr==app()->getLocale()?'the Used':'choose'}}" class="dropdown-item" href="{{ LaravelLocalization::getLocalizedURL($lang->abbr) }}">
                                            {{$lang->name}}
                                        </a>
                                        @endif
                                    @endforeach


									@if(Auth::guard('admin')->user())
                                        <a class="dropdown-item" data-toggle="tooltip" title="settings" href="{{route('available_langs')}}">Langs</a>
								      	<a class="dropdown-item" href="{{route('create_Lang')}}">{{website_translation("Add Lang")}}</a>

									@endif

								</div>
							</li>
                            @if(Auth::guard('admin')->user())
                               <li class="nav-item dropdown dropdown-slide lang-style" >
							         	<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="">{{website_translation("Branches")}}<span><i class="fa fa-angle-down"></i></span>
							         	</a>

								<!-- Dropdown list -->

								    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{route('create_branch')}}">{{website_translation("Add Branch")}}</a>
                                        <a class="dropdown-item" href="{{route('all_branches')}}">{{website_translation("Branches")}}</a>
                                        <a class="dropdown-item" href="{{route('add_governorate')}}">{{website_translation('Add Governorate')}}</a>
                                        <a class="dropdown-item" href="{{route('form_branch_allocation')}}">{{website_translation('Branch allocation')}}</a>

							    	</div>
							    </li>
                            @endif


							@if(Auth::guard('web')->user())
                                <li class="nav-item active">
                                    <a class="nav-link" href="{{route('form_edit_user_profile',Auth::guard('web')->id())}}">{{website_translation('Edit Profile')}}</a>
                                </li>
							@endif


						</ul>



                        <ul class="navbar-nav ml-auto mt-10">
							<li class="nav-item">
                              @auth()
                              @else
                              <a class="nav-link login-button" href="/">{{website_translation('InterFace')}}</a>

                              @endauth


								@if(Auth::guard('web')->user())
								        <a class="nav-link login-button" href="{{route('logout')}}">{{website_translation('Logout')}}</a>
                                  <li class="nav-item">
                                         <a class="nav-link text-white add-button" href="{{route('make_over')}}">{{website_translation('Sell Product')}}</a>
                                   </li>
                                @elseif(Auth::guard('admin')->user())
                                        <a  style="border-radius:10px" class="nav-link login-button" href="{{route('overs')}}">
                                             {{website_translation("Overs")}}<span class="badge bg-primary rounded-pill" style="color:white;margin-left:5px;">
                                             {{\App\Models\Notify::GetNotifyOver() != null?\App\Models\Notify::GetNotifyOver()->counter:0}}</span>
                                        </a>
                                              </li><li class="navbar-nav ml-auto mt-10">
                                        <a  style="border-radius:10px" class="nav-link login-button" href="{{route('orders')}}">{{website_translation('Orders')}}<span class="badge bg-primary rounded-pill" style="color:white;margin-left:5px">
                                            {{\App\Models\Notify::GetNotifyOrder() != null ?\App\Models\Notify::GetNotifyOrder()->counter:0}}</span>
                                        </a>
                                 @endif
							</li>
						</ul>
					</div>
                    @endif
				</nav>
            </div>
		</div>
	</div>
</section>



