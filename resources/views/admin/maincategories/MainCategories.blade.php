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


      <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0">
        <!-- Recently Favorited -->
        <div class="widget dashboard-container my-adslist">
          <h3  class="widget-header">My Ads {{' '}} <a style="margin:-25px 0px 0px 415px;height:50px" href='{{route('create_maincategory')}}'class="btn-sm btn btn-outline-info btn-small"><strong style="margin-left: -70px">Add Main Category</strong> </a> </h3>
          @include('alarms.alarm')
          <table class="table table-responsive product-dashboard-table">
            <thead>
              <tr>
                <th>Image</th>
                <th>lang</th>
                <th class="text-center">Category</th>
                <th class="text-center">Statue</th>
                <th class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              @if (isset($maincategories))
						  @foreach ($maincategories as $maincategory)
              <tr id="hide{{$maincategory->id}}">

                <td class="product-thumb">
                  <img width="80px" height="auto" src="{{asset('admin/images/maincategories/'.$maincategory->image)}}" alt="image description"></td>

                <td class="translation_lang">
                  {{$maincategory->translation_lang}}
                </td>
                <td class="product-category"><span class="categories"> {{$maincategory->category}}</span></td>
                <td class="product-category"><span class="categories"> {{$maincategory->getStatus()}}</span></td>
                <td class="action" data-title="Action">
                  <div class="">
                    <ul class="list-inline justify-content-center">
                      <li class="list-inline-item">
                        <a data-toggle="tooltip" data-placement="top" title="{{$maincategory->status==1?'disatcivate':'activate'}}" class="view" href="{{route('change_statue_maincategory',$maincategory->id)}}">
                          <i class="fa fa-edit"></i>
                        </a>
                      </li>
                      <li class="list-inline-item">
                        <a class="edit" data-toggle="tooltip" data-placement="top" title="Edit" href="{{route('form_edit_maincategory',$maincategory->id)}}">
                          <i class="fa fa-pencil"></i>
                        </a>
                      </li>
                      <li class="list-inline-item">
                        <a class="delete delData" data-toggle="tooltip"get_id="{{$maincategory->id}}" data-placement="top" title="Delete" href="{{route('delete_maincategory',$maincategory->id)}}">
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
                          {{$maincategories->links()}}
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

<style>
    .w-5{
        display: none;
    }
</style>
@section('scripts')
    <script>

        $(document).on('click','.delData',function(e){
          var id=$(this).attr('get_id');
            e.preventDefault();
            $.ajax({
                type:'POST',
              url:"{{route('delete_maincategory')}}",
              data:{
                'id':id,
                  '_token':"{{csrf_token()}}",
                   },

                success:function(data){
                if(data.status==true) {
                  var  tr_data=document.querySelector('tr#hide'+id);
                  tr_data.style.display='none';
                    alert(data.msg);
                }
                    alert(data.msg);
                },
                error:function(reject){

                }

            });
        });

        @include('accounts.delete_account');
    </script>

    @endsection
