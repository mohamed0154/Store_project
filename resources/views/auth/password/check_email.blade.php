@extends('layouts.html')

@section('content')
@include('layouts.section')

<section class="login py-5 border-top-1">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-8 align-item-center">
                <div class="border">
                    <h3 class="bg-gray p-4">Login Now</h3>
                    {{-- @if (isset('email'))

                    @endif --}}
                    <form id='allData' action="{{route('make_sure')}}"method='POST'>
						@csrf
                        <fieldset class="p-4">
                            <label>Enter your email</label>
                            <input id='em' type="text" placeholder="Email"name='email' class="border p-3 w-100 my-2 em">
                              <small type='text' id='email_error' class='text text-danger'></small>
                            <button id='submitData'  type="submit" class="d-block py-3 px-5 bg-primary text-white border-0 rounded font-weight-bold mt-3">Send</button>

                        </fieldset>
                    </form>

                    <div id="edit_pass">

                    </div>
                </div>
            </div>
        </div>
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
        var data=new FormData($('#allData')[0]);

         $('#email_error').text('');
        $.ajax({
            type:'POST',
            url:"{{route('make_sure')}}",
            data:data,

            processData: false,
            contentType: false,
            cache: false,
            success:function(data){
              if(data.status==true){
                $('#edit_pass').html(data.msg);
              }
            },
            error:function(reject){
                var response=$.parseJSON(reject.responseText);
               $.each(response.errors,function(key,val){
                   $('#' + key +'_error').text(val[0]);

               });
            }


        });
    });


    $(document).on('click','#subData',function(e){
        e.preventDefault();
        var data=new FormData($('#passData')[0]);

         $('#password_error').text('');
         $('#confirmation_password_error').text('');
         $('#success').text('');
        $.ajax({
            type:'POST',
            url:"{{route('change_password')}}",
            data:data,

            processData: false,
            contentType: false,
            cache: false,
            success:function(data){
              if(data.status==true){
                $('#success').html(data.msg);
              }
            },
            error:function(reject){
                var response=$.parseJSON(reject.responseText);
               $.each(response.errors,function(key,val){
                   $('#' + key +'_error').text(val[0]);

               });
            }


        });

    });


  </script>

@endsection
