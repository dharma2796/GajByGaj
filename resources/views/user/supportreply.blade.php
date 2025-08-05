
<!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title>Support</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

        <!-- Bootstrap Css -->
        <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App js -->
        <script src="{{asset('assets/js/plugin.js')}}"></script>

    </head>

    <body data-sidebar="dark">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">

            
            @include('user.headeruser')


            <!-- ========== Left Sidebar Start ========== -->
            @include('user.sidebaruser')
            <!-- Left Sidebar End -->

            

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->

            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Support</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="/User/Dashboard">Dashboard</a></li>
                                            <li class="breadcrumb-item active"><a href="/User/ViewTicket">Support</a></li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        @if (session('success'))
                                          <div class="alert alert-success alert-dismissible fade show" role="alert">
                                             {{ session('success') }}
                                          </div>
                                       @endif
                                       @if (session('warning'))
                                          <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                             {{ session('warning') }}
                                          </div>
                                       @endif

                        <div class="d-lg-flex">
                            
                            <div class="w-100 user-chat">
                                <div class="card">
                                    <div class="p-4 border-bottom ">
                                        <div class="row">
                                            <div class="col-md-6 col-9">
                                                <h5 class="font-size-15 mb-1">View Ticket</h5>
                                                <p class="text-muted mb-0"> ({{$viewticket[0]->title}})</p>
                                            </div>
                                            
                                        </div>
                                    </div>
    
    
                                    <div>
                                        <div class="chat-conversation p-3">
                                            <ul class="list-unstyled mb-0" data-simplebar style="max-height: 486px;">
                                                @foreach ($viewticket as $view)
                                                <?php if($view->ustatus==0){ ?>
                                                <li class="right">
                                                    <div class="conversation-list">
                                                        <!-- <div class="dropdown">
    
                                                            <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                              </a>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="#">Copy</a>
                                                                <a class="dropdown-item" href="#">Save</a>
                                                                <a class="dropdown-item" href="#">Forward</a>
                                                                <a class="dropdown-item" href="#">Delete</a>
                                                            </div>
                                                        </div> -->
                                                        <div class="ctext-wrap">
                                                            <div class="conversation-name">You</div>
                                                            <p>
                                                                {!! $view->htext !!}
                                                            </p>
    
                                                            <p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i> {{$view->created_at}}</p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <?php }else{ ?>
                                                <li>
                                                    <div class="conversation-list">
                                                        <!-- <div class="dropdown">
    
                                                            <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                              </a>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="#">Copy</a>
                                                                <a class="dropdown-item" href="#">Save</a>
                                                                <a class="dropdown-item" href="#">Forward</a>
                                                                <a class="dropdown-item" href="#">Delete</a>
                                                            </div>
                                                        </div> -->
                                                        <div class="ctext-wrap">
                                                            <div class="conversation-name">Support</div>
                                                            <p>
                                                                {!! $view->htext !!}
                                                            </p>
                                                            <p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i> {{$view->created_at}}</p>
                                                        </div>
                                                        
                                                    </div>
                                                </li>
                                                <?php } ?>
                                                @endforeach 
                                                
                                                
                                            </ul>
                                        </div>
                                        <form action="/User/ReplyTicket" method="post">
                                        @csrf
                                            <div class="p-3 chat-input-section">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="position-relative">
                                                            <input type="hidden" value="{{ $viewticket[0]->subid}}" name="ticket">
                                                            <input type="text" name="textmsg" class="form-control chat-input" placeholder="Enter Message...">
                                                            @error('textmsg')
                                                               <span class="invalid-feedback" role="alert">
                                                                   <strong>{{ $message }}</strong>
                                                               </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <button type="submit" class="btn btn-primary btn-rounded chat-send w-md waves-effect waves-light"><span class="d-none d-sm-inline-block me-2">Send</span> <i class="mdi mdi-send"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- end row -->
                        
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <script>document.write(new Date().getFullYear())</script> © FMG.
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-end d-none d-sm-block">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->


        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        <script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>
        <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>

        <script src="{{asset('assets/js/app.js')}}"></script>

    </body>
</html>
