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
                    <!-- Dashboard Links -->


                        <!-- delete-account modal -->
                        <!-- delete account popup modal start-->
                        <!-- Modal -->
                        @include('admin.modal')
                        <!-- delete account popup modal end-->
                        <!-- delete-account modal -->

                    </div>
                </div>

                {{-- forma --}}

                <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0">
                    <!-- Recently Favorited -->
                    <div class="widget dashboard-container my-adslist">
                        @include('alarms.alarm')
                        <h3 class="widget-header">Add Specifications</h3>
                        <form id="allData" action=""method='POST'enctype='multipart/form-data'>
                            @csrf
                            @if(isset($subcategories) && $subcategories->count() > 0)
                            <select name="subcategory_id">

                                @foreach($subcategories as $subcategorys)
                                    <option value="{{$subcategorys->id}}">{{$subcategorys->name}}</option>
                                @endforeach

                            </select>
                            @endif
                            <br><br>

                            <label for="exampleFormControlInput1" class="form-label">Add Specifications</label>
                            <textarea rows="4" name='specification' class="form-control" placeholder="{{'....  &  ....  &  .....  like  ram:8G   &   area:124G   &   style:item_1 , item_2   & ...'}}" ></textarea>
								<strong><h3><small type='hidden' id='image_er'class='text text-danger'></small></h3></strong>
								<br>
                                <div id="allErrors" class="text text-danger">

                                </div>
                            <button id="submitData" type="submit" class="d-block py-3 px-5 bg-primary text-white border-0 rounded font-weight-bold mt-3">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        </div>
        <!-- Row End -->
        </div>
        <!-- Container End -->
    </section>


    @include('layouts.footer')
@endsection
@section('scripts')
    <script>
        var btn=document.querySelector('button#submitData');

         btn.onclick=function(e){
            e.preventDefault();
            var data=new FormData($('#allData')[0]);
            $('#allErrors').html('');
            $.ajax({
                url:"{{route('store_specifications')}}",
                type:'POST',
                data:data,
                processData: false,
                contentType: false,
                cache: false,
                success :function(data){
                    if(data.status==true){
                        alert(data.msg);
                    }else{
                       $('#allErrors').html(data.msg[0]);
                    }
                },
                error:function(reject){

                }


            });
        };

             /////////////////////////
///////////////////delete Account/////////////////
        @include('accounts.delete_account');
    </script>
@endsection
