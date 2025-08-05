<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard</title>
    <meta content="" name="description" />
    <meta content="" name="author" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('ctassets/images/favicon.png')}}" type="image/x-icon" />
    <!-- For iPhone -->
    <link rel="apple-touch-icon-precomposed" href="{{asset('ctassets/images/apple-touch-icon-57-precomposed.png')}}">
    <!-- For iPhone 4 Retina display -->
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('ctassets/images/apple-touch-icon-114-precomposed.png')}}">
    <!-- For iPad -->
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('ctassets/images/apple-touch-icon-72-precomposed.png')}}">
    <!-- For iPad Retina display -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('ctassets/images/apple-touch-icon-144-precomposed.png')}}">

    <!-- CORE CSS FRAMEWORK - START -->
    <link href="{{asset('ctassets/css/pace-theme-flash.css')}}" rel="stylesheet" type="text/css" media="screen" />
    <link href="{{asset('ctassets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('ctassets/css/bootstrap-theme.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('ctassets/css/font-awesome.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('ctassets/css/cryptocoins.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('ctassets/css/animate.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('ctassets/css/perfect-scrollbar.css')}}" rel="stylesheet" type="text/css" />
    <!-- CORE CSS FRAMEWORK - END -->

    <!-- HEADER SCRIPTS INCLUDED ON THIS PAGE - START -->

    <link href="{{asset('ctassets/css/jquery-jvectormap-2.0.1.css')}}" rel="stylesheet" type="text/css" media="screen" />
    <link href="{{asset('ctassets/css/morris.css" rel="stylesheet')}}" type="text/css" media="screen" />

    <!-- HEADER SCRIPTS INCLUDED ON THIS PAGE - END -->

    <!-- CORE CSS TEMPLATE - START -->
    <link href="{{asset('ctassets/css/style.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('ctassets/css/responsive.css')}}" rel="stylesheet" type="text/css" />
    <!-- CORE CSS TEMPLATE - END -->

</head>
<!-- END HEAD -->

<!-- BEGIN BODY -->

<body class=" ">
    <!-- START TOPBAR -->
@include('control.topbaradmin')
    <!-- END TOPBAR -->
    <!-- START CONTAINER -->
    <div class="page-container row-fluid container-fluid">

        <!-- SIDEBAR - START -->
@include('control.sidebaradmin')
        <!--  SIDEBAR - END -->

        <!-- START CONTENT -->
        <section id="main-content" class=" ">
            <div class="wrapper main-wrapper row" style=''>

                <div class='col-xs-12'>
                    <div class="page-title">

                        <div class="pull-left">
                            <!-- PAGE HEADING TAG - START -->
                            <h1 class="title">Dashboard</h1>
                            <!-- PAGE HEADING TAG - END -->
                        </div>

                    </div>
                </div>
                <div class="col-lg-12">
                    <section class="box nobox marginBottom0">
                        <div class="content-body">
                            <div class="row">
                                <div class="col-lg-4 col-sm-6 col-xs-12">
                                    <div class="r4_counter db_box">
                                        <div class="icon-after cc {{-- BTC-alt --}}"></div>
                                        <i class='pull-left cc {{-- BTC-alt --}} icon-md icon-white mt-10'></i>
                                        <div class="stats">
                                            <h3 class="color-white mb-5">{{$data['totalmember']->count()}}</h3>
                                            <span>Total Members</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6 col-xs-12">
                                    <div class="r4_counter db_box">
                                        <div class="icon-after cc {{-- DASH-alt --}}"></div>
                                        <i class='pull-left cc {{-- DASH-alt --}} icon-md icon-primary mt-10'></i>
                                        <div class="stats">
                                            <h3 class="mb-5">{{$data['totalpaid']->count()}}</h3>
                                            <span>Paid Members</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6 col-xs-12">
                                    <div class="r4_counter db_box">
                                        <div class="icon-after cc {{-- LTC-alt --}}"></div>
                                        <i class='pull-left cc {{-- LTC-alt --}} icon-md icon-primary mt-10'></i>
                                        <div class="stats">
                                            <h3 class="mb-5"> {{round($data['totalrevenue']->basicrevenue,2)}} $</h3>
                                            <span>Total Revenue</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-sm-6 col-xs-12">
                                    <div class="r4_counter db_box">
                                        <div class="icon-after cc {{-- BTC-alt --}}"></div>
                                        <i class='pull-left cc {{-- BTC-alt --}} icon-md icon-white mt-10'></i>
                                        <div class="stats">
                                            <h3 class="color-white mb-5"> {{round($data['unpaidwithdraw'],2)}} $</h3>
                                            <span>Ready to Release</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6 col-xs-12">
                                    <div class="r4_counter db_box">
                                        <div class="icon-after cc {{-- LTC-alt --}}"></div>
                                        <i class='pull-left cc {{-- LTC-alt --}} icon-md icon-primary mt-10'></i>
                                        <div class="stats">
                                            <h3 class="mb-5"> {{round($data['totalwithdraw']->totalwithdraw,2)}} $</h3>
                                            <span>Total Withdrawal</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- End .row -->
                        </div>
                    </section>
                </div>

                <div class="clearfix"></div>
                <!-- MAIN CONTENT AREA STARTS -->


            </div>
        </section>
        <!-- END CONTENT -->

    </div>
    <!-- END CONTAINER -->
    <!-- LOAD FILES AT PAGE END FOR FASTER LOADING -->

    <!-- CORE JS FRAMEWORK - START -->
    <script src="{{asset('ctassets/js/jquery-1.11.2.min.js')}}"></script>
    <script src="{{asset('ctassets/js/jquery.easing.min.js')}}"></script>
    <script src="{{asset('ctassets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('ctassets/js/pace.min.js')}}"></script>
    <script src="{{asset('ctassets/js/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('ctassets/js/viewportchecker.js')}}"></script>
    <script>
        window.jQuery || document.write('<script src="{{asset('ctassets/js/jquery-1.11.2.min.js')}}"><\/script>');
    </script>
    <!-- CORE JS FRAMEWORK - END -->

    <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - START -->

    <script src="{{asset('ctassets/js/echarts-custom-for-dashboard.js')}}"></script>

    <script src="{{asset('ctassets/js/jquery.flot.js')}}"></script>
    <script src="{{asset('ctassets/js/jquery.flot.time.js')}}"></script>
    <script src="{{asset('ctassets/js/chart-flot.js')}}"></script>

    <script src="{{asset('ctassets/js/raphael-min.js')}}"></script>
    <script src="{{asset('ctassets/js/morris.min.js')}}"></script>
    <script src="{{asset('ctassets/js/chart-morris.js')}}"></script>
    <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END -->

    <!-- CORE TEMPLATE JS - START -->
    <script src="{{asset('ctassets/js/scripts.js')}}"></script>
    <!-- END CORE TEMPLATE JS - END -->

    <script type="text/javascript">
    function copylnk() {
      
      var copyText = document.getElementById("lnktxt");

      copyText.select();
      copyText.setSelectionRange(0, 99999); /*For mobile devices*/

      document.execCommand("copy");

      alert("Link Copied Successfully: " + copyText.value);
    }
    
    </script>
    {{-- <script type="text/javascript">
        function copyaddr(value){
        navigator.clipboard.writeText($(value).html());
        alert("Referral Link Copied Successfully: (" + $(value).html() + ").");
        }
    </script> --}}

</body>

</html>