@extends('layouts.html')
@section('content')
@include('layouts.section')

<!--===================================
=            Clients Section        =
====================================-->

<section class="client-slider-03">
	<!-- Container Start -->
	<div class="container">
		<div class="row">
			<!-- Client Slider -->
			<div class="col-md-12">
				<!-- Client Slider -->
<div class="category-slider">
    <!-- Client 01 -->
    @if(isset($maincategories))
    @foreach($maincategories as $category)
            <div class="item">
                <a href="{{route('all_categories',$category->id)}}">
                    <!-- Slider Image -->
                    <i class="fa fa-{{$category->category=='cafe'?'coffee':__('trans.'.$category->category)}}"></i>
                    <h4>{{$category->category}}</h4>
                </a>
            </div>
        @endforeach
    @endif


</div>
			</div>
		</div>
	</div>
	<!-- Container End -->
</section>

<section class="stores section">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="section-title">
					<h2>{{website_translation('Vendors')}}</h2>
				</div>
				<!-- First Letter -->
				<div class="block">
					<!-- Store First Letter -->
					<h5 class="store-letter">{{website_translation('All Vendors')}}</h5>
					<hr>
					<!-- Store Lists -->
                    <div class="row">
                        <!-- Store List 01 -->
                        @if(isset($vendors) && $vendors->count() > 0)
                            @foreach($vendors as $vendor)

                                <div class="col-md-3 col-sm-6">
                                    <ul class="store-list">
                                        <li><a href="#">{{$vendor->name}}</a></li>

                                    </ul>
                                </div>

                                @endforeach

                            @endif
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
<style>
    .w-5{
        display: none;
    }
</style>
