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
                        <h3 class="widget-header">Addition</h3>
                        <form id="allData" action="{{route('store_images_subcategory')}}"method='POST'enctype='multipart/form-data'>
                            @csrf
                            @if(isset($governorates) && $governorates->count() > 0)
                            <label for="">Governorate</label>
                            <select name="governorate_id">
                                @foreach($governorates as $governorate)
                                    <option value="{{$governorate->id}}">{{$governorate->name}}</option>
                                @endforeach
                            </select>
                            @endif
                            <br><br>

                            @if(isset($branches) && $branches->count() > 0)
                            <label for="">Branch</label>
                            <select name="branch_id">
                                @foreach($branches as $branch)
                                    <option value="{{$branch->id}}">{{$branch->branch}}</option>
                                @endforeach

                            </select>
                            @endif
                            <br><br>

                            <label for="exampleFormControlInput1" >Address</label>
                            <input type='text' name='address' class="form-control">
                            <br><br>

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
        $(document).on('click','#submitData',function(e){
            e.preventDefault();
            var data=new FormData($('#allData')[0]);
            $.ajax({
                url:"{{route('branch_allocation')}}",
                type:'POST',
                data:data,
                processData: false,
                contentType: false,
                cache: false,
                success :function(data){
                    if(data.status==true){
                        alert(data.msg);
                    }
                    alert(data.msg);

                },
                error:function(reject){

                }


            });
        });

             /////////////////////////
///////////////////delete Account/////////////////
        @include('accounts.delete_account');
    </script>
@endsection
