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

          <h3  class="widget-header">My Ads {{' '}} <a style="margin-left: 10px" href='{{route('create_maincategory')}}'class="btn-sm btn btn-outline-info btn-small"><strong>Add Main Category</strong> </a> </h3>


          @include('alarms.alarm')
          <table class="table table-responsive product-dashboard-table">
            <thead>
              <tr>
                <th>Branch</th>
                <th class="text-center">Lang</th>
                <th class="text-center">Governorate</th>
                <th class="text-center">The Number</th>
                <th class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              @if (isset($branches))
						  @foreach ($branches as $branch)
              <tr>

                <td class="translation_lang">
                  {{$branch->branch}}
                </td>
                <td class="product-category"><span class="categories"> {{$branch->translation_lang}}</span></td>
                <td class="product-category"><span class="categories">
                    @isset($branch->governorates)
                        @foreach($branch->governorates as $c=>$governorate)
                            @if( $c % 5 == 0)
                                <br>
                            @endif
                           {{ $governorate->name}}
                        @endforeach
                    @endisset</span></td>

                <td class="product-category"><span class="categories"> {{isset($branch->governorates)?$branch->governorates->count():''}}</span></td>

                <td class="action" data-title="Action">
                  <div class="">
                    <ul class="list-inline justify-content-center">
                      <li class="list-inline-item">
                        <a class="edit" data-toggle="tooltip" data-placement="top" title="Edit" href="">
                          <i class="fa fa-pencil"></i>
                        </a>
                      </li>
                      <li class="list-inline-item">
                        <a class="delete delData" data-toggle="tooltip"get_id="" data-placement="top" title="Delete" href="">
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
                          {{isset($maincategories) ? $maincategories->links():""}}
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
            e.preventDefault();
            var id=$(this).attr('get_id');
            $.ajax({
                type:'POST',
              url:"{{route('delete_maincategory')}}",
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

        @include('accounts.delete_account');
    </script>

    @endsection
