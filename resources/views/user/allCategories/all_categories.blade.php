@extends('layouts.html')
@section('content')

@include('layouts.section')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="search-result bg-gray">
                <h2> {{isset($mainncategory)?website_translation('Results For') .' '. website_translation($mainncategory->branch->branch):website_translation('Results For Search')}}</h2>
                <p>123 Results on 12 December, 2017</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="category-sidebar">
                <div class="widget category-list">
                    @if(isset($maincategories) && $maincategories->count() > 0)
                      <h4 class="widget-header">{{website_translation("Categories of")}} {{isset($mainncategory)?$mainncategory->branch->branch:''}}</h4>
                        <ul class="category-list">
                            @foreach ($maincategories as $maincategory)
                                @if(isset($maincategory->parents) && $maincategory->parents->count() > 0)
                                    @foreach ($maincategory->parents as $parent)
                                       @if ($parent->subcategories->count() > 0)
                                       <li><a href="{{route('categories_from_parent',$parent->id)}}">{{$parent->type}}<span>{{$parent->subcategories->count()}}</span></a></li>
                                       @endif
                                    @endforeach
                                @endif
                            @endforeach
                        </ul>
                    @endif
                </div>

                <div class="widget category-list">

                    @if(isset($governorates) && $governorates->count() > 0)
                    <h4 class="widget-header">{{website_translation('Our Branches')}}</h4>
                    <ul class="category-list">
                        @foreach($governorates as $governorate)
                            <li><a>{{$governorate->name}}<span>{{$governorate->branches->where('branch',$mainncategory->branch != null?$mainncategory->branch->branch:'')->count()}}</span></a></li>
                        @endforeach
                    </ul>
                    @endif
            </div>
                 @isset($mainncategory)
                    <form action="{{route('categories_by_price')}}" method="get">
                        @csrf
                        <input type="hidden"value="{{$mainncategory->id}}" name="id">
                        <div class="widget price-range w-100">
                            <h4 class="widget-header">{{website_translation("Price Range")}}</h4>
                         <div class="block">
                        <input class="range-track w-100"name="the_price" type="text" data-slider-min="0" data-slider-max="500000" data-slider-step="5"
                               data-slider-value="[5000,500000]">
                               <div class="d-flex justify-content-between mt-2">
                                   <span class="value">5000 - 500000</span>
                               </div>
                        </div>
                        </div>
                        <button   class="btn btn-primary">Show</button>
                    </form>
                @endisset
        </div>
   </div>

<div class="col-md-9">
<div class="category-search-filter">
    <div class="row">
        <div class="col-md-6">

            @include('alarms.alarm')
            <strong>Categories</strong>

        </div>
        <div class="col-md-6">
            <div class="view">
                <strong>Views</strong>
                <ul class="list-inline view-switcher">
                    <li class="list-inline-item">
                        <a href="#" onclick="event.preventDefault();" class="text-info"><i class="fa fa-th-large"></i></a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</div>
<div class="product-grid-list">
    <div class="row mt-30">

            <!-- product card -->


                <!-- product card -->
            @if(isset($subcategories) && $subcategories->count() > 0)
            @foreach ($subcategories as $subcategory)
                <div class="col-sm-12 col-lg-4 col-md-6">
                    <div class="product-item bg-light">
                        <div class="card">
                            <div class="thumb-content">
                                <!-- <div class="price">$200</div> -->
                                <a href="{{route('description_category',$subcategory->id)}}">
                                    <img class="card-img-top img-fluid" src="{{asset("admin/images/subcategories/".$subcategory->image)}}" alt="Card image cap">
                                </a>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title"><a href="{{route('description_category',$subcategory->id)}}">{{$subcategory->name}}</a></h4>
                                <ul class="list-inline product-meta">
                                    <li class="list-inline-item">
                                        <a href="single.html"><i class="fa fa-folder-open-o"></i>{{$subcategory->maincategory->branch->branch}}</a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#"><i class="fa fa-calendar"></i>{{$subcategory->created_at}}</a>
                                    </li>
                                </ul>
                              @include('user.shopping.shopping_cart')
                                <div class="product-ratings">
                                    <ul class="list-inline">
                                      <li id="{{$subcategory->the_price}}"><span>{{locale_lang() != 'en'?__('trans.Price'):'Price'}} : </span>{{$subcategory->the_price}}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
               @else
            @if(isset($your_categories) && count($your_categories) > 0)
                      @foreach($your_categories as $subcategory)

                    <div class="col-sm-12 col-lg-4 col-md-6">
                        <div class="product-item bg-light">
                            <div class="card">
                                <div class="thumb-content">
                                    <!-- <div class="price">$200</div> -->
                                    <a href="single.html">
                                        <img class="card-img-top img-fluid" src="{{asset("admin/images/subcategories/".$subcategory->image)}}" alt="Card image cap">
                                    </a>
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title"><a href="{{route('description_category',$subcategory->id)}}">{{$subcategory->name}}</a></h4>
                                    <ul class="list-inline product-meta">
                                        <li class="list-inline-item">
                                            <a href="single.html"><i class="fa fa-folder-open-o"></i>{{$subcategory->maincategory->branch->branch}}</a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="#"><i class="fa fa-calendar"></i>26th December</a>
                                        </li>
                                    </ul>
                                    @include('user.shopping.shopping_cart')
                                    <div class="product-ratings">
                                        <ul class="list-inline">
                                           <li>{{$subcategory->the_price}}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            @endforeach
            @endif
        @endif
              @if(isset($yourCategories) && count($yourCategories) > 0)
                   @foreach($yourCategories as $subcategory)
                        @if (!empty($subcategory))
                            <div class="col-sm-12 col-lg-4 col-md-6">
                                <div class="product-item bg-light">
                                    <div class="card">
                                        <div class="thumb-content">
                                            <!-- <div class="price">$200</div> -->
                                            <a href="{{route('description_category',$subcategory->id)}}">
                                                <img class="card-img-top img-fluid" src="{{asset("admin/images/subcategories/".$subcategory->image)}}" alt="Card image cap">
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <h4 class="card-title"><a href="{{route('description_category',$subcategory->id)}}">{{$subcategory->name}}</a></h4>
                                            <ul class="list-inline product-meta">
                                                <li class="list-inline-item">
                                                    <a href="single.html"><i class="fa fa-folder-open-o"></i>{{$subcategory->maincategory->branch->branch}}</a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="#"><i class="fa fa-calendar"></i>26th December</a>
                                                </li>
                                            </ul>
                                            @include('user.shopping.shopping_cart')
                                            <div class="product-ratings">
                                                <ul class="list-inline">
                                                    <li>{{$subcategory->the_price}}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                   @endforeach
              @elseif(isset($categories) && $categories->count() > 0)

                   @foreach($categories as $subcategory)
                        <div class="col-sm-12 col-lg-4 col-md-6">
                            <div class="product-item bg-light">
                                <div class="card">
                                    <div class="thumb-content">
                                        <!-- <div class="price">$200</div> -->
                                        <a href="{{route('description_category',$subcategory->id)}}">
                                            <img class="card-img-top img-fluid" src="{{asset("admin/images/subcategories/".$subcategory->image)}}" alt="Card image cap">
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <h4 class="card-title"><a href="{{route('description_category',$subcategory->id)}}">{{$subcategory->name}}</a></h4>
                                        <ul class="list-inline product-meta">
                                            <li class="list-inline-item">
                                                <a href="single.html"><i class="fa fa-folder-open-o"></i>{{$subcategory->maincategory->branch->branch}}</a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="#"><i class="fa fa-calendar"></i>26th December</a>
                                            </li>
                                        </ul>
                                    @include('user.shopping.shopping_cart')
                                        <div class="product-ratings">
                                            <ul class="list-inline">
                                                <li>{{$subcategory->the_price}}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                   @endforeach
              @endif

        {{-- @if(isset($subcategory) && $subcategory != null)
            <div class="col-sm-12 col-lg-4 col-md-6">
                <div class="product-item bg-light">
                    <div class="card">
                        <div class="thumb-content">
                            <!-- <div class="price">$200</div> -->
                            <a href="{{route('description_category',$subcategory->id)}}">
                                <img class="card-img-top img-fluid" src="{{asset("admin/images/subcategories/".$subcategory->image)}}" alt="Card image cap">
                            </a>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title"><a href="{{route('description_category',$subcategory->id)}}">{{$subcategory->name}}</a></h4>
                            <ul class="list-inline product-meta">
                                <li class="list-inline-item">
                                    <a href="single.html"><i class="fa fa-folder-open-o"></i>{{$subcategory->maincategory->branch->branch}}</a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#"><i class="fa fa-calendar"></i>26th December</a>
                                </li>
                            </ul>
                            <p class="card-text">{{isset($subcategory->description->description)?$subcategory->description->description:''}}</p>
                            <div class="product-ratings">
                                <ul class="list-inline">
                                    <li>{{$subcategory->the_price}}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif --}}
    </div>
</div>

            <div class="pagination justify-content-center">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item">
                        </li>
                        {{isset($subcategories)?$subcategories->links():''}}
                    </ul>
                </nav>
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
    
      ////////////////////////////////////////////
////////////////////Add product To Cart////////////////////
 @include('user.shopping.ajax_shopping');
</script>
@endsection

<style>
    .w-5{
        display: none;
    }
    #hide_lang{
        display:none;
    }
</style>
