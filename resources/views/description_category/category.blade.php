
@extends('layouts.html')
@section('title','Description')
@section('content')

@include('layouts.section')

<section class="page-title">
    <!-- Container Start -->
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2 text-center">
                <!-- Title text -->
                <h3>{{website_translation('Welcome')}}</h3>
            </div>
        </div>
    </div>
    <!-- Container End -->
</section>
<!--===================================
=            Store Section            =
====================================-->
<section class="section bg-gray">
	<!-- Container Start -->
	<div class="container">
		<div class="row">
			<!-- Left sidebar -->
			<div class="col-md-8">
				<div class="product-details">
					<h1 class="product-title">{{isset($subcategory->name)?$subcategory->name:''}}</h1>
					<div class="product-meta">
						<ul class="list-inline">
							<li class="list-inline-item"><i class="fa fa-folder-open-o"></i> subcategory<a href="">{{isset($subcategory->maincategory->branch)?$subcategory->maincategory->branch->branch:''}}</a></li>
						</ul>
					</div>
					<!-- product slider -->
				@if(isset($subcategory->images) && $subcategory->images->count() >= 4)
					<div class="product-slider">
                        @foreach($subcategory->images as $counter => $image)
                            @if ($counter < 4)
                                <div  class="product-slider-item my-4" data-image="{{asset('admin/images/subcategories/'.$image->image)}}">
                                    <img   id='the_big' class="img-fluid w-100" src="{{asset('admin/images/subcategories/'.$image->image)}}" alt="product-img">
                                </div>
                            @endif
                        @endforeach
					</div>
				@endif

					<!-- product slider -->

                    <div class="content mt-5 pt-5">
						<ul class="nav nav-pills  justify-content-center" id="pills-tab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home"
								 aria-selected="true">{{website_translation('Product Details')}}</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile"
								 aria-selected="false">{{website_translation('Specifications')}}</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact"
								 aria-selected="false">{{website_translation('Reviews')}}</a>
                            </li>
						</ul>
						<div class="tab-content" id="pills-tabContent">
							<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
								<h3 class="tab-title">{{website_translation('Product Description')}}</h3>
								<p>{{$subcategory->name}}</p>
								<p>{{isset($subcategory->description)?$subcategory->description->description:''}}</p>
							</div>
							<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
								<h3 class="tab-title">{{website_translation('Product Specifications')}}</h3>
								<table class="table table-bordered product-table">
									<tbody>
										<tr>
											<td>Seller Price</td>
											<td>${{round($subcategory->the_price /18)}}</td>
										</tr>
										<tr>
											<td>Added</td>
											<td>{{$subcategory->created_at}}</td>
										</tr>
                                        @if(isset($subcategory->specification->specification) && count($subcategory->getSpecifications()) > 0)
											@foreach($subcategory->getSpecifications() as $c=> $specific)
                                                <tr>
                                                    <td>{{$c}}</td>
                                                    <td>{{$specific}}</td>
                                                </tr>
											@endforeach
                                        @endif
                                        <tr>
											<td>Model</td>
											<td>{{date('y',time())}}</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
								<h3 class="tab-title">{{website_translation('Product Review')}}</h3>
								<div class="product-review">
									<div class="media">
										<!-- Avater -->
										<img src="{{asset(\App\Models\Subcategory::PathImage().$subcategory->image)}}" alt="avater">
										<div class="media-body">
											<!-- Ratings -->
											<div class="ratings">
												<ul class="list-inline">
                                                    @for( $c=0; $c<5; $c++)
                                                        <li class="list-inline-item">
                                                            <i class="fa fa-star"></i>
                                                        </li>
                                                    @endfor
												</ul>
											</div>
											<div class="name">
												<h5>{{isset($subcategory->name)?$subcategory->name:''}}</h5>
											</div>
											<div class="date">
												<p>Mar 20, 2018</p>
											</div>
											<div class="review-comment">
												<p>
                                                    {{website_translation('Your review matters to us')}}
												</p>
											</div>
										</div>
									</div>
									<div class="review-submission">
										<h3 class="tab-title">{{website_translation('Submit your review')}}</h3>
										<!-- Rate -->
										<div class="rate">
											<div class="starrr"></div>
										</div>
										<div class="review-submit">
											<form id="allData" action="#" class="row">
												<div class="col-lg-6">
													<input type="text" name="name" id="name" class="form-control" placeholder="Name">
												    <small id='name_error' class='text text-danger'></small>
												</div>
												<div class="col-lg-6">
													<input type="email" name="email" id="email" class="form-control" placeholder="Email">
													<small id='email_error' class='text text-danger'></small>
												</div>
												<div class="col-12">
													<textarea name="opinion" id="review" rows="10" class="form-control" placeholder="Message"></textarea>
													<small id='opinion_error' class='text text-danger'></small>
												</div>
												<div class="col-12">
													<input type='hidden' name="subcategory_id" id="id" value='{{$subcategory->id}}' class="form-control">
												</div>
												<div class="col-12">
													<button id="submitData" type="submit" class="btn btn-main">Sumbit</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="sidebar">
					<div class="widget price text-center">
						<h4>{{website_translation('Price')}}</h4>
						<p>${{round($subcategory->the_price /18)}}</p>
					</div>
					<!-- User Profile widget -->
					<div class="widget user text-center">
						<img class="rounded-circle img-fluid mb-5 px-5" src="{{get_image(App\Models\SubCategory::PathImage() . $subcategory->image)}}" alt="">
						<h4><a href="">{{$subcategory->name}}</a></h4>
						<p class="member-time">{{$subcategory->created_at}}</p>
						<ul class="list-inline mt-20">
                            @include('user.shopping.shopping_cart')
						</ul>
					</div>

                    <!-- Safety tips widget -->
					<div class="widget disclaimer">
						<h5 class="widget-header">{{website_translation('Safety Tips')}}</h5>
						<ul>
							<li>{{website_translation('Payment after receiving delivery to all provinces')}}</li>
						</ul>
					</div>
					<!-- Coupon Widget -->
					<div class="widget coupon text-center">
						<!-- Coupon description -->
						<p>{{website_translation('Have a great product to post ? Share it with your fellow users')}}.
						</p>
						<!-- Submii button -->
						<a href="{{route('make_over')}}" class="btn btn-transparent-white">{{website_translation('Submit Listing')}}</a>
					</div>

				</div>
			</div>

		</div>
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
        $(document).on('click','#submitData',function(e){
            e.preventDefault();
            var data=new FormData($('#allData')[0]);
            $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

			$('#name_error').text('');
			$('#email_error').text('');
			$('#opinion_error').text('');

            $.ajax({
                type:'POST',
                url:"{{route('review')}}",
                data:data,
                processData: false,
                contentType: false,
                cache: false,

                success:function(data){
                    if(data.status==true){
                       alert(data.msg);
                    }
					alert(data.msg);
                },
                error:function(reject){
					var response=$.parseJSON(reject.responseText);
					$.each(response.errors,function(key,val){
					   $('#' + key + '_error').text(val[0]);
					});
                }
            });
        });

    ////////////////////////////////////////////
////////////////////Add product To Cart////////////////////
@include('user.shopping.ajax_shopping');
    </script>

    @endsection
