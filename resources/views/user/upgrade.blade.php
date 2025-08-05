
<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>Upgrade Package</title>
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
                                    <h4 class="mb-sm-0 font-size-18">Upgrade Package</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="/User/Dashboard">Dashboard</a></li>
                                            <li class="breadcrumb-item active">Upgrade</li>
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
                                        @foreach($errors as $error)
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                 <strong>Alert!</strong> {{$error->message()}}
                                              </div>
                                        @endforeach

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

                                       @if(is_null($user))
                                       <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h5 class="card-title mb-4">Enter UserID (Available Balance : @if(!is_null($balance)){{round(\Illuminate\Support\Facades\Crypt::decrypt($balance->amount),6)}} @else 0 @endif $)</h5>

                                                        <form class="row row-cols-lg-auto g-3 align-items-center" action="/User/getUser" method="post">
                                                            @csrf
                                                            <div class="col-12">
                                                                <label class="visually-hidden" for="userid">UserID</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-text">@</div>
                                                                    <input type="text" id="userid" class="form-control @error('userid') is-invalid @enderror" name="userid" value="" placeholder="Enter UserID" required>
                                                                    @error('userid')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                          
                                                            <div class="col-12">
                                                                <button type="submit" class="btn btn-primary w-md" onclick="this.disabled=true;this.value='Processing, please wait...';this.form.submit();">Search</button>
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
                                        @else
                                        <h5 class="card-title mb-4">(Available Balance : @if(!is_null($balance)){{round(\Illuminate\Support\Facades\Crypt::decrypt($balance->amount),6)}} @else 0 @endif $)</h5>
                                        <form action="/User/UpgradeUserPackage" method="post">
                                        @csrf
                                        <input type="hidden" name="honeypotu" value="{{$user->id}}">
                                            <div class="row mb-4">
                                                <label for="userid" class="col-sm-3 col-form-label">UserID</label>
                                                <div class="col-sm-9">
                                                  <input type="text" id="userid" class="form-control @error('userid') is-invalid @enderror" name="userid" value="{{ $user->uuid }}" placeholder="UserID" readonly="" required>
                                                        @error('userid')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label for="username" class="col-sm-3 col-form-label">Name</label>
                                                <div class="col-sm-9">
                                                  <input type="text" id="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ $user->name }}" placeholder="User Name" readonly="" required>
                                                        @error('username')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <label for="email" class="col-sm-3 col-form-label">Email</label>
                                                <div class="col-sm-9">
                                                  <input type="text" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" placeholder="Email" readonly="" required>
                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <label for="amount" class="col-sm-3 col-form-label">Amount</label>
                                                <div class="col-sm-9">
                                                  <input type="number" id="amount" class="form-control @error('amount') is-invalid @enderror" name="amount" value="" placeholder="Enter Amount" min="100" required>
                                                        @error('amount')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    <span style="color: #ff0000;">Please enter amount in multiple of 100</span>
                                                </div>
                                            </div>
                                            
                                            <div class="row mb-4">
                                                <label for="password" class="col-sm-3 col-form-label">Password</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" required>
                                                        @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                </div>
                                            </div>

                                            <div class="row justify-content-end">
                                                <div class="col-sm-9">
                                                    <div>
                                                        <button type="submit" class="btn btn-primary w-md" onclick="this.disabled=true;this.value='Processing, please wait...';this.form.submit();">Submit</button>
                                                    </div>
                                                </div>
                                            </div>

                                        </form>
                                        @endif
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
