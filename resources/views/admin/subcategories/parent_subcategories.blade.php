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
                        <h3 class="widget-header">Create Parent</h3>
                        <form id="allData" action="{{route('store_parent')}}"method='POST'enctype='multipart/form-data'>
                            @csrf

                            <select name="maincategory_id">
                                @foreach($maincategories as $maincategory)
                                    <option value="{{$maincategory->id}}">{{$maincategory->category}}</option>
                                @endforeach
                            </select>
                            <br><br>

                            <label for="exampleFormControlInput1" class="form-label">parent of Sub Categories</label>
                            <input type="text" name='type' class="form-control" placeholder="Parent"><br>
                            <input type="hidden" name='translation_lang'value="{{app()->getLocale()}}" class="form-control"><br>

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
                url:"{{route('store_parent')}}",
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

        @include('accounts.delete_account');  
    </script>
@endsection
