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
    <script>

        // ================================================================
        // CUSTOM DATATABLE
        // ================================================================
        $(document).ready(function() {
            // console.log('test')
            $('#table_id').DataTable({
                dom:  '<lf<t>ip>'
            });
        });

        // ================================================================
        // CLEAR FORM
        // ================================================================
        function clearForm() {
            $('#docNum').val("");
            var now = new Date();
            var month = (now.getMonth() + 1);
            var day = now.getDate();
            if (month < 10)
            month = "0" + month;
            if (day < 10)
            day = "0" + day;
            var today = now.getFullYear() + '-' + month + '-' + day;
            $('#dateStart').val(today);
            $('#dateEnd').val(today);
            $('#maxRecord').val("10");
            $('#docType').val("1");
        }
        // ================================================================
        // TAGGLE OF SLIDE BAR
        // ================================================================
        function toggle() {
            $('#sidebarToggle').toggle(
                console.log('toggle')
            );
        }
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
                <form method="POST" action="main" id="myForm">

{{-- =============================================================== --}}
{{-- PARAMTER  --}}
{{-- =============================================================== --}}
                    @csrf
                    <div class="container-fluid">
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Report</h1>
                            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                        </div>


                        <div class="row">


                            <div class="col-xl-12 col-lg-12">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Criteria</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group" style="width:50%">
                                            <h5 class="small font-weight-bold">Report Type <span class="float-right"></span></h5>
                                            <div class="form-check">
                                                <label class="radio-inline">
                                                    <input type="checkbox" name="typeOKNG[]" value="OK">OK
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="checkbox" name="typeOKNG[]" value="NG">NG
                                                </label>
                                                <!-- <label class="radio-inline" for="flexCheckDefault">
                                                <input class="form-check-input move-left" type="checkbox" value="OK" name="typeOKNG[]">
                                                OK
                                            </label> -->
                                            </div>

                                            <div class="form-check">
                                                <label class="radio-inline">
                                                    <input type="checkbox" name="typeErrorEvent[]" value="Event">Event
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="checkbox" name="typeErrorEvent[]" value="Error">Error
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-group form-inline">

                                                <label for="dateStart">Date Start: </label>
                                                <input class="form-control" type="date" class="" id="dateStart" name="dateStart" onchange="dateEndHandler();">
                                                &nbsp;&nbsp;
                                                <label for="dateStart">Date End: </label>
                                                <input class="form-control" type="date" class="" id="dateEnd" name="dateEnd">
                                                &nbsp;&nbsp;
                                                <label for="dateStart">PDS no. </label>
                                                <input class="form-control" type="text" class="" id="pdsNo" name="pdsNo">
                                            </div>
                                            <div class="form-group form-inline">


                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Search</button>
                                            <button type="button" class="btn btn-secondary" onclick="clearForm()">Clear</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

{{-- =============================================================== --}}
{{-- TABLE VALUE  --}}
{{-- =============================================================== --}}
                    <div class="container-fluid">

                        <!-- Page Heading -->
                        {{-- <div class="d-sm-flex align-items-center justify-content-between mb-4">

                        </div> --}}

                        <!-- Content Row -->
                        <div class="row">

                            <!-- Project Card Example -->
                            <div class="col-xl-12 col-lg-12">
                                <div class="card shadow mb-4">
                                    {{-- <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Table Information</h6>
                                    </div> --}}
                                    <div class="card-body">
                                        <div class="table-responsive">

                                            <table class="table table-bordered" id="table_id" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <?php if (isset($keyArray)) {
                                                            foreach ($keyArray as $key => $value) { ?>

                                                                <th scope="col">{{$value}}</th>

                                                        <?php  }
                                                        } ?>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (isset($result)) {
                                                        foreach ($result as $keyResult => $row) { ?>
                                                            <tr>
                                                                <?php foreach ($row as $keyRow => $data) { ?>


                                                                    <td>{{$row[$keyRow]}}</td>

                                                                <?php } ?>
                                                            </tr>
                                                    <?php }
                                                    } ?>




                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
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
