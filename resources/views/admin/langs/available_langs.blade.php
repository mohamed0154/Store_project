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
                <th>Id</th>
                <th>الاسم</th>
                <th class="text-center">الاختصار</th>
                <th class="text-center">الحاله</th>
                <th class="text-center">عمل</th>
              </tr>
            </thead>
            <tbody>
              @if (isset($langs))
                  @foreach ($langs as $lang)
                  <tr>

                    <td class="product-thumb">

                      <span class="location">{{$lang->id}}</span>
                    <td class="product">
                      <span class="location">{{$lang->name}}</span>
                    </td>
                    <td class="product-category"><span class="categories">{{$lang->abbr}}</span></td>
                    <td class="product-category"><span class="categories">{{$lang->getStatue()}}</span></td>
                    <td class="action" data-title="Action">
                      <div class="">
                        <ul class="list-inline justify-content-center">
                            @if($lang->getStatue() == 'active')
                            <li class="list-inline-item">
                                <a data-toggle="tooltip" data-placement="top" title="{{$lang->abbr==app()->getLocale()?'the Used':'choose'}}" class="view" href="{{ LaravelLocalization::getLocalizedURL($lang->abbr) }}">

                                    <i class="fa fa-language"></i>
                                </a>
                            </li>
                            @endif

                            @if($lang->getStatue()=='not active')
                                    <li class="list-inline-item">
                                        <a data-toggle="tooltip" data-placement="top" title="{{'Activate'}}" class="view" href="{{route('change_statue_lang',$lang->id)}}">
                                            <i class="fa fa-star"></i>
                                        </a>
                                    </li>
                                @else
                                    <li class="list-inline-item">
                                        <a data-toggle="tooltip" data-placement="top" title="{{'Disactivate'}}" class="view" href="{{route('change_statue_lang',$lang->id)}}">
                                            <i class="fa fa-star"></i>
                                        </a>
                                    </li>
                                @endif

                          <li class="list-inline-item">
                            <a class="edit" data-toggle="tooltip" data-placement="top" title="Edit" href="{{route('form_edit_lang',$lang->id)}}">
                              <i class="fa fa-pencil"></i>
                            </a>
                          </li>
                          <li class="list-inline-item">
                            <a class="delete delData" get_id="{{$lang->id}}" data-toggle="tooltip" data-placement="top" title="Delete" href="{{route('delete_lang',$lang->id)}}">
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

							{{isset($langs)?$langs->links():''}}

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
                url:"{{route('delete_lang')}}",
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

        @include('accounts.delete_account');  
    </script>
@endsection
