<!--
=========================================================
Material Dashboard - v2.1.2
=========================================================

Product Page: https://www.creative-tim.com/product/material-dashboard
Copyright 2020 Creative Tim (https://www.creative-tim.com)
Coded by Creative Tim

=========================================================
The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://paytech.sn/cdn/paytech.min.css">

        {{-- <link rel="stylesheet" href="style.css">  --}}
        <link rel="stylesheet" href="{{asset('assets/css/layoutStyle.css')}}">

          <!--select searchs -->
        <link href="{{asset('assets/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet">

        <meta charset="utf-8" />
        <title>
          @yield('title')
        </title>


        <title>Document</title>
    </head>

    <body id="body-pd">
        <header class="header" id="header">

            <div class="row">
                <div class="">

                    <div class="">
                        <nav class="navbar navbar-expand-lg navbar-light bg-light" >
                            <!-- <a class="navbar-brand" href="#">Navbar</a> -->
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="header_toggle">
                                <i class='bx bx-menu ' id="header-toggle"></i>
                            </div>
                            <div class="collapse navbar-collapse" id="navbarNav">
                              <ul class="navbar-nav">
                                    @yield('top-menu')
                                <!-- <li class="nav-item">
                                  <a class="nav-link" href="#">Pricing</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link disabled" href="#">Disabled</a>
                                </li> -->
                              </ul>
                            </div>
                          </nav>
                    </div>

                </div>
                <!-- <div class="d-inline">

                </div> -->
            </div>
            <div class="">
                <!-- <img src="https://i.imgur.com/hczKIze.jpg" alt="">  -->
                <span><i class='material-icons nav_icon'>account_balance_wallet</i><b>SOLDE |</b>{{ $_SESSION['solde'] }} mn</span>
            </div>
        </header>
        @yield('header2')
        <?php
         if ($_SESSION['role']=='Administrateur') {?>
            @include('layouts.sidebar.admin.sidebar')

        <?php }elseif ($_SESSION['role']=='Super administrateur') {?>
            @include('layouts.sidebar.admin.sidebar')

        <?php }elseif ($_SESSION['role']=='Client' || $_SESSION['role']=='Personnel') {?>
            @include('layouts.sidebar.client.sidebar')

        <?php } ?>

            {{-- @include('layouts.sidebar.personnel.sidebar') --}}

        



<div class="row d-flex" style="margin-left:-3%;">


  <?php
  $link = $_SERVER['REQUEST_URI'];
  $link_array = explode('/',$link);
  $page = end($link_array);
  ?>

    <?php if ($page=="message" || $page=="utilisateur") {?>

      <div class=" col-1 " style="border-right:5em;border-shadow:5;" id="">

          @yield('sidebar2')

      </div>
   <?php  }?>


    <?php if ($page=="message") {?>

      <div id="main"  class="height-100  col-md-10 d-inline " style="margin-top:2%;">
    <?php }
    else{?>
      <div id="main"  class="height-100  col-md-12 d-inline " style="margin-top:2%;">
   <?php }?>


      <!-- <div class="row"> -->

    @yield('content')
        <!-- <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body col-md-12">
                            <div class="container">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
      <!-- </div> -->
    </div>
</div>

  <!--   Core JS Files   -->
  <script src="{{asset('assets/js/core/jquery.min.js') }}"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.com/libraries/Chart.js"></script>

  <script src="{{asset('assets/js/script.js') }}"></script>
  <script src="{{asset('assets/js/charts.js') }}"></script>


  <script src="https://paytech.sn/cdn/paytech.min.js"></script>



  {{-- <script src="{{asset('assets/js/core/kumkum.js') }}"></script>--}}

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="{{asset('assets/js/core/popper.min.js') }}"></script>
  <script src="{{asset('assets/js/core/bootstrap-material-design.min.js') }}"></script>
  <script src="{{asset('assets/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
  <!-- Plugin for the momentJs  -->
  {{-- <script src="{{asset('assets/js/plugins/moment.min.js') }}"></script> --}}
  <!--  Plugin for Sweet Alert -->
  {{-- <script src="{{asset('assets/js/plugins/sweetalert2.js') }}"></script> --}}
  <!-- Forms Validations Plugin -->
  {{-- <script src="{{asset('assets/js/plugins/jquery.validate.min.js') }}"></script> --}}
  <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
  {{-- <script src="{{asset('assets/js/plugins/jquery.bootstrap-wizard.js') }}"></script> --}}
  <!--  Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
  <!-- <script src="../assets/js/plugins/bootstrap-selectpicker.js"></script> -->
  <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
  <script src="{{asset('assets/js/plugins/bootstrap-datetimepicker.min.js') }}"></script>
  <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
  <script src="{{asset('assets/js/plugins/jquery.dataTables.min.js') }}"></script>
  <!--  Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->

  <script src="{{asset('assets/js/plugins/bootstrap-tagsinput.js') }}"></script>

  <script src="{{asset('assets/js/choix.js') }}"></script>

  <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->

  <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
  <!-- <script src="{{asset('assets/js/plugins/fullcalendar.min.js') }}"></script> -->
  <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
  <!-- <script src="{{asset('assets/js/plugins/jquery-jvectormap.js') }}"></script> -->
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <!-- <script src="{{asset('assets/js/plugins/nouislider.min.js') }}"></script> -->
  <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script> -->
  <!-- Library for adding dinamically elements -->
  {{-- <script src="{{asset('assets/js/plugins/arrive.min.js') }}"></script> --}}
  <!--  Google Maps Plugin    -->
  <!-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> -->
  <!-- Chartist JS -->
  {{-- <script src="{{asset('assets/js/plugins/chartist.min.js') }}"></script> --}}
  <!--  Notifications Plugin    -->
  {{-- <script src="{{asset('assets/js/plugins/bootstrap-notify.js') }}"></script> --}}
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  {{-- <script src="{{asset('assets/js/material-dashboard.js?v=2.1.2') }}"></script> --}}
  <!-- Material Dashboard DEMO methods, don't include it in your project! -->
  {{-- <script src="{{asset('assets/demo/demo.js') }}"></script> --}}
 <script src="{{asset('assets/bootstrap-select/js/bootstrap-select.js') }}"></script>
 <script type="text/javascript" src="{{asset('assets/js/audio/WebAudioRecorder.min.js') }}"></script>
 <script type="text/javascript" src="{{asset('assets/js/audio/WebAudioRecorderMp3.min.js') }}"></script>
 <script type="text/javascript" src="{{asset('assets/js/audio/app.js') }}"></script>

<!--  chart js  -->


   <script type="text/javascript">

    $(document).ready( function () {
      $('#datatableid2').DataTable({
        "language": {
              "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
          },
        //   "dom": '<"toolbar">frtip'
      });
    //   $("div.toolbar").html('<b>Custom tool bar! Text/images etc.</b>');
    } );


  </script>

  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();

    });
  </script>
  <!--selext search-->

  <script>
     $('.select-live').selectpicker({"liveSearch": true});
     $('.select-live2').selectpicker({"liveSearch": false});
   </script>


<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.js"></script> -->
   <script>

   </script>
   <script>

    </script>

    <script >

      // FileInput
      $('.form-file-simple .inputFileVisible').click(function() {
        console.log("gneuwna")
        $(this).siblings('.inputFileHidden').trigger('click');
      });

      $('.form-file-simple .inputFileHidden').change(function() {
        var filename = $(this).val().replace(/C:\\fakepath\\/i, '');
        $(this).siblings('.inputFileVisible').val(filename);
      });

      $('.form-file-multiple .inputFileVisible, .form-file-multiple .input-group-btn').click(function() {
        $(this).parent().parent().find('.inputFileHidden').trigger('click');
        $(this).parent().parent().addClass('is-focused');
      });

      $('.form-file-multiple .inputFileHidden').change(function() {
        var names = '';
        for (var i = 0; i < $(this).get(0).files.length; ++i) {
          if (i < $(this).get(0).files.length - 1) {
            names += $(this).get(0).files.item(i).name + ',';
          } else {
            names += $(this).get(0).files.item(i).name;
          }
        }
        $(this).siblings('.input-group').find('.inputFileVisible').val(names);
      });

      $('.form-file-multiple .btn').on('focus', function() {
        $(this).parent().siblings().trigger('focus');
      });

      $('.form-file-multiple .btn').on('focusout', function() {
        $(this).parent().siblings().trigger('focusout');
      });
    </script>

<script >

    // $('#smshider').ready(function(){
    //     $("#smshider").change(function(){
    //         $(this).find("option:selected").each(function(){
    //             var optionValue = $(this).attr("value");
    //             //console.log(optionValue);
    //             if(optionValue){
    //                 $(".box").not("." + optionValue).hide();
    //                 $("." + optionValue).show();
    //             } else{
    //                 $(".box").hide();
    //             }
    //         });
    //     }).change();
    // });

    // $('#smshiderLoc').ready(function(){
    //     $("#smshiderLoc").change(function(){
    //         $(this).find("option:selected").each(function(){
    //             var optionValue = $(this).attr("value");
    //             //console.log(optionValue);
    //             if(optionValue){
    //                 $(".box").not("." + optionValue).hide();
    //                 $("." + optionValue).show();
    //             } else{
    //                 $(".box").hide();
    //             }
    //         });
    //     }).change();
    // });


    // $('#bologna-list a').on('click', function (e) {
    //   e.preventDefault()
    //   $(this).tab('show')
    // });

    $("#log").hide();
    $("#prerecordings").hide();
     $("#encodingTypeSelect").hide();
      $("#formats").hide();

</script>
<script>

    $("#pausebtn").hide();
    $("#recordButton").click(function(){
      $("#pausebtn").show();
      $("#recordButton").hide();
    });

     $("#stopButton").click(function(){
      $("#pausebtn").hide();
      $("#recordButton").show();
      $("#stopButton").show();
    });

</script>


  @yield('scripts')
</body>

</html>
