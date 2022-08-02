<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Web IT Self Service - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="theme/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="theme/css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        @import url(//fonts.googleapis.com/css?family=Lato:700);

        body {
            margin: 0;
            font-family: 'Lato', sans-serif;
            /* text-align: center; */
            color: #999;
        }

        .container {
            width: 100%;
            height: 20%;
            /* position: absolute;
            left: 50%;
            top: 50%;
            margin-left: -150px;
            margin-top: -100px; */
        }

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }

    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        @include('theme.sidebar')
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                @include('theme.navbar')
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>


                        <div class="d-sm-flex align-items-right justify-content-between mb-4">

                            <!-- No use 11/06/2022 -->
                            <?php
                            // The above is identical to this if/else statement
                            if (empty(Auth::user()->name)) {
                        ?>
                            <!-- Register -->
                            <a href="{{ route('register') }}"
                                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                    class="fas fa-id-card fa-sm text-white-50"></i> Register</a>&nbsp;&nbsp;
                            <!-- Login -->
                            <a href="{{ route('login') }}"
                                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                    class="fas fa-id-card fa-sm text-white-50"></i> login</a>
                            <?php
                            }
                        ?>
                            {{-- <!-- Register -->
                            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                    class="fas fa-id-card fa-sm text-white-50"></i> Register</a>&nbsp;&nbsp;
                            <!-- Login -->
                            <a href="{{ route('login') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-id-card fa-sm text-white-50"></i> login</a> --}}
                        </div>


                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <?php
                            $totalLogs = \App\Models\log::getTotalLogAmount();
                            $logs = \App\Models\log::getTopFourLogSystems();
                            $sum = 0;
                            $rowIndex = 0;
                            foreach ($logs as $log){
                                $rowIndex ++;
                                $sum += $log->total;
                                $percent = ($log->total / $totalLogs) * 100;
                        ?>
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            @if ($rowIndex == 1)
                                <div class="card border-left-primary shadow h-100 py-2">
                            @endif
                            @if ($rowIndex == 2)
                                <div class="card border-left-info shadow h-100 py-2">
                            @endif
                            @if ($rowIndex == 3)
                                <div class="card border-left-success shadow h-100 py-2">
                            @endif
                            @if ($rowIndex == 4)
                                <div class="card border-left-warning shadow h-100 py-2">
                            @endif
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        @if ($rowIndex == 1)
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                {{ $log->name }}
                                        @endif
                                        @if ($rowIndex == 2)
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                {{ $log->name }}
                                        @endif
                                        @if ($rowIndex == 3)
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                {{ $log->name }}
                                        @endif
                                        @if ($rowIndex == 4)
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                {{ $log->name }}
                                        @endif

                                    </div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                {{ number_format($percent,2) }}%</div>
                                        </div>
                                        <div class="col">
                                            <div class="progress progress-sm mr-2">
                                                <div
                                                <?php
                                                        if($rowIndex == 1)
                                                            echo "class='progress-bar bg-primary'";
                                                        else if($rowIndex == 2)
                                                            echo "class='progress-bar bg-info'";
                                                        else if($rowIndex == 3)
                                                            echo "class='progress-bar bg-success'";
                                                        else if($rowIndex == 4)
                                                            echo "class='progress-bar bg-warning'";
                                                ?>
                                                role="progressbar"
                                                style='width: {{ number_format($percent,2) }}%'
                                                aria-valuenow='{{ number_format($percent,2)}}' aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                            }
                        ?>

            </div>

            <!-- Content Row -->

            <div class="row">

                <!-- Area Chart -->
                <div class="col-xl-8 col-lg-7">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">WISS Usage</h6>
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                    aria-labelledby="dropdownMenuLink">
                                    <div class="dropdown-header">Dropdown Header:</div>
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-area">
                                <canvas id="myAreaChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pie Chart -->
                <div class="col-xl-4 col-lg-5">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Log Usage</h6>
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                    aria-labelledby="dropdownMenuLink">
                                    <div class="dropdown-header">Dropdown Header:</div>
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-pie pt-4 pb-2">
                                <canvas id="myPieChart"></canvas>
                            </div>
                            <div class="mt-4 text-center small">
                                <span class="mr-2">
                                    <i class="fas fa-circle text-primary"></i> Direct
                                </span>
                                <span class="mr-2">
                                    <i class="fas fa-circle text-success"></i> Social
                                </span>
                                <span class="mr-2">
                                    <i class="fas fa-circle text-info"></i> Referral
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Row -->
            <div class="row">

                <!-- Content Column -->
                <div class="col-lg-6 mb-4">

                    <!-- Project Card Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">User Usage</h6>
                        </div>
                        <div class="card-body">
                            <?php
                            $users = \App\Models\log::getTopFourUserUsage();
                            $rowIndex = 0;
                            $sum = 0;
                            foreach ($users as $user){
                                $rowIndex ++;
                                $sum += $user->total;
                                $percent = ($user->total / $totalLogs) * 100;
                            ?>
                                <h4 class="small font-weight-bold">{{ $user->first_name }}<span class="float-right">{{ number_format($percent,2) }}%</span>
                                </h4>
                                <div class="progress mb-4">
                                    <div
                                    <?php
                                            if($rowIndex == 1)
                                                echo "class='progress-bar bg-success'";
                                            else if($rowIndex == 2)
                                                echo "class='progress-bar bg-info'";
                                            else if($rowIndex == 3)
                                                echo "class='progress-bar bg-warning'";
                                            else if($rowIndex == 4)
                                                echo "class='progress-bar bg-primary'";
                                    ?>
                                    role="progressbar" style='width: {{ number_format($percent,2) }}%'
                                        aria-valuenow='{{ number_format($percent,2) }}' aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            <?php
                            }
                                $sum = $totalLogs - $sum;
                                $percent = ($sum / $totalLogs) * 100;
                            ?>
                            <h4 class="small font-weight-bold">Other <span class="float-right">{{ number_format($percent,2) }}%</span>
                            </h4>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: {{ number_format($percent,2) }}%"
                                    aria-valuenow="{{ number_format($percent,2) }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>

                        </div>
                    </div>

                    {{-- <!-- Color System -->
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="card bg-primary text-white shadow">
                                <div class="card-body">
                                    Primary
                                    <div class="text-white-50 small">#4e73df</div>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                </div>

                <div class="col-lg-6 mb-4">

                    <!-- Illustrations -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">IT Policy</h6>
                        </div>
                        <div class="card-body">
                            <div class="text-center">
                                <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                                    src="img/undraw_posting_photo.svg" alt="...">
                            </div>
                            <p>Add some quality, svg illustrations to your project courtesy of <a target="_blank"
                                    rel="nofollow" href="https://undraw.co/">unDraw</a>, a
                                constantly updated collection of beautiful svg images that you can use
                                completely free and without attribution!</p>
                            <a target="_blank" rel="nofollow" href="https://undraw.co/">Browse Illustrations on
                                unDraw &rarr;</a>
                        </div>
                    </div>

                    <!-- Approach -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">WISS Policy</h6>
                        </div>
                        <div class="card-body">
                            <p>SB Admin 2 makes extensive use of Bootstrap 4 utility classes in order to reduce
                                CSS bloat and poor page performance. Custom CSS classes are used to create
                                custom components and custom utility classes.</p>
                            <p class="mb-0">Before working with this theme, you should become familiar with the
                                Bootstrap framework, especially the utility classes.</p>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; ITM, AIAP 2022</span>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="theme/vendor/jquery/jquery.min.js"></script>
    <script src="theme/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="theme/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="theme/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="theme/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="theme/js/demo/chart-area-demo.js"></script>
    {{-- <script src="theme/js/demo/chart-pie-demo.js"></script> --}}
    <script>
        // Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    <?php $logs = \App\Models\log::getTotalLog(); ?>
    labels: ["Direct", "Referral", "Social"],
    datasets: [{
      data:[ <?php
                            foreach ($logs as $log){
                                echo $log->total.",";
                            }
            ?>],
    //   data: [50, 35, 15],
      backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#36b9cc', '#36b9cc'],
      hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', '#2c9faf', '#2c9faf'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});

    </script>

</body>

</html>
