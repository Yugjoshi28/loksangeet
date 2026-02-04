<div class="page-wrapper">
    <div class="page-content">

        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h5 class="mb-0 text-uppercase">Dashboard</h5>
                <p class="text-secondary">Welcome back Admin , <strong><?= htmlspecialchars(ucfirst($this->session->userdata('user_name') ?? 'Admin')); ?></strong> ❤️</p>
            </div>
        </div>


        <div class="row g-4">

            <!-- TOTAL TASKS -->
            <div class="col-xl-4 col-md-6">
                <div class="card shadow-sm rounded-4 h-100 border-0 overflow-hidden">
                    <div class="bg-primary" style="height:4px"></div>

                    <div class="card-body p-4">

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="rounded-circle d-flex align-items-center justify-content-center"
                                style="width:52px;height:52px;background:#0d6efd;">
                                <i class="bx bx-task text-white fs-3"></i>
                            </div>

                            <div class="rounded-circle d-flex align-items-center justify-content-center"
                                style="width:38px;height:38px;background:#e9f2ff;">
                                <i class="bx bx-trending-up text-primary"></i>
                            </div>
                        </div>

                        <small class="text-muted fw-semibold text-uppercase">Total Tasks</small>

                        <div class="d-flex align-items-center gap-3 mt-1">
                            <h2 class="fw-bold mb-0"><?= number_format($total_tasks) ?></h2>
                            <span class="text-success small fw-semibold">
                                <i class="bx bx-up-arrow-alt"></i>12%
                            </span>
                        </div>

                    </div>
                </div>
            </div>


            <!-- ACTIVE USERS -->
            <div class="col-xl-4 col-md-6">
                <div class="card shadow-sm rounded-4 h-100 border-0 overflow-hidden">
                    <div class="bg-success" style="height:4px"></div>

                    <div class="card-body p-4">

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="rounded-circle d-flex align-items-center justify-content-center"
                                style="width:52px;height:52px;background:#198754;">
                                <i class="bx bx-user text-white fs-3"></i>
                            </div>

                            <div class="rounded-circle d-flex align-items-center justify-content-center"
                                style="width:38px;height:38px;background:#eaf7f1;">
                                <i class="bx bx-user-check text-success"></i>
                            </div>
                        </div>

                        <small class="text-muted fw-semibold text-uppercase">Active Users</small>

                        <h2 class="fw-bold mt-1"><?= number_format($total_users) ?></h2>

                    </div>
                </div>
            </div>


            <!-- EFFICIENCY -->
            <div class="col-xl-4 col-md-6">
                <div class="card shadow-sm rounded-4 h-100 border-0 overflow-hidden">
                    <div class="bg-warning" style="height:4px"></div>

                    <div class="card-body p-4">

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="rounded-circle d-flex align-items-center justify-content-center"
                                style="width:52px;height:52px;background:#ffc107;">
                                <i class="bx bx-calendar-check text-white fs-3"></i>
                            </div>

                            <div class="rounded-circle d-flex align-items-center justify-content-center"
                                style="width:38px;height:38px;background:#fff7e1;">
                                <i class="bx bx-tachometer text-warning"></i>
                            </div>
                        </div>

                        <small class="text-muted fw-semibold text-uppercase">Efficiency</small>

                        <h2 class="fw-bold mt-1">
                            <?= round(($completed_tasks / max($total_tasks, 1)) * 100) ?>%
                        </h2>

                    </div>
                </div>
            </div>

        </div>



    </div>
































































    <!-- <div class="col-12 col-xl-4">
                <div class="card rounded-4 mb-0">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between mb-3">
                            <div class="">
                                <h6 class="mb-0">Sales & Views</h6>
                            </div>
                            <div class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle-nocaret more-options dropdown-toggle"
                                    data-bs-toggle="dropdown">
                                    <i class='bx bx-dots-vertical-rounded'></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                                    <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
                                    <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
                                </ul>
                            </div>
                        </div>
                        <div id="chart3"></div>
                    </div>
                </div>
            </div> -->
    <!-- <div class="col-12 col-xl-2">
                <div class="card rounded-4 mb-0 overflow-hidden mb-0">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between mb-1">
                            <div class="">
                                <h4 class="mb-0">87.4K</h4>
                                <p class="mb-0">Total Clicks</p>
                            </div>
                            <div class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle-nocaret more-options dropdown-toggle"
                                    data-bs-toggle="dropdown">
                                    <i class='bx bx-dots-vertical-rounded'></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                                    <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
                                    <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="chart-container">
                        <div id="chart4"></div>
                    </div>
                </div>
            </div> -->
    <!-- <div class="col-12 col-xl-4">
                <div class="card border-0 rounded-4 shadow-none mb-0 bg-transparent mb-0">
                    <div class="card-body p-0">
                        <div class="d-flex flex-column gap-4">
                            <div class="card rounded-4 mb-0">
                                <div class="card-body">
                                    <div class="d-flex align-items-start justify-content-between mb-1">
                                        <div class="">
                                            <h6 class="mb-4">Card Data</h6>
                                        </div>
                                        <div class="dropdown">
                                            <a href="javascript:;" class="dropdown-toggle-nocaret more-options dropdown-toggle"
                                                data-bs-toggle="dropdown">
                                                <i class='bx bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                                                <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
                                                <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center gap-3 mb-4">
                                        <div class="mb-0 widgets-icons bg-light-primary text-primary rounded-circle d-flex align-items-center justify-content-center">
                                            <i class='bx bx-credit-card-alt'></i>
                                        </div>
                                        <div class="">
                                            <h3 class="mb-0">$68,452</h3>
                                            <p class="mb-0">Total Card Transactions</p>
                                        </div>
                                    </div>

                                    <div class="row row-cols-1 row-cols-lg-2 g-3">
                                        <div class="col">
                                            <div class="border rounded-4 p-3">
                                                <div class="fs-3 text-success"><i class='bx bx-credit-card'></i></div>
                                                <h5 class="my-1">$9478</h5>
                                                <p class="mb-0">Transactions</p>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="border rounded-4 p-3">
                                                <div class="fs-3 text-primary"><i class='bx bx-shower'></i></div>
                                                <h5 class="mb-1">$6482</h5>
                                                <p class="mb-0">Total Cashback</p>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="border rounded-4 p-3">
                                                <div class="fs-3 text-warning"><i class='bx bx-pie-chart'></i></div>
                                                <h5 class="mb-1">$5784</h5>
                                                <p class="mb-0">Credit Balance</p>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="border rounded-4 p-3">
                                                <div class="fs-3 text-danger"><i class='bx bx-credit-card-alt'></i></div>
                                                <h5 class="mb-1">$3652</h5>
                                                <p class="mb-0">Debit Money</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div> -->
    <div class="col-12 col-xl-4">
        <div class="card border-0 rounded-4 shadow-none mb-0 bg-transparent mb-0">
            <div class="card-body p-0">
                <!-- <div class="d-flex flex-column gap-4">
                            <div class="card rounded-4 mb-0">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <p class="mb-0">Total Orders</p>
                                            <h4 class="mb-0">78.6K</h4>
                                        </div>
                                        <div class="ms-auto"><i class="bx bx-cart fs-1"></i>
                                        </div>
                                    </div>
                                    <div class="progress radius-10 my-4" style="height:6px;">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 65%"></div>
                                    </div>
                                    <p class="mb-0"><span class="text-success">+37.5K</span> from last month</p>
                                </div>
                            </div>
                            <div class="card rounded-4 mb-0">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="">
                                            <p class="mb-0">Total Clicks</p>
                                            <h4 class="mb-0 d-flex align-items-center gap-2">256.7K
                                                <span class="dash-lable d-flex align-items-center gap-1 rounded mb-0 bg-light-success text-success bg-opacity-10">
                                                    <i class='bx bx-up-arrow-alt'></i>12.9%</span>
                                            </h4>
                                        </div>
                                        <div class="status">
                                            <form>
                                                <select class="form-select form-select-sm rounded-4">
                                                    <option>Weekly</option>
                                                    <option>Monthly</option>
                                                    <option>Yearly</option>
                                                </select>
                                            </form>
                                        </div>
                                    </div>
                                    <div id="chart5"></div>
                                    <div class="d-flex flex-column gap-0 mt-4">
                                        <div class="hstack align-items-center gap-3">
                                            <div class="mb-0 widgets-icons bg-light-primary text-primary rounded-3 d-flex align-items-center justify-content-center">
                                                <i class='bx bx-happy-heart-eyes'></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <p class="mb-0">Total Views</p>
                                                <h5 class="mb-0 d-flex align-items-center gap-2">98547</h5>
                                            </div>
                                            <p class="mb-0"><span class="text-success"><i class="bx bx-up-arrow-alt"></i>+41.3%</span></p>
                                        </div>
                                        <hr>
                                        <div class="hstack align-items-center gap-3">
                                            <div class="mb-0 widgets-icons bg-light-info text-info rounded-3 d-flex align-items-center justify-content-center">
                                                <i class='bx bx-mouse'></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <p class="mb-0">User Clicks</p>
                                                <h5 class="mb-0 d-flex align-items-center gap-2">67258</h5>
                                            </div>
                                            <p class="mb-0"><span class="text-danger"><i class="bx bx-down-arrow-alt"></i>-34.7%</span></p>
                                        </div>
                                        <hr>
                                        <div class="hstack align-items-center gap-3">
                                            <div class="mb-0 widgets-icons bg-light-success text-success rounded-3 d-flex align-items-center justify-content-center">
                                                <i class='bx bx-lemon'></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <p class="mb-0">Page Enteries</p>
                                                <h5 class="mb-0 d-flex align-items-center gap-2">45972</h5>
                                            </div>
                                            <p class="mb-0"><span class="text-success"><i class="bx bx-up-arrow-alt"></i>+72.6%</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card rounded-4">
                                <div class="card-body">
                                    <div class="d-flex align-items-start justify-content-between mb-1">
                                        <div class="">
                                            <h6 class="mb-4">Card Data</h6>
                                        </div>
                                        <div class="dropdown">
                                            <a href="javascript:;" class="dropdown-toggle-nocaret more-options dropdown-toggle"
                                                data-bs-toggle="dropdown">
                                                <i class='bx bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                                                <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
                                                <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <div class="d-flex flex-column gap-4">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="social-icon d-flex align-items-center gap-3 flex-grow-1">
                                                    <img src="assets/images/app/behance.png" width="40" alt="">
                                                    <div>
                                                        <h6 class="mb-0">Behance</h6>
                                                        <p class="mb-0">Social Media</p>
                                                    </div>
                                                </div>
                                                <h5 class="mb-0">45,689</h5>
                                                <div class="dash-lable bg-light-success text-success rounded-3">
                                                    <p class="text-success mb-0">+28.5%</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="social-icon d-flex align-items-center gap-3 flex-grow-1">
                                                    <img src="assets/images/app/twitter.png" width="40" alt="">
                                                    <div>
                                                        <h6 class="mb-0">Twitter</h6>
                                                        <p class="mb-0">Social Media</p>
                                                    </div>
                                                </div>
                                                <h5 class="mb-0">34,248</h5>
                                                <div class="dash-lable bg-light-danger text-danger rounded-3">
                                                    <p class="text-red mb-0">-14.5%</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="social-icon d-flex align-items-center gap-3 flex-grow-1">
                                                    <img src="assets/images/app/envato.png" width="40" alt="">
                                                    <div>
                                                        <h6 class="mb-0">Envato</h6>
                                                        <p class="mb-0">Digital Products</p>
                                                    </div>
                                                </div>
                                                <h5 class="mb-0">45,689</h5>
                                                <div class="dash-lable bg-light-success text-success rounded-3">
                                                    <p class="text-green mb-0">+28.5%</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="social-icon d-flex align-items-center gap-3 flex-grow-1">
                                                    <img src="assets/images/app/figma.png" width="40" alt="">
                                                    <div>
                                                        <h6 class="mb-0">Figma</h6>
                                                        <p class="mb-0">Designing</p>
                                                    </div>
                                                </div>
                                                <h5 class="mb-0">67,249</h5>
                                                <div class="dash-lable bg-light-danger text-danger rounded-3">
                                                    <p class="text-red mb-0">-43.5%</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="social-icon d-flex align-items-center gap-3 flex-grow-1">
                                                    <img src="assets/images/app/apple.png" width="40" alt="">
                                                    <div>
                                                        <h6 class="mb-0">Apple</h6>
                                                        <p class="mb-0">Software</p>
                                                    </div>
                                                </div>
                                                <h5 class="mb-0">67,249</h5>
                                                <div class="dash-lable bg-light-success text-success rounded-3">
                                                    <p class="text-red mb-0">-43.5%</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="social-icon d-flex align-items-center gap-3 flex-grow-1">
                                                    <img src="assets/images/app/github.png" width="40" alt="">
                                                    <div>
                                                        <h6 class="mb-0">Linkedin</h6>
                                                        <p class="mb-0">Conversation</p>
                                                    </div>
                                                </div>
                                                <h5 class="mb-0">89,178</h5>
                                                <div class="dash-lable bg-light-danger text-danger rounded-3">
                                                    <p class="text-green mb-0">+24.7%</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
            </div>
        </div>
    </div>
    <div class="col-12 col-xl-4">
        <div class="card border-0 rounded-4 shadow-none mb-0 bg-transparent">
            <div class="card-body p-0">
                <div class="d-flex flex-column gap-4">


                </div>
            </div>
        </div>
    </div>
</div><!--end row-->

</div>
</div>

<!--end page wrapper -->