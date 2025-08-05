
<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>Profile</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

        <!-- Bootstrap Css -->
        <link href="{{asset('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{asset('assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
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
                                    <h4 class="mb-sm-0 font-size-18">Profile</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="/User/Dashboard">Dashboard</a></li>
                                            <li class="breadcrumb-item active">Update Profile</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            

                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4"></h4>

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

                                        <form action="/User/EditProfile" method="post">
                                        @csrf
                                            <div class="row">
                                                
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="names" class="form-label">Member Name</label>
                                                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ $profile->usersname }}" id="names" placeholder="Member Name" required="" readonly>
                                                            @error('username')
                                                                <span class="invalid-feedback">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="formrow-password-input" class="form-label">Sponsor</label>
                                                        <input type="password" class="form-control" id="formrow-password-input" value="{{ $profile->guiderid }}" readonly>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="formrow-email-input" class="form-label">Email</label>
                                                        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $profile->email }}" id="exampleFormControlInput3" placeholder="Email" required="" readonly>
                                                            @error('email')
                                                                <span class="invalid-feedback">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="mobile" class="form-label">Password</label>
                                                        <input type="number" name="contact" class="form-control @error('contact') is-invalid @enderror" value="{{ $profile->contact }}" id="mobile" placeholder="Mobile No." required="" readonly>
                                                            @error('contact')
                                                                <span class="invalid-feedback">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="usdtbep20address" class="form-label">USDT BEP20 Address</label>
                                                        @if(is_null($profile->usdtbep20address))
                                                            <input type="text" name="usdtbep20address" class="form-control @error('usdtbep20address') is-invalid @enderror" value="{{ $profile->usdtbep20address }}" id="usdtbep20address" placeholder="USDT BEP20 Address ">
                                                        @else
                                                            <br><label class="form-label" style="font-size: .755rem; word-break: break-all; overflow-wrap: break-word;white-space: normal; color: #000;">{{ $profile->usdtbep20address }}</label>
                                                        @endif
                                                            @error('usdtbep20address')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="usdttrc20address" class="form-label">USDT TRC20 Address</label>
                                                        @if(is_null($profile->usdttrc20address))
                                                            <input type="text" name="usdttrc20address" class="form-control @error('usdttrc20address') is-invalid @enderror" value="{{ $profile->usdttrc20address }}" id="usdttrc20address" placeholder="USDT TRC20 Address">
                                                        @else
                                                              <br><label class="form-label" for="usdttrc20address" style="font-size: .755rem; word-break: break-all; overflow-wrap: break-word;white-space: normal; color: #000;">{{ $profile->usdttrc20address }}</label>
                                                        @endif
                                                            @error('usdttrc20address')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row justify-content-end">
                                                <div class="col-sm-12">
                                                    @if(is_null($profile->usdtbep20address) || is_null($profile->usdttrc20address))
                                                    <div>
                                                        <button type="submit" class="btn btn-primary w-md" onclick="this.disabled=true;this.value='Processing, please wait...';this.form.submit();">Submit</button>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
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

        <!-- Right Sidebar -->
        
        <!-- /Right-bar -->

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
