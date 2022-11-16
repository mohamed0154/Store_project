@extends('layouts.html')
@section('title','Buying')
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
<!-- contact us start-->
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div id='products_body' class="contact-us-content p-4">
                    <h5><img src="{{asset('user/icons/shopping-cart.png')}}" alt=""><strong style="font-size: 15px"> Products cart</strong></h5>
                    <h6 id='total_price' total_price="{{isset($total_price) && $total_price != null ?$total_price:0}}">{{isset($total_price) && $total_price != null ?'Total :'.$total_price:''}}</h6>
                    <button id='electronic' class="btn-sm btn btn-outline-info btn-small"><span class="btnStyle">Electronic Payment</span></button>
                    <div id="products">
                    <table class="table">
                        <thead>
                            <tr>
                            <th>name</th>
                            <th class="text-center">image</th>
                            <th class="text-center">price</th>
                            <th class="text-center">The Number</th>
                            <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if (isset($user_subcategories) && count($user_subcategories) >0)
                            @foreach ($user_subcategories as $subcategory)
                                <tr id='hide{{$subcategory->id}}'>
                                <td>{{$subcategory->name}}</td>

                                <td class="text-center"><img src="{{asset(\App\Models\SubCategory::PathImage().$subcategory->image)}}"width="100px" height="60px">
                                </td>
                                <td class="text-center">{{$subcategory->the_price}}</td>
                                @if(isset($shopping_cart))
                                    @foreach ($shopping_cart as $subcat)
                                        @if ($subcat->subcategory_id == $subcategory->id )
                                        <td class="text-center user_subcat_count{{$subcategory->id}}">{{$subcat->count}}</td>
                                        @endif
                                    @endforeach
                                @endif
                                <td class="action text-center" data-title="Action">
                                    <div class="">
                                        <ul class="list-inline justify-content-center">
                                            <li class="list-inline-item">
                                                <a data-toggle="tooltip" data-placement="top" title="trash" get_id="{{$subcategory->id}}" class="delete delCartSubcat" href="{{route('delete_cart_subcategory',$subcategory->id)}}">
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
            </div>

             <div class="col-md-6">
                <form id="allData" action="" method="post">
                        @csrf
                     <fieldset class="p-4">
                         <div class="form-group">
                                @include('alarms.alarm')
                            <div class="row">
                                <div class="col-lg-6 py-2">
                                    <input type="text"name="name" placeholder="Name" class="form-control" >
                                    <small type="hidden" id="name" class="text text-danger"></small>
                                </div>
                                <div class="col-lg-6 py-2">
                                    <input type="text"name="email" placeholder="Your Email" class="form-control" >
                                    <small type="hidden" id="email" class="text text-danger"></small>
                                </div>
                            </div>

                                <div >
                                    <input type="text"name="mobile" placeholder="Mobile" class="form-control w-100" >
                                </div>
                                <small type="hidden" id="mobile" class="text text-danger" ></small><br>

                                <div >
                                    <input type="text"name="address" placeholder="Address" class="form-control w-100" >
                                </div>
                                <small type="hidden" id="address" class="text text-danger" ></small>

                                <div class="btn-grounp">
                                <button type="submit" id="submitData" class="btn btn-primary mt-2 float-right">Buy</button>

                                </div>
                     </fieldset>

                </form>
                <div id='payment_form'>

                </div>

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

        @section('scripts')
            <script>


                $(document).on('click','#submitData',function(e){
                    e.preventDefault();
                   var data=new FormData($('#allData')[0]);

                    $('#email').text('');
                    $('#name').text('');
                    $('#address').text('');
                    $('#mobile').text('');

                    $.ajax({
                        type:'POST',
                        url:"{{route('store_order')}}",
                        data: data,
                        processData: false,
                        contentType: false,
                        cache: false,

                        success:function(data){
                            if(data.status==true){
                            alert(data.msg);
                            }

                        },
                        error:function(reject){
                            var response=$.parseJSON(reject.responseText);
                            $.each(response.errors,function(key,val){

                               $('#' + key).text(val[0]);

                            });

                        }
                    });
                });

                $(document).on('click','#electronic',function(e){
                    e.preventDefault();
                    var total_price=document.querySelector('h6#total_price');
                     alert('Click ok and wait 5 seconds');
                    $.ajax({
                        type:'POST',
                        url:"{{route('checkout_id')}}",
                        data: {
                            'total_price':total_price.getAttribute('total_price'),
                            '_token':"{{csrf_token()}}",
                        },
                        success:function(data){
                            if(data.status==true){
                                var form=document.querySelector('form#allData'),
                                    payment_form= document.querySelector('div#payment_form');

                                form.style.display='none';
                              // payment_form.appendChild(data.content);
                                console.log(payment_form);
                                $('#payment_form').html(data.content);
                               // $('#allData').html();


                            }

                        },
                        error:function(reject){

                        }
                    });
                });

                $(document).on('click','.delCartSubcat',function(e){
                    e.preventDefault();
                    var id=$(this).attr('get_id');
                    $.ajax({
                        type:'POST',
                        url:"{{route('delete_cart_subcategory')}}",
                        data: {
                            'id':id,
                            '_token':"{{csrf_token()}}",
                        },
                        success:function(data){
                            if(data.status==true){
                             var data_tr=document.querySelector('tr#hide'+id),
                                 counter=document.querySelector('td.user_subcat_count'+id);
                                 alert(data.msg);

                               if(data.msg=='Deleted Done'){
                                  data_tr.style.display='none';
                               }
                                  counter.textContent--;
                            }
                                   alert(data.msg);
                        },
                        error:function(reject){

                        }
                    });
                });
            </script>
         @endsection
