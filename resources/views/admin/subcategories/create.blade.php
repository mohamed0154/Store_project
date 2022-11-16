@extends('layouts.html')
@section('content')

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
                @include('admin.modal')
        </div>
      </div>
	  <div class="col-md-12 offset-md-1 col-lg-8 offset-lg-0">
				<div class="category-search-filter">
					<div class="row">
						<div class="col-md-6 btn-group btn-group-lg">
							<strong>Add Category</strong>

						</div>
						<div class="col-md-6">
							<div class="view">
								<strong>Views</strong>
								<ul class="list-inline view-switcher">
									<li class="list-inline-item">
										<a href="" onclick="event.preventDefault();" class="text-info"><i class="fa fa-th-large"></i></a>
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
									<h3 class="widget-header">Add Category</h3>
						 <form id='allData'  action="{{route('store_subcategory')}}"method='POST'enctype='multipart/form-data'>
								@csrf

								<label for="exampleFormControlInput1" class="form-label">Main Category</label>
								<select  name='maincategory_id'>
									@if(isset($maincategories) && $maincategories->count() > 0)
									@foreach ($maincategories as $maincategory)
									<option value="{{$maincategory->id}}" @if(isset($subcategory_edit) && $subcategory_edit->maincategory_id == $maincategory->id) selected @endif>{{$maincategory->category}}</option>
									@endforeach
									@endif
								</select>
								<h3><small type='hidden' id='maincategory_id_er'class='text text-danger'></small></h3>
									<br>


								  <label for="exampleFormControlInput1" class="form-label">Parent</label>
                                  <select  name='parent_id'>
                                    <option value="0">Not Thing</option>
                                    @if(isset($parentSubCat) && $parentSubCat->count() > 0)
                                          @foreach ($parentSubCat as $parent)
                                              <option value="{{$parent->id}}" @if(isset($subcategory_edit) && $subcategory_edit->parent_id == $parent->id) selected @endif>{{$parent->type}}</option>
                                          @endforeach
                                    @endif
                                  </select>
                                  <h3><small type='hidden' id='parent_id_er'class='text text-danger'></small></h3>


                                  @if(isset($subcategory_edit) &&$subcategory_edit !=null )
                                    <img width="200px" height="150px" src="{{asset(\App\Models\SubCategory::PathImage().$subcategory_edit->image)}}">
                                  @endif
                                     <br>

								<label for="exampleFormControlInput1" class="form-label">Image SubCategory</label>
								<input type="file" name='image' class="form-control">
								<strong><h3><small type='hidden' id='image_er'class='text text-danger'></small></h3></strong>
								<br>


                                  <input class="form-control  form-control-lg" value="{{isset($subcategory_edit)?$subcategory_edit->name:''}}" name='name' type="text" placeholder="Name" aria-label=".form-control-lg example">
                                  <h3><small type='hidden' id='name_er'class='text text-danger'></small></h3><br>


                                  <input class="form-control form-control-lg" value="{{isset($subcategory_edit)?$subcategory_edit->the_price:''}}" name='the_price' type="text" placeholder="The Price" aria-label=".form-control-lg example">
                                  <h3><small type='hidden' id='the_price_er'class='text text-danger'></small></h3>

                                  @isset($subcategory_edit)
                                      <input type="hidden" value="{{$subcategory_edit->id}}"name="id">
                                  @endisset

                                  <textarea name="description"  placeholder="Description *" class="border w-100 p-3 mt-3 mt-lg-4">@if(isset($subcategory_edit->description)){{$subcategory_edit->description->description}}@endif</textarea>
                                  <h3><small type='hidden' id='description_er'class='text text-danger'></small></h3>
                                  <br>

                                  <laple><strong style="font-size: 15px">Subcategory Num</strong></laple>
                                  <select name="subcategory_num">
                                     @for ($i = 0; $i < 20; $i++)
                                         <option @if(isset($subcategory_edit) && $subcategory_edit->subcategory_num==$i)
                                               selected
                                                 @endif>{{$i}}
                                         </option>
                                     @endfor
                                  </select>

									<input class="form-control form-control-sm"value="{{isset($lang_maincategory->translation_lang)? $lang_maincategory->translation_lang :$subcategory_edit->translation_lang}}" type="hidden"name='translation_lang' placeholder="The Lang" aria-label=".form-control-sm example">
								<h3><small type='hidden' id='translation_lang_er'class='text text-danger' ></small></h3>


                                <div class="form-check form-swi tch">
                                    <input class="form-check-input" name="statue"value='1' type="checkbox" id="flexSwitchCheckDefault"@if(isset($subcategory_edit) && $subcategory_edit->getActive())checked @endif>
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Statue</label>
                                </div>
                                    <button type="submit"id='submitData' class="d-block py-3 px-5 bg-primary text-white border-0 rounded font-weight-bold mt-3">{{isset($subcategory_edit)?'Update':'Add'}}</button>

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
@endsection

@section('scripts')
    @isset($subcategory_edit)
        <script>
            $(document).on('click','#submitData',function(e){
                e.preventDefault();
                var data=new FormData($('#allData')[0]);
                $('#translation_lang_er').text('');
                $('#image_er').text('');
                $('#name_er').text('');
                $('#category_id_er').text('');
                $('#the_price_er').text('');
                $('#description_er').text('');
                $.ajax({
                    type:'POST',
                    url:"{{route('edit_subcategory')}}",
                    data:data,
                    //'_token':'{{csrf_token()}}',
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
                            $('#' + key + '_er').text(val[0]);
                        });
                    }
                });
            });

            @include('accounts.delete_account');
        </script>
        @else
        <script>
            $(document).on('click','#submitData',function(e){
                e.preventDefault();
                var data=new FormData($('#allData')[0]);
                $('#translation_lang_er').text('');
                $('#image_er').text('');
                $('#name_er').text('');
                $('#category_id_er').text('');
                $('#the_price_er').text('');
                $('#description_er').text('');
                $.ajax({
                    type:'POST',
                    url:"{{route('store_subcategory')}}",
                    data:data,
                    //'_token':'{{csrf_token()}}',
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
                            $('#' + key + '_er').text(val[0]);
                        });
                    }
                });
            });


          /////////////////////////////////
/////////////////////Delete Account//////////////////
            @include('accounts.delete_account');
        </script>
        @endisset


@endsection

