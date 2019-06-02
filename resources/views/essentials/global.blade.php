<!DOCTYPE html PUBLIC '-//W3C//DTD HTML 4.01//PT' 'https://www.w3.org/TR/html5/strict.dtd'>
<html lang='pt-BR'>
<head profile='https://www.w3.org/2005/10/profile'>
    <meta name='viewport' content='width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1'>
    <!--JQuery-->
    <script src='https://code.jquery.com/jquery-3.3.1.js'
            integrity='sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js'></script>
    <?php //require getcwd()."/config/minified/JQueryMinified.php" ?>
    <!--Bootstrap-->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js'
            integrity='sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49'
            crossorigin='anonymous'></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    <?php //require getcwd()."/config/minified/BootstrapMinified.php" ?>
    <!--My Global-->
    <script type="text/javascript" src="{{asset('js/global.js')}}"></script>
    <link href="{{asset('css/global.css')}}" rel="stylesheet">
    <!--Utils-->
    <script type="text/javascript" src="{{asset('js/bootstrap-components/Carousel.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/Css.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/mfs-components/Card.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/mfs-components/CardCollection.js')}}"></script>
    <!--Font Awesome JS-->
    <script defer src="https://use.fontawesome.com/releases/v5.5.0/js/all.js"
            integrity="sha384-GqVMZRt5Gn7tB9D9q7ONtcp4gtHIUEW/yG7h98J7IpE3kpi+srfFyyB/04OV6pG0"
            crossorigin="anonymous"></script>
    <!--Tagsinput-->
    <link rel='stylesheet' href="{{asset('css/tags/bootstrap-tagsinput.css')}}">
    <script src="{{asset('js/tags/bootstrap-tagsinput.js')}}"></script>
    <!--Google API-->
    <script async defer src='https://apis.google.com/js/api.js?onload=handleClientLoad'
            onreadystatechange="if (this.readyState === 'complete') this.onload()"></script>
    <script async defer src='https://apis.google.com/js/platform.js?onload=renderButton'></script>
    <title>@yield('title')</title>
</head>

@yield('nav')
    
    </html>