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
          <!-- User Profile -->
        @include('profiles.profile')
              
       <!-- delete account modal end-->
             @include('admin.modal')
         </div>
      </div>

<div id='app'>
	  <div id="main" style='margin:-610px -110px 0px 360px'>
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
        <div class="page-heading">
            <section class="section">
                <div id='dash' class="card">
                    <div class="card-header">
                       Our Categories
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="table1">
                            <thead>
                            <tr>
                                <th >Type</th>
                                <th class='text text-center'>Subcategories</th>
                                <th class='text text-center'>Has Images</th>
                                <th class='text text-center'>Has Specifications</th>
                                <th class='text text-center'>Reviews</th>
                                <th>The Number</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if(isset($subcategories) && !empty($subcategories))
                                    @foreach($subcategories as $subcategory)
                                        <tr row='6'>
                                            <td>{{$subcategory->maincategory->branch->branch}}</td>
                                            <td class="text-center">
                                                  <a href="{{route('form_edit_subcategory',$subcategory->id)}}"> {{$subcategory->name}}</a>
                                            </td>
                                          <td class='text text-center'>
                                              @if($subcategory->hasImages() == 'Has Images')
                                                  <a href="{{route('images',$subcategory->id)}}">{{$subcategory->hasImages()}}</a>
                                              @else
                                                {{$subcategory->hasImages()}}
                                              @endif

                                          </td>
                                          <td class='text text-center'>
                                                @if($subcategory->hasSpecifications() == 'Has Specifications')
                                                  <a href="{{route('specifications',$subcategory->id)}}">{{$subcategory->hasSpecifications()}}</a>
                                                @else
                                                  {{$subcategory->hasSpecifications()}}
                                                @endif
                                          </td>
                                          @if ($subcategory->reviews && $subcategory->hasReviews() == 'Has Reviews')
                                            <td class="text twxt-center">
                                              <a href="{{route('reviews',$subcategory->id)}}"> {{$subcategory->hasReviews()}}</a>
                                            </td>
                                            @else
                                            <td class="text twxt-center">
                                                {{$subcategory->hasReviews()}}
                                            </td>
                                          @endif
                                            <td class="text twxt-center">
                                                {{$subcategory->subcategory_num}}
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
</div>
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
