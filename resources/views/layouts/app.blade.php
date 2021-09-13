<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Styles -->
    <!-- Bootstrap core CSS     -->
    <link href="http://agr.ehodcorp.com/public/backend/css/bootstrap.min.css" rel="stylesheet" />
    <!--  Material Dashboard CSS    -->
    <link href="http://agr.ehodcorp.com/public/backend/css/material-dashboard.css" rel="stylesheet" />
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="http://agr.ehodcorp.com/public/backend/css/demo.css" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" />
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    @stack('css')
</head>
<body>
    <div id="app">
        <div class="wrapper" ><!-- style="background-image: url('{{ asset('assets/img/annuaire.jpg') }}');" -->
            
            <div class="main-panel" >
                
                    @yield('content')
                
            </div>

        
        </div>
    </div>

    <!-- Scripts -->
    <!--   Core JS Files   -->
    <script src="http://agr.ehodcorp.com/public/backend/js/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="http://agr.ehodcorp.com/public/backend/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="http://agr.ehodcorp.com/public/backend/js/material.min.js" type="text/javascript"></script>
    <!--  Charts Plugin -->
    <script src="http://agr.ehodcorp.com/public/backend/js/chartist.min.js"></script>
    <!--  Dynamic Elements plugin -->
    <script src="http://agr.ehodcorp.com/public/backend/js/arrive.min.js"></script>
    <!--  PerfectScrollbar Library -->
    <script src="http://agr.ehodcorp.com/public/backend/js/perfect-scrollbar.jquery.min.js"></script>
    <!--  Notifications Plugin    -->
    <script src="http://agr.ehodcorp.com/public/backend/js/bootstrap-notify.js"></script>
    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
    <!-- Material Dashboard javascript methods -->
    <script src="http://agr.ehodcorp.com/public/backend/js/material-dashboard.js"></script>
    <!-- Material Dashboard DEMO methods, don't include it in your project! -->
    <script src="http://agr.ehodcorp.com/public/backend/js/demo.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            // Javascript method's body can be found in assets/js/demos.js
            demo.initDashboardPageCharts();

        });
    </script>
    
    @stack('scripts')
</body>
</html>
