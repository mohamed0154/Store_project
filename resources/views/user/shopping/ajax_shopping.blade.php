<!-- <script> -->
$(document).on('click','.shoppingCart',function(e){
    e.preventDefault();
    var subcategory_id=$(this).attr('get_id');

       $.ajax({
              type:'POST',
              url:"{{route('shopping_cart')}}",
              data:{
                 'subcategory_id':subcategory_id,
                 '_token':"{{csrf_token()}}",
              },

              success:function(data){
                  var added=document.querySelector('div#addToCart'+subcategory_id),
                  counter=document.querySelector('span#cartStyle');
                  added.style='rgb(52 191 27); font-size:bold; background-color:rgb(238 242 243) !important;font-weight: bolder';
                  var lin_subcategory=document.querySelector('a.hiddCart'+subcategory_id),
                      lit_subcategory=document.querySelector('a.subcat_count'+subcategory_id);
                     console.log(lit_subcategory);
                     console.log(subcategory_id);
                    if(data.status==true){
                        added.textContent=data.count;
                        counter.textContent++;
                        lin_subcategory.textContent='+';
                        lit_subcategory.removeAttribute('style');
                        lin_subcategory.style='margin-left:200px';

                        if(data.count == data.the_num){
                           lin_subcategory.style.display='none';
                           added.textContent=data.count;
                        }
                  }
              }
             
         });
   });

    $(document).on('click','.delCart',function(e){
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
                              var lin_subcategory=document.querySelector('a.subcat_count'+id),
                                  counter=document.querySelector('span#cartStyle'),
                                  lin_plus=document.querySelector('a.hiddCart'+id),
                                  added=document.querySelector('div#addToCart'+id);
                               counter.textContent--;
                               console.log(lin_subcategory);
                               console.log(data.count);
                             
                               added.textContent=data.count;
                               lin_plus.textcontent='+';
                               lin_plus.style='margin-left:200px';
                               if(data.msg=='Deleted Done'){
                                  added.textContent=data.count;
                                  lin_subcategory.style.display='none';
                               } 
                            }
                                 
                        },
                        error:function(reject){

                        }
                    });
                });
               
<!-- {{-- </script> --}} -->
