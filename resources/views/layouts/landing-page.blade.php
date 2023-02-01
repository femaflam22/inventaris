<!DOCTYPE html>
<html lang="en">
<head>
  <title>Inventaris SMK Wikrama Bogor</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" href="{{asset('assets/img/logo.png')}}" type="image/x-icon">
  <link rel="stylesheet" href="{{asset('assets/global/landing-page/vendors/owl-carousel/css/owl.carousel.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/global/landing-page/vendors/owl-carousel/css/owl.theme.default.css')}}">
  <link rel="stylesheet" href="{{asset('assets/global/landing-page/vendors/mdi/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/global/landing-page/vendors/aos/css/aos.css')}}">
  <link rel="stylesheet" href="{{asset('assets/global/landing-page/css/style.min.css')}}">
</head>
<body id="body" data-spy="scroll" data-target=".navbar" data-offset="100">

    @yield('content')

    <script src="{{asset('assets/global/landing-page/vendors/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/global/landing-page/vendors/bootstrap/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/global/landing-page/vendors/owl-carousel/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('assets/global/landing-page/vendors/aos/js/aos.js')}}"></script>
    <script src="{{asset('assets/global/landing-page/js/landingpage.js')}}"></script>
    <script>
      @if(count($errors) > 0)
        $('#exampleModal').modal('show');
      @endif
    </script>
</body>
</html>