


@extends('layouts.html')
@section('content')

    @include('layouts.section')

    <!-- page title -->
    <!--================================
    =            Page Title            =
    =================================-->
    <section class="page-title">
        <!-- Container Start -->
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2 text-center">
                    <!-- Title text -->
                    <h3>Contact Us</h3>
                </div>
            </div>
        </div>
        <!-- Container End -->
    </section>
    <!-- page title -->

    <!-- contact us start-->
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="contact-us-content p-4">
                        <h5>Contact Us</h5>
                        <h1 class="pt-3">Hello, what's on your mind?</h1>
                        <p class="pt-3 pb-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla elit dolor, blandit vel euismod ac, lentesque et dolor. Ut id tempus ipsum.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    @if(isset($subcategory))
                        <form id="allData" action="{{route('checkout_id',$subcategory->id)}}" method="post">
                            @csrf

                            <fieldset class="p-4">
                                <div class="form-group">
                                    @include('alarms.alarm')
                                    <small type="hidden" id="address" class="text text-danger" ></small>

                                    <img style="border-radius: 50px" src="{{asset(\App\Models\SubCategory::PathImage().$subcategory->image)}}"width="500px" height="600px">

                                </div>

                                <div >
                                    <label><strong>Your Category</strong></label>
                                    <input type="text"value="{{$subcategory->name}}"name="category" placeholder="Category Name" class="form-control w-100" required>
                                </div>
                                <small id="category" type="hidden" class="text text-danger"></small>

                                <div class="btn-grounp">
                                    <button type="submit" id="submitData" class="btn btn-primary mt-2 float-right">Buy</button>
                                </div>
                            </fieldset>
                        </form>
                    @else

                    @endif

                </div>
            </div>
        </div>
    </section>

    <!-- contact us end -->

    <!--============================
    =            Footer            =
    =============================-->
    @include('layouts.footer')
@endsection

