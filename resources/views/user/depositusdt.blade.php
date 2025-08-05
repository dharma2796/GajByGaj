
<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>Deposit Fund</title>
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
                                    <h4 class="mb-sm-0 font-size-18">Deposit</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="/User/Dashboard">Dashboard</a></li>
                                            <li class="breadcrumb-item active">Deposit</li>
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

                                        <form action="/User/DepositFund" method="post">
                                        @csrf
                                        <input type="hidden" name="honeypot" value="{{\Session::get('logtime')}}">
                                            <div class="row mb-4">
                                                <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Enter Amount($)</label>
                                                <div class="col-sm-9">
                                                  <input type="number" id="amountusdt" class="form-control @error('amountusdt') is-invalid @enderror" name="amountusdt" value="" step="0.000001" placeholder="Amount *" min="25" required>
                                                        @error('amountusdt')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                </div>
                                            </div>
                                            @if((!is_null($detail->usdt) && $detail->usdt_deposit_status==1) || (!is_null($detail->usdtbep20) && $detail->usdtbep20_deposit_status==1))

                                            <div class="row mb-4">
                                                <label for="currency" class="col-sm-3 col-form-label">Currency</label>
                                                <div class="col-sm-9">
                                                  <select class="form-select" id="currency" name="currency">
                                                    @if((!is_null($detail->usdt) && $detail->usdt_deposit_status==1))
                                                        <option value="usdt">USDT TRC20</option>
                                                    @endif
                                                    @if((!is_null($detail->usdtbep20) && $detail->usdtbep20_deposit_status==1))
                                                        <option value="usdtbep20">USDT BEP20</option>
                                                    @endif
                                                    </select>
                                                        @error('currency')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <label for="labeladdress" class="col-sm-3 col-form-label">Deposit Address</label>
                                                <div class="col-sm-9">
                                                    <label class="form-label" onclick="copyaddr(this);" id="addr" for="addr" style="font-size: .775rem; color:#000; word-break: break-all; overflow-wrap: break-word;white-space: normal;"><h6>{{ \Illuminate\Support\Facades\Crypt::decrypt($detail->usdt) }}</h6></label>
                                                <span class="desc"><br>click to copy or scan QR</span>
                                                </div>
                                                
                                            </div>
                                            <div class="row mb-4">
                                                <label for="labeladdress" class="col-sm-3 col-form-label"></label>
                                                <div class="col-sm-9">
                                                    <img id="qrimg" class="tab-img-icon" alt="icon" style="position: relative; top: 0; max-width: 200px; margin-right: 10px;" src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ \Illuminate\Support\Facades\Crypt::decrypt($detail->usdt) }}">
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <label for="horizontal-email-input" class="col-sm-3 col-form-label">Transaction Hash</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="txnhash" class="form-control @error('txnhash') is-invalid @enderror" id="txnhash" placeholder="Transaction Hash *">
                                                        @error('txnhash')
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

                                            @else
                                            <div class="row justify-content-end">
                                                <label class="form-label" for="deposits"><h6>Deposits are not available right now. Please try again later.</h6></label>
                                            </div>
                                            @endif  
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

        <script type="text/javascript">
    function copyaddr(value) {

                      // Create a "hidden" input
                      var aux = document.createElement("input");

                      aux.setAttribute("value", document.getElementById("addr").innerText);
                      // Append it to the body
                      document.body.appendChild(aux);
                      // Highlight its content
                      aux.select();
                      // Copy the highlighted text
                      document.execCommand("copy");
                      // Remove it from the body
                      document.body.removeChild(aux);
                      
                      alert("Address Copied Successfully: (" + $(value).html() + ").");
                    }
    
    </script>

    <script type="text/javascript">
        /*function copyaddr(value){
        navigator.clipboard.writeText($(value).html());
        alert("Address Copied Successfully: (" + $(value).html() + ").");
        }*/

        /*$("#amountusdtb").on('blur',function(){
            $("#styb").val(Number.parseFloat($("#amountusdtb").val()/{{$detail->price}}).toFixed(6));
            $("#paydetail").show();
        });*/

        $("#currency").on('change',function(){
            if($("#currency").val()=='usdt'){
                $("#qrimg").attr('src','https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{\Illuminate\Support\Facades\Crypt::decrypt($detail->usdt)}}');
                $("#addr").html('{{(\Illuminate\Support\Facades\Crypt::decrypt($detail->usdt))}}');
            }else if($("#currency").val()=='usdtbep20'){
                $("#qrimg").attr('src','https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{\Illuminate\Support\Facades\Crypt::decrypt($detail->usdtbep20)}}');
                $("#addr").html('{{(\Illuminate\Support\Facades\Crypt::decrypt($detail->usdtbep20))}}');
            }
        });

        $(document).ready(function(){
            $('#currency').change();
        });
    </script>

    </body>
</html>
