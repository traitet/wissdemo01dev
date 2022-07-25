<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

{{-- ============================================================================================================================== --}}
{{-- HTML HEAD  --}}
{{-- ============================================================================================================================== --}}
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WISS 2022</title>
    @include('theme.header')
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
        // DATE HANDLE
        // ================================================================
        function dateStartHandler() {
            const dateStart = $('#dateStart').val();
            // console.log(dateStart);
            $('#dateStart').val(dateStart);
        }


        // ================================================================
        // DATE HANDLE
        // ================================================================
        function dateEndHandler() {
            const dateEnd = $('#dateEnd').val();
            // console.log(dateStart);
            $('#dateEnd').val(dateEnd);
        }

        // ================================================================
        // CLEAR FORM
        // ================================================================
        const clearForm = () => {
            $('#myForm')[0].reset();
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

{{-- ============================================================================================================================== --}}
{{-- HTML BODY  --}}
{{-- ============================================================================================================================== --}}
<body id="page-top">
    <div id="wrapper">
        @include('theme.sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('theme.navbar')
                {{-- =============================================================== --}}
                {{-- FORM  ACTION = VIEW --}}
                {{-- =============================================================== --}}
                <form method="POST" action="{{ route('EmfgCreatePalletATAC.show', $permissionName) }}" id="myForm">
                    @csrf
                    <div class="container-fluid">
                        {{-- ========================================================= --}}
                        {{-- SUBJECT --}}
                        {{-- ========================================================= --}}
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h5 mb-0 text-gray-800">【 Complete Pallet ATAC 】</h1>
                        </div>

                        {{-- ========================================================= --}}
                        {{-- SERCH PARAMTER --}}
                        {{-- ========================================================= --}}
                        <div class="row">
                            {{-- ========================================================= --}}
                            {{-- BASIC SEARCH --}}
                            {{-- ========================================================= --}}
                            <div class="col-xl-12 col-lg-12">
                                <div class="card shadow mb-4">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <div class="form-group form-inline">
                                                <label for="pickingList">Picking List: </label>
                                                <input class="form-control" type="text" class="" id="pickingList" name="pickingList">&nbsp;&nbsp;
                                                <label for="palletNumber">Pallet Number: </label>
                                                <input class="form-control" type="text" class="" id="palletNumber" name="palletNumber">&nbsp;&nbsp;
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <button type="button" class="btn btn-secondary" onclick="clearForm()">Clear</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


{{-- ========================================================= --}}
{{-- SEARCH OUTPUT --}}
{{-- ========================================================= --}}
                    <div class="container-fluid">
                        {{-- ========================================================= --}}
                        {{-- CLASS ROW --}}
                        {{-- ========================================================= --}}
                        <div class="row">
                            <div class="col-xl-12 col-lg-12">
                                <div class="card shadow mb-4">
                                    {{-- ========================================================= --}}
                                    {{-- CARD BODY --}}
                                    {{-- ========================================================= --}}
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            {{-- ========================================================= --}}
                                            {{-- TABLE --}}
                                            {{-- ========================================================= --}}
                                            <table class="table table-bordered" id="table_id" width="100%" cellspacing="0">
                                            {{-- ========================================================= --}}
                                            {{-- TABLE HEADER --}}
                                            {{-- ========================================================= --}}
                                                <thead>
                                                    <tr>
                                                        <?php if (isset($keyArray)) {
                                                            foreach ($keyArray as $key => $value) { ?>
                                                                <th scope="col">{{$value}}</th>
                                                        <?php  }
                                                        } ?>
                                                    </tr>
                                                </thead>
                                                {{-- ========================================================= --}}
                                                {{-- TABLE BODY --}}
                                                {{-- ========================================================= --}}
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
                                            {{-- ========================================================= --}}
                                            {{-- END TABLE --}}
                                            {{-- ========================================================= --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

{{-- ========================================================= --}}
{{-- TEST OUTPUT CHART--}}
{{-- ========================================================= --}}
{{-- <div class="container-fluid">

    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">

                <div class="card-body">
                    <div class="table-responsive">
                        <?php if (isset($result)) {
                            foreach ($result as $keyResult => $row) {
                                ?>
                                {{$row['status']}}
                                {{$row['message']}}
                        <?php
                            }
                        }
                        ?>
                        <i class="fas fa-fw fa-check-square"></i></br>
                        <i class="fas fa-fw fa-square"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}

                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; ITM, AIAP 2022</span>
                        </div>
                    </div>
                </footer>
            </div>
        </div>


{{-- =============================================================== --}}
{{-- SCROLL TO TOP BUTTON --}}
{{-- =============================================================== --}}
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>


{{-- =============================================================== --}}
{{-- LOGOUT MODAL --}}
{{-- =============================================================== --}}
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
{{-- INCLUDE FOOTER THEME --}}
{{-- =============================================================== --}}
        @include('theme.footer')
</body>
</html>
