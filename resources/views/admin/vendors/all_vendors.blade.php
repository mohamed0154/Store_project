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
          <!-- Dashboard Links -->


          <!-- delete-account modal -->
          						  <!-- delete account popup modal start-->
                <!-- Modal -->
               @include('admin.modal')
                <!-- delete account popup modal end-->
          <!-- delete-account modal -->

        </div>
      </div>


      <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0">
        <!-- Recently Favorited -->
        @include('alarms.alarm')
        <div class="widget dashboard-container my-adslist">
          <h3 class="widget-header">My Ads</h3>
          <table class="table table-responsive product-dashboard-table">
            <thead>
              <tr>
                <th class="text-center">Vendor Name</th>
                <th class="text-center">Main Category </th>
                <th class="text-center">Mail</th>
                <th class="text-center">Statue</th>
                <th class="text-center">phone Num </th>
                <th class="text-center">logo</th>
                <th class="text-center">Title</th>
                <th class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              @if (isset($vendors))
                  @foreach ($vendors as $vendor)
                  <tr>
                    <td class="product">
                      <span class="location">{{$vendor->name}}</span>
                    </td>
                    @if (isset($vendor->maincategory->category))

                    <td class="product">
                      <span class="location">{{$vendor->maincategory->category}}</span>
                    </td>
                    @else
                    <td class="product">
                      <span class="location">{{'لا يوجد'}}</span>
                    </td>
                    @endif

                    <td class="product-category"><span class="categories">{{$vendor->email}}</span></td>
                    <td class="product-category"><span class="categories">{{$vendor->getStatue()}}</span></td>
                    <td class="product-category"><span class="categories">{{$vendor->mobile}}</span></td>
  <td class="product-category"><span class="categories"><img height="30px" width='50px'src="{{asset('admin/images/vendors/'.$vendor->logo)}}"></span></td>
                    <td class="product-category"><span class="categories">{{$vendor->address}}</span></td>

                    <td class="action" data-title="Action">
                      <div class="">
                        <ul class="list-inline justify-content-center">
                          <li class="list-inline-item">
                            <a data-toggle="tooltip" get_id="{{$vendor->id}}" data-placement="top" title="{{$vendor->getActive()? 'Disactivate':'Activate'}}" class="view change_statue" href="{{route('change_statue_vendor',$vendor->id)}}">
                              <i class="fa fa-edit"></i>
                            </a>
                          </li>
                            <li class="list-inline-item">
                                <a class="edit" data-toggle="tooltip" data-placement="top" title="Edit" href="{{route('form_edit_vendor',$vendor->id)}}">
                                    <i class="fa fa-pencil"></i>
                                </a>
                            </li>
                          <li class="list-inline-item">
                            <a class="delete delData" get_id="{{$vendor->id}}" data-toggle="tooltip" data-placement="top" title="Delete" href="{{route('delete_vendor',$vendor->id)}}">
                              <i class="fa fa-trash"></i>
                            </a>
                          </li>
                        </ul>
                      </div>
                    </td>
                  </tr>
                  @endforeach
              @endif




            </tbody>
          </table>

        </div>

        <!-- pagination -->
        <div class="pagination justify-content-center">
					<nav aria-label="Page navigation example">
						<ul class="pagination">
							<li class="page-item">
								<a class="page-link" href="#" aria-label="Previous">
									<span aria-hidden="true">&laquo;</span>
									<span class="sr-only">Previous</span>
								</a>
							</li>
							{{isset($vendors)?$vendors->links():''}}
								<a class="page-link" href="#" aria-label="Next">
									<span aria-hidden="true">&raquo;</span>
									<span class="sr-only">Next</span>
								</a>
							</li>
						</ul>
					</nav>
				</div>
        <!-- pagination -->

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
    $(document).on('click','.delData',function(e){
        e.preventDefault();
        var id=$(this).attr('get_id');
        $.ajax({
            type:'POST',
            url:"{{route('delete_vendor')}}",
            data:{
                'id':id,
                '_token':"{{csrf_token()}}",
            },

            success:function(data){
                if(data.status==true) {
                    alert(data.msg);
                }
                alert(data.msg);
            },
            error:function(reject){

            }

        });
    });
    
           ///////////////////////
  //////////////Delete Account/////////////
    @include('accounts.delete_account');  
///////////////////////////////////////////


    $(document).on('click','.change_statue',function(e){
        e.preventDefault();
        var id=$(this).attr('get_id');
        $.ajax({
            type:'POST',
            url:"{{route('change_statue_vendor')}}",
            data:{
                'id':id,
                '_token':"{{csrf_token()}}",
            },

            success:function(data){
                if(data.statue==true) {
                    alert(data.msg);
                }
                alert(data.msg);
            },
            error:function(reject){

            }

        });
    });
</script>
@endsection
