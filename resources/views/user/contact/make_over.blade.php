@extends('layouts.html')
@section('content')

    @include('layouts.section')

    <section class="ad-post bg-gray py-5">
        <div class="container">
            <form id="allData" action="" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Post Your ad start -->
                <fieldset class="border border-gary p-4 mb-5">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3>{{website_translation('Post Your ad')}}</h3>
                        </div>
                        <div class="col-lg-6">
                            <h6 class="font-weight-bold pt-4 pb-1">{{website_translation("Category Name")}}</h6>
                            <input type="text" name="category" class="border w-100 p-2 bg-white text-capitalize" placeholder="Category Name">
                            <small type="hidden" class="text text-danger" id="category"></small>
                            <h6 class="font-weight-bold pt-4 pb-1">{{website_translation("Ad Type")}}:</h6>
                            <div class="row px-3">
                                <div class="col-lg-4 mr-lg-4 my-2 rounded bg-white">
                                    <input type="radio" name="condition" value="personal" id="personal">
                                    <label for="personal" class="py-2">{{website_translation('Personal')}}</label>
                                </div>
                                <div class="col-lg-4 mr-lg-4 my-2 rounded bg-white ">
                                    <input type="radio" name="condition" value="business" id="business">
                                    <label for="business" class="py-2">{{website_translation('Business')}}</label>
                                </div>
                                <small type="hidden" class="text text-danger" id="condition"></small>
                            </div>
                            <h6 class="font-weight-bold pt-4 pb-1">{{website_translation('Description')}}:</h6>
                            <textarea name="description" id="" class="border p-3 w-100" rows="7" placeholder="Write details about your product"></textarea>
                            <small type="hidden" class="text text-danger" id="description"></small>
                        </div>
                        <div class="col-lg-6">

                            <div class="price">
                                <h6 class="font-weight-bold pt-4 pb-1">{{website_translation('Item Price')}} ($ USD):</h6>
                                <div class="row px-3">
                                    <div class="col-lg-4 mr-lg-4 rounded bg-white my-2 ">
                                        <input type="text" name="the_price" class="border-0 py-2 w-100 price" placeholder="price"
                                               id="price">

                                    </div>
                                    <div class="col-lg-4 mrx-4 rounded bg-white my-2 ">
                                        <input type="checkbox" name="negotiate" value="yes" id="Negotiable" checked>
                                        <label for="Negotiable" class="py-2">{{website_translation('Negotiable')}}</label>

                                    </div>
                                    <small type="hidden" class="text text-danger" id="the_price"></small>

                                    <small type="hidden" class="text text-danger" id="negotiate"></small>
                                </div>
                            </div>

                            <div class="choose-file text-center my-4 py-4 rounded">
                                <label for="file-upload">
                                    <span class="d-block font-weight-bold text-dark">{{website_translation('Drop images anywhere to upload')}}</span>
                                    <span class="d-block">or</span>
                                    <span class="d-block btn bg-primary text-white my-3 select-files">{{website_translation('Select Images')}}</span>
                                    <span class="d-block">{{website_translation("Maximum upload image size")}}: 500 KB</span>
                                    <input type="file" class="form-control-file d-none" id="file-upload" name="image">
                                    <small type="hidden" class="text text-danger" id="image"></small>
                                </label>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <!-- Post Your ad end -->

                <!-- seller-information start -->
                <fieldset class="border p-4 my-5 seller-information bg-gray">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3>{{website_translation('Your Information')}}</h3>
                        </div>
                        <div class="col-lg-6">
                            <h6 class="font-weight-bold pt-4 pb-1">{{website_translation('Contact Name')}}:</h6>
                            <input type="text" placeholder="Contact name"name="name" class="border w-100 p-2">
                            <small type="hidden" class="text text-danger" id="name"></small>
                            <h6 class="font-weight-bold pt-4 pb-1">{{website_translation('Contact Number')}}:</h6>
                            <input type="text" placeholder="Contact Number" name="mobile" class="border w-100 p-2">
                            <small type="hidden" class="text text-danger" id="mobile"></small>
                        </div>
                        <div class="col-lg-6">
                            <h6 class="font-weight-bold pt-4 pb-1">{{website_translation("Contact Mail")}}:</h6>
                            <input type="email" placeholder="name@yourmail.com"name="email" class="border w-100 p-2">
                            <small type="hidden" class="text text-danger" id="email"></small>
                            <h6 class="font-weight-bold pt-4 pb-1">{{website_translation('Contact Adress')}}:</h6>
                            <input type="text" placeholder="Your address"name="address" class="border w-100 p-2">
                            <small type="hidden" class="text text-danger" id="address"></small>
                        </div>
                    </div>
                </fieldset>
                    <button id="submitData" type="submit" class="btn btn-primary d-block mt-2">{{website_translation('Post Your category')}}</button>
            </form>
        </div>
    </section>
    <!--============================
    =            Footer            =
    =============================-->
    @include('layouts.footer')

    @endsection
@section('scripts')
    <script>
        $(document).on('click','#submitData',function(e){
            e.preventDefault();
            var data = new FormData($('#allData')[0]);
            $('#name').text('');
            $('#email').text('');
            $('#address').text('');
            $('#mobile').text('');
            $('#category').text('');
            $('#the_price').text('');
            $('#description').text('');
            $('#paying_off').text('');
            $('#condition').text('');
            $('#image').text('');
            $.ajax({
                type:'POST',
                url:"{{route('store_over')}}",
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
                    var response=$.parseJSON(reject.responseText);
                    $.each(response.errors,function(key,val){
                        $('#' + key).text(val[0]);

                    });

                }

            });
        });
    </script>
    @endsection
