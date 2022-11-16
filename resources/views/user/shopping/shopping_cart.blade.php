

Count:<strong>{{$subcategory->subcategory_num}}</strong><br>
<img class="cart"  src="{{asset('user/icons/shopping-cart.png')}}">
@if(isset(App\Models\ShoppingCart::where('subcategory_id',$subcategory->id)
->where('user_id',Auth::id())->first()->count))

        @if(App\Models\ShoppingCart::where('subcategory_id',$subcategory->id)
            ->where('user_id',Auth::id())->first()->count <= $subcategory->subcategory_num)
           <br> <a type="checkbox" id="hhh" class="delCart subcat_count{{$subcategory->id}}"  
                   href="{{route('delete_cart_subcategory',$subcategory->id)}}"get_id="{{$subcategory->id}}">-</a>

            <a type="checkbox" style='margin-left:200px' class="shoppingCart hiddCart{{$subcategory->id}}"
            href="{{route('shopping_cart',$subcategory->id)}}"
            get_id="{{$subcategory->id}}">+</a>
            
       
<div id="{{'addToCart'.$subcategory->id}}">
<strong class="cartNum{{$subcategory->id}}">{{App\Models\ShoppingCart::where('subcategory_id',$subcategory->id)
            ->where('user_id',Auth::id())->first()->count}}</strong> 
</div>
         
        @endif

@elseif($subcategory->subcategory_num > 0)
          <br>  <a type="checkbox" style="display:none" class="delCart subcat_count{{$subcategory->id}}"  
               href="{{route('delete_cart_subcategory',$subcategory->id)}}"get_id="{{$subcategory->id}}">-</a>

            <a type="checkbox" class="shoppingCart hiddCart{{$subcategory->id}}"
               href="{{route('shopping_cart',$subcategory->id)}}"
               get_id="{{$subcategory->id}}">Add to cart</a>
               
<div id="{{'addToCart'.$subcategory->id}}">

</div>
@else
       {{'Not Available'}}
@endif

