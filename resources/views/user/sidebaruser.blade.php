<div class="vertical-menu">

                <div data-simplebar class="h-100">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li class="menu-title" key="t-menu">Menu</li>

                            <li>
                                <a href="/User/Dashboard" class="waves-effect">
                                    <i class="bx bx-home-circle"></i>
                                    <span key="t-dashboards">Dashboards</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-user-circle"></i>
                                    <span key="t-profile">Profile</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="/User/EditProfile" key="t-profile">Edit Profile</a></li>
                                    <li><a href="/User/ChangePassword" key="t-password">Change Password</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-share-alt"></i>
                                    <span key="t-network">Network</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="/User/DirectTeam" key="t-direct">Direct Members</a></li>
                                    <li><a href="/User/AllTeam" key="t-total">Team Detail</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-archive-in"></i>
                                    <span key="t-deposit">Deposit</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="/User/Deposit" key="t-depositf">Deposit Fund</a></li>
                                    <li><a href="/User/DepositHistory" key="t-deposithistory">Deposit History</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-briefcase-alt-2"></i>
                                    <span key="t-upgrade">Upgrade</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="/User/UpgradePackage" key="t-upgradep">Upgrade Package</a></li>
                                    <li><a href="/User/PackageHistory" key="t-myp">My Packages</a></li>
                                    <li><a href="/User/PackageTransactionHistory" key="t-txp">Transaction History</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-receipt"></i>
                                    <span key="t-income">Income Reports</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="/User/TradingIncome" key="t-daily">Trading Dividend</a></li>
                                    <li><a href="/User/DirectProfit" key="t-directr">Direct Referral</a></li>
                                    <li><a href="/User/LevelIncome" key="t-tdivi">Trading Dividend Bonus</a></li>
                                    <li><a href="/User/GenerationIncome" key="t-teamgen">Team Generation Income </a></li>
                                    <li><a href="/User/GenerationBonus" key="t-royalty">Generation Bonus</a></li>
                                    <li><a href="/User/Salary" key="t-teamdelop">Salary</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-archive-out"></i>
                                    <span key="t-withdraw">Withdraw</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="/User/WithdrawRequest" key="t-withdrawreq">Request for Withdraw</a></li>
                                    <li><a href="/User/PrincipalWithdraw" key="t-withdrawreq">Request Principal Withdraw</a></li>
                                    <li><a href="/User/WithdrawalHistory" key="t-withtry">Withdrawal History</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-chat"></i>
                                    <span key="t-support">Support</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="/User/ViewTicket" key="t-supprt">Support</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="waves-effect">
                                    <i class="bx bx-power-off"></i>
                                    <span key="t-chat">Logout</span>
                                </a>
                            </li>


                        </ul>
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>