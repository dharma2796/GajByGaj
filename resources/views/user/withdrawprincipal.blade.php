
<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>Principal Withdraw</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="FMG" name="description" />
        <meta content="FMG" name="author" />
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
                                    <h4 class="mb-sm-0 font-size-18">Principal Withdraw</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="/User/Dashboard">Dashboard</a></li>
                                            <li class="breadcrumb-item active">Withdraw</li>
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
                                        <h4 class="card-title mb-4">Request for principal withdraw</h4>
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


                                       <?php $n=1; $m=0; $msg='';?>
                                        <?php $t=0; $b=0; ?>
                                        @if(!is_null($user->assetDetail()))
                                                @if(($detail->usdt_withdrawal_status==1 && !is_null($user->assetDetail()->usdttrc20addr)) /*||($detail->usdt_withdrawal_status==0 )*/)
                                                    <?php $t=1; ?>
                                                @else
                                                    <?php $t=0; $msg=$msg." TRC20 ";?>
                                                @endif{{-- {{$t.' '.$detail->usdt_withdrawal_status.' '.$user->assetDetail()->usdttrc20addr}}<br> --}}
                                                @if(($detail->usdtbep20_withdrawal_status==1 && !is_null($user->assetDetail()->usdtbep20addr)) /*|| ($detail->usdtbep20_withdrawal_status==0 )*/)
                                                    <?php $b=1; ?>{{-- {{'hello bep'}} --}}
                                                @else
                                                    <?php $b=0; $msg=$msg." USDT BEP20 ";?>
                                                @endif{{-- {{$b.' '.$detail->usdtbep20_withdrawal_status.' '.$user->assetDetail()->usdtbep20addr}}<br> --}}
                                                
                                        @else
                                            <?php $n=0; ?>
                                        @endif {{-- {{($t || $b)}} --}}
                                        @if($t || $b)
                                        <div>
                                        <?php $day=date("w",strtotime(date("Y-m-d"))); ?>
                                        @if(1==1)
                                        @if(sizeof($deposits))
                                        <form action="/User/PrincipalWithdraw" method="post">
                                        @csrf
                                        <input type="hidden" name="honeypotu" value="{{\Session::get('logtime')}}">
                                            <div class="row mb-4">
                                                <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Choose Package</label>
                                                <div class="col-sm-9">
                                                  <select type="button" class="form-select" name="package">
                                                    @foreach($deposits as $deposits)
                                                        <option value="{{$deposits->id*23436}}">{{floor($deposits->amount)}} $ </option>
                                                    @endforeach
                                                    </select>
                                                    
                                                </div>
                                            </div>
                                           
                                            <div class="row mb-4">
                                                <label for="currency" class="col-sm-3 col-form-label">Currency</label>
                                                <div class="col-sm-9">
                                                  <select type="button" class="form-select" id="selltype" name="currency">
                                                    @if($detail->usdt_withdrawal_status==1 && !is_null($user->assetDetail()->usdttrc20addr))
                                                        <option value="usdt">USDT TRC20</option>
                                                    <?php $m=$m||1; ?>@endif
                                                    @if($detail->usdtbep20_withdrawal_status==1 && !is_null($user->assetDetail()->usdtbep20addr))
                                                        <option value="usdtbep20">USDT BEP20</option>
                                                    <?php $m=$m||1; ?>@endif
                                                    </select>
                                                        @error('currency')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <label for="labeladdress" class="col-sm-3 col-form-label">Withdraw Address:</label>
                                                <div class="col-sm-9">
                                                    <label class="form-label" id="withdrawaladdress" for="withdrawaladdress" style="font-size: .775rem; color:#000; word-break: break-all; overflow-wrap: break-word;white-space: normal;"><h6>{{$user->assetDetail()->usdttrc20addr}}</h6></label>
                                                </div>
                                                
                                            </div>
                                            <div class="row mb-4">
                                                <label for="horizontal-email-input" class="col-sm-3 col-form-label">Account Password</label>
                                                <div class="col-sm-9">
                                                    <input type="password" name="password" class="form-control" placeholder="enter account password" required="">
                                                </div>
                                            </div>

                                            <div class="row justify-content-end">
                                                <div class="col-sm-9">
                                                    @if($m==1)
                                                    <div>
                                                        <button type="submit" class="btn btn-primary w-md" onclick="this.disabled=true;this.value='Processing, please wait...';this.form.submit();">Submit</button>
                                                    </div>  
                                                    @else
                                                        <!-- @if(ceil($user->remainingIncome())>100)
                                                            <button type="submit" class="btn btn-primary w-md" onclick="this.disabled=true;this.value='Processing, please wait...';this.form.submit();">Submit</button>
                                                        @else
                                                            <p> You do not have enough balance.Please first have some. min is 100 USDT</p>
                                                        @endif -->
                                                    @endif

                                                </div>
                                            </div>
  
                                        </form>
                                        @else
                                            <h4 class="card-title mb-4">&nbsp;No package available for principal withdrawal</h4>
                                        @endif
                                        @else
                                            <h4 class="card-title mb-4">&nbsp;Withdrawal available on 15th and last day of month</h4>
                                        @endif
                                        </div>
                                        @else
                                            <h4 class="card-title mb-4">&nbsp;Please update Withdraw Address first.</h4>
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

        <script type="text/javascript">
            $(document).ready(function(){
                $('#currency').change();
                $('#selltype').change();
            });

            $("#selltype").on('change',function(){
                @if(!is_null($user->assetDetail()))
                @if($detail->usdt_withdrawal_status==1 && !is_null($user->assetDetail()->usdttrc20addr))
                if($("#selltype").val()=='usdt'){
                    $("#withdrawaladdress").html('{{$user->assetDetail()->usdttrc20addr}}');
                }@endif  @if($detail->usdtbep20_withdrawal_status==1 && !is_null($user->assetDetail()->usdtbep20addr)) if($("#selltype").val()=='usdtbep20'){
                    $("#withdrawaladdress").html('{{$user->assetDetail()->usdtbep20addr}}');
                } @endif 
                @endif
            });
            
        </script>

    </body>
</html>
