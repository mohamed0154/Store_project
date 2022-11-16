

$(document).on('click','#delete_account',function(e){
            e.preventDefault();
            $.ajax({
                type:'POST',
              url:"{{route('delete_account')}}",
              data:{
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
