<!DOCTYPE html>
<html lang="en">
<head>

    <!-- SITE TITTLE -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title','MF')</title>


      {{-- bootstrap --}}



    <!-- FAVICON -->
    <link href="{{asset('admin/images/favicon.png')}}" rel="shortcut icon">
    <!-- PLUGINS CSS STYLE -->
    <!-- <link href="plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet"> -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{asset('admin/css/datatable.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/bootstrap.css')}}">



    <link rel="stylesheet" href="{{asset('admin/plugins/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/plugins/bootstrap/css/bootstrap-slider.css')}}">
    <!-- Font Awesome -->
    <link href="{{asset('admin/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- Owl Carousel -->
    <link href="{{asset('admin/plugins/slick-carousel/slick/slick.css')}}" rel="stylesheet">
    <link href="{{asset('admin/plugins/slick-carousel/slick/slick-theme.css')}}" rel="stylesheet">
    <!-- Fancy Box -->
    <link href="{{asset('admin/plugins/fancybox/jquery.fancybox.pack.css')}}" rel="stylesheet">
    <link href="{{asset('admin/plugins/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet">
    <!-- CUSTOM CSS -->
    <link href="{{asset('admin/css/style.css')}}" rel="stylesheet">

<!-- 
    <script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '{your-app-id}',
      cookie     : true,
      xfbml      : true,
      version    : '{api-version}'
    });
      
    FB.AppEvents.logPageView();   
      
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script> -->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body class="body-wrapper">

@yield('content')




<!-- JAVASCRIPTS -->
<script src="{{asset('admin/plugins/jQuery/jquery.min.js')}}"></script>
<script src="{{asset('admin/plugins/bootstrap/js/popper.min.js')}}"></script>
<script src="{{asset('admin/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('admin/plugins/bootstrap/js/bootstrap-slider.js')}}"></script>
{{--      DataTable--}}
<script src="{{asset('admin/js/simple-datatables.js')}}"></script>


<script>
    // Simple Datatable
    let table1 = document.querySelector('#table1');
    let dataTable = new simpleDatatables.DataTable(table1);
</script>

<!-- tether js -->
<script src="{{asset('admin/plugins/tether/js/tether.min.js')}}"></script>
<script src="{{asset('admin/plugins/raty/jquery.raty-fa.js')}}"></script>
<script src="{{asset('admin/plugins/slick-carousel/slick/slick.min.js')}}"></script>
<script src="{{asset('admin/plugins/jquery-nice-select/js/jquery.nice-select.min.js')}}"></script>
<script src="{{asset('admin/plugins/fancybox/jquery.fancybox.pack.js')}}"></script>
<script src="{{asset('admin/plugins/smoothscroll/SmoothScroll.min.js')}}"></script>
<!-- google map -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU&libraries=places"></script>
<script src="{{asset('admin/plugins/google-map/gmap.js')}}"></script>
<script src="{{asset('admin/js/script.js')}}"></script>

<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
</script>

<script
    src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>

@yield('scripts')

</body>

</html>
