@extends('layouts.html')
@section('content')

@endsection
@include('layouts.section')

<section class="dashboard section">
  <!-- Container Start -->
  <div class="container">
    <!-- Row Start -->
    <div class="row">
      <div class="col-md-10 offset-md-1 col-lg-4 offset-lg-0">
        <div class="sidebar">
          <!-- admin Widget -->
           @include('profiles.profile')



          <!-- delete-account modal -->
          						  <!-- delete account popup modal start-->
                <!-- Modal -->
                @include('admin.modal')
                <!-- delete account popup modal end-->
          <!-- delete-account modal -->

        </div>
      </div>


	  <div class="col-md-12 offset-md-1 col-lg-8 offset-lg-0">
				<div class="category-search-filter">
					<div class="row">
						<div class="col-md-6 btn-group btn-group-lg">
							<strong>Add Main Category</strong>

						</div>
						<div class="col-md-6">
							<div class="view">
								<strong>Views</strong>
								<ul class="list-inline view-switcher">
									<li class="list-inline-item">
										<a href="#" onclick="event.preventDefault();" class="text-info"><i class="fa fa-th-large"></i></a>
									</li>

								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="product-grid-list">
					<div class="row mt-30">

							<!-- product card -->
							<div class="col-md-10 offset-md-4 col-lg-12 offset-lg-0">
								<!-- Recently Favorited -->
								<div class="widget dashboard-container my-adslist">
								  @include('alarms.alarm')
									<h3 class="widget-header"></h3>
							  <form id="allData"  action="#"method='POST'enctype='multipart/form-data'>

								@csrf
                    @if(isset($branches) && $branches->count() >0 )
                        <label for="exampleFormControlInput1" class="form-lable">Branches Of Main Categories</label>
                        <select  style='border-radius:10px' name="branch_id">

                          @foreach($branches as $branch)
                           <option value="{{$branch->id}}">{{$branch->branch}}</option>
                          @endforeach
                        </select>
                        <small type="hidden"id="branch_id" ></small>
                   @endif
                        <br><br>
	     						@if(isset($langs))
								<label for="exampleFormControlInput1" class="form-label">Image Category</label>

								<input type="file" name='image' class="form-control">
                                      <small type="hidden"id="image"class='text text-danger'></small>
                                      <br>
								@foreach ($langs as $count=> $lang)
									<h2 class="alert alert-primary d-flex align-items-center">{{website_translation('Category by lang '.$lang->abbr)}}</h2>


									<input class="form-control form-control-lg"name='category[{{$count}}][category]' type="text" placeholder="Name" aria-label=".form-control-lg example">

                    <small type="hidden"id='category{{$count}}category'class='text text-danger'></small>
									<input class="form-control form-control-sm"value='{{$lang->abbr}}' type="hidden"name='category[{{$count}}][translation_lang]' placeholder="abbr" aria-label=".form-control-sm example">
                           <br>
                     <div style='margin-left:20px' class="form-check form-switch">

                  <input class="form-check-input" name="category[{{$count}}][status]"value='1' type="checkbox" id="flexSwitchCheckDefault" checked>

                  <label class="form-check-label" for="flexSwitchCheckDefault">Statue</label>
                    </div>

							  @endforeach
							  @endif
                   <input class="form-control form-control-sm" placeholder="Price Average" type="text"name='average' aria-label=".form-control-sm example">
                     <small type="hidden" id="average"class='text text-danger'></small>
                    <br>

							  <button id="submitData" type="submit" class="d-block py-3 px-5 bg-primary text-white border-0 rounded font-weight-bold mt-3">Add</button>
							  </form>
								</div>
						</div>
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

<!-- JAVASCRIPTS -->
@section('scripts')
    <script>
        $(document).on('click','#submitData',function(e){
            e.preventDefault();
            var data = new FormData($('#allData')[0]);

            $.ajax({
                type:'POST',
                url:"{{route('store_maincategory')}}",
                data:data,
                processData: false,
                contentType: false,
                cache: false,
                {{--//'_token':'{{csrf_token()}}',--}}
                success:function(data){
                    if(data.status==true){
                        alert(data.msg);
                    }
                    alert(data.msg);
                },
                error:function(reject){
                  alert('The given data was invalid');


                  var response=$.parseJSON(reject.responseText);
               $.each(response.errors,function(key,val){
                   $('#' + key).text(val[0]);

               });


                }

            });
        });

    ///////////////////delete account///////////////
        @include('accounts.delete_account');
    </script>
    @endsection
