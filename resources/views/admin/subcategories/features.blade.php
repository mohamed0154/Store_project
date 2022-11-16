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
          <!-- delete-account modal -->
          						  <!-- delete account popup modal start-->
                <!-- Modal -->
                @include('admin.modal')
                <!-- delete account popup modal end-->
          <!-- delete-account modal -->

        </div>
      </div>

      <div id='app'>
	  <div id="main" style='margin:-610px 0px 0px 360px'>
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

        <div class="page-heading">

            <section class="section">
                <div class="card">
                    <div class="card-header">
                       Our Categories
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="table1">
                            <thead>
                            <tr>


                                <th class='text text-center'>Subcategories</th>
                                @if(isset($subcategory_specifications))
                                <th class='text text-center'>Specifications</th>

                                @elseif(isset($sub_has_reviews))
                                <th class='text text-center'>Reviews</th>

                                @else
                                <th class='text text-center'>images</th>
                                @endif

                            </tr>
                            </thead>
                            <tbody>

                                    <tr row='6'>
                             @if(isset($subcategory_specifications) && !empty($subcategory_specifications))

                                        <td class="text-center">
                                       <a href="{{route('form_edit_subcategory',$subcategory_specifications->id)}}"> {{$subcategory_specifications->name}}</a>
                                        </td>
                                        <td class='text text-center'>{{$subcategory_specifications->specification->specification}}</td>


                               @elseif(isset($sub_has_reviews) && $sub_has_reviews != null)

                                        <td class="text-center">
                                          <a href="{{route('form_edit_subcategory',$sub_has_reviews->id)}}"> {{$sub_has_reviews->name}}</a>
                                        </td>
                                        @if(count($sub_has_reviews->reviews) > 0)
                                            <td class='text text-center'>
                                                @foreach ($sub_has_reviews->reviews as $review)
                                                    {{$review->opinion}}
                                                @endforeach
                                            </td>
                                        @endif
                                @else

                                        <td >
                                            <a href="{{route('form_edit_subcategory',$subcategory_images->id)}}"> {{$subcategory_images->name}}</a>
                                        </td>

                                        <td class="text text-center">
                                               @if (isset($subcategory_images->images) && $subcategory_images->images->count() >0)
                                                        @foreach($subcategory_images->images as $counter=> $image)
                                                                 @if ($counter %5 == 0)
                                                                     <br>
                                                                 @endif
                                                           <img src="{{asset(App\Models\Subcategory::PathImage() . $image->image)}}" width="80px" height="70px">
                                                        @endforeach
                                               @endif
                                        </td>

                                @endif
                        </tr>
                            </tbody>
                        </table>

                    </div>
                </div>

            </section>
          </div>
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

@section('scripts')
<script>
  @include('accounts.delete_account');
</script>

@endsection
