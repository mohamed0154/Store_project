@extends('layouts.html')
@section('content')
@include('layouts.section')


<div id="main" style='margin:-90px 0px 0px 0px'>
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

        <div class="page-heading">
      
            <section class="section">
                <div class="card">
                    <div class="card-header">
                       <span style='margin-left:600px;'> Our Overs</span>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="table1">
                            <thead>
                            <tr>
                                
                                <th >seller</th>
                                <th class="text-center">email</th>
                                <th class="text-center">category</th>
                                <th class="text-center">Image</th>
                                <th class="text-center">mobile</th>
                                <th class="text-center">Product Description</th>
                                <th class="text-center">Address</th>
                                <th class="text-center">price</th>
                                <th class="text-center">condition</th>
								<th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($overs) && !empty($overs))
                                @foreach($overs as $over)
                                    <tr>
                                        <td>{{$over->name}}</td>
                                        <td class="text-center">{{$over->email}}</td>
                                        <td class="text-center">{{$over->category}}</td>
                                       
                                        <td class="product-thumb text-center">
                                            <img width="80px" height="auto"
                                                 src="{{asset(\App\Models\Over::PathImage().$over->image)}}"
                                                 alt="image description"></td>
                                         <td class="text-center">{{$over->mobile}}</td>
                                         <td class="text-center">{{$over->description}}</td>
                                        <td class="text-center">{{$over->address}}</td>
                                        <td class="text-center">{{$over->the_price}}</td>
                                        <td class="text-center">{{$over->condition}}</td>
                                        <td class="action text-center" data-title="Action">
                                            <div class="">
                                                <ul class="list-inline justify-content-center">
                                                    <li class="list-inline-item">
                                                       
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a data-toggle="tooltip" data-placement="top" title="trash" get_id="{{$over->id}}" class="delete delData" href="{{route('delete_overs',$over->id)}}">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                            @endif

                            </tbody>
                        </table>
                    </div>
                </div>

            </section>

      

   </div>
   </div>
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
                url:"{{route('delete_overs')}}",
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
    </script>
@endsection
