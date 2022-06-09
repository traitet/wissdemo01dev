<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

{{-- =============================================================== --}}
{{-- HEADER  --}}
{{-- =============================================================== --}}
    <title>WISS: Web IT Self-Service 2022</title>
    @include('theme.header')


{{-- =============================================================== --}}
{{-- ADJUST TABLE STYLE  --}}
{{-- =============================================================== --}}
    <!-- Styles -->
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

{{-- =============================================================== --}}
{{-- JAVA SCRIPT  --}}
{{-- =============================================================== --}}
    <script>
    </script>

</head>
{{-- =============================================================== --}}
{{-- BODY  --}}
{{-- =============================================================== --}}
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('theme.sidebar')

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                @include('theme.navbar')

{{-- =============================================================== --}}
{{-- CALL MAIN CONTROLLER  --}}
{{-- =============================================================== --}}
                <form method="GET" action="" id="deploycode">

{{-- =============================================================== --}}
{{-- PARAMTER  --}}
{{-- =============================================================== --}}
                    @csrf
                    <div class="container-fluid">
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">

                            <h1 class="h3 mb-0 text-gray-800">Git pull - Deploy wissdemo01 from GitHub main branch  </h1>
                        </div>
                        <div class="row">
                            <div class="col-xl-12 col-lg-12">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Functions</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <input type="text" name="comment" id="comment" class="form-control" placeholder="Fill deploy comment" aria-label="Comment"><br>
                                            <button type="submit" class="btn btn-primary">Deploy code | git pull</button><br>


{{-- =============================================================== --}}
{{-- PHP: DEPLOY AFTER C LICK  --}}
{{-- =============================================================== --}}
<?php
if ($_GET){
    $k = $_GET['comment'];
    echo "<h4>ผลการ Deploy Code เป็นดังนี้ <span>$k</span></h4>  ";
    // $runCmd1 = "cd C:\xampp\htdocs\wissdemo01";
    // $runCmd2 = "git pull";
    $runCMD = "c:\DeployWissdemo01.bat";
    $output = shell_exec($runCMD);
    echo '<pre>' . $output . '</pre>';
}
?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


{{-- =============================================================== --}}
{{-- FOOTER   --}}
{{-- =============================================================== --}}
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

{{-- =============================================================== --}}
{{-- SCROLL TOP TO BUTTON   --}}
{{-- =============================================================== --}}
        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

{{-- =============================================================== --}}
{{-- LOGOUT   --}}
{{-- =============================================================== --}}
        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

{{-- =============================================================== --}}
{{-- INCLUDE FOOTER   --}}
{{-- =============================================================== --}}
        <!-- @include('theme.footer') -->

</body>


</html>
