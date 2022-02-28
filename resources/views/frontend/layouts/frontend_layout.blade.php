
<!DOCTYPE html>
<html lang="en">
 <head>
   @include('frontend.partials.frontend.head')
   <link rel="stylesheet" href="//cdn.bootcss.com/toastr.js/latest/css/toastr.min.css"> 
             
 </head>
 <body>
@include('frontend.partials.frontend.header') 
@yield('content')
@include('frontend.partials.frontend.footer')
@include('frontend.partials.frontend.footer-scripts')
<script src="//cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::message() !!}
 </body>
</html>