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


      <div id="main" row='6' style='margin:-610px 0px 0px 360px;width:850px'>
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

        <div class="page-heading">

            <section class="section">
                <div id='card' class="card">
                    <div class="card-header">
                       Our Sub Categories
                    </div>
                    @include('alarms.alarm')
                    <div class="card-body">
                        <a style="position:absolute" href="{{route('create_subcategory')}}"class="btn-sm btn btn-outline-info btn-small"><span class="words">Create</span></a>
                        <table class="table table-striped" id="table1">
                            <thead>
                            <tr>

                             <th>Image</th>
                             <th class="text-center">lang</th>
                             <th class="text-center">Category</th>
                             <th class="text-center">Statue</th>
                             <th class="text-center">Action</th>
                               <!-- // <th class='text text-center'>Action</th> -->

                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($subcategories) && !empty($subcategories))
                                @foreach($subcategories as $subcategory)
                                <tr id="hide{{$subcategory->id}}">
                                    <td >
                                    <img width="80px" height="auto" src="{{asset('admin/images/subcategories/'.$subcategory->image)}}" alt="image description"></td>

                                    <td class="translation_lang text-center">
                                    {{$subcategory->translation_lang}}
                                    </td>
                                    <td class="product-category text-center"><span class="categories"> {{$subcategory->name}}</span></td>
                                    <td class="product-category text-center"><span class="categories"> {{$subcategory->getStatue()}}</span></td>
                                    <td class="action text-center" data-title="Action">
                                    <div class="">
                                        <ul class="list-inline justify-content-center">
                                        <li class="list-inline-item">
                                            <a data-toggle="tooltip" data-placement="top" title="{{$subcategory->statue==1?'Disactivate':'Activate'}}" class="view"
                                                href="{{route('change_statue_subcategory',$subcategory->id)}}">
                                            <i class="fa fa-pencil"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a class="edit" data-toggle="tooltip" data-placement="top" title="Edit" href="{{route('form_edit_subcategory',$subcategory->id)}}">
                                            <i class="fa fa-edit"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a class="delete delData" get_id="{{$subcategory->id}}"data-toggle="tooltip" data-placement="top" title="Delete" href="{{route('delete_subcategory',$subcategory->id)}}">
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
                    </div>
               </section>
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


@section('scripts')
    <script>
        $(document).on('click','.delData',function(e){
            e.preventDefault();
            var id= $(this).attr('get_id');
           // alert(id);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type:'POST',
                url:"{{route('delete_subcategory')}}",
                data:{
                    'id':id,

                },

                success:function(data){
                  if(data.status==true){
                    var  tr_data=document.querySelector('tr#hide'+id);
                      tr_data.style.display='none';
                      alert(data.msg);
                  }

                },
                error:function(reject){

                }

            });
        });

          /////////////////////////////////
   //////////////////Delete Account///////////////
        @include('accounts.delete_account');
    </script>
    @endsection









