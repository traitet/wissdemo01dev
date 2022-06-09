<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

{{-- ============================================================================================ --}}
{{-- HEAD --}}
{{-- ============================================================================================ --}}
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WISS 2022</title>
    @include('theme.header')

    <script>
        // ================================================================
        // CUSTOM DATATABLE
        // ================================================================
        $(document).ready(function() {
            $('#table_id').DataTable({
                dom:  '<lf<t>ip>'
            });
        });

        // ================================================================
        // DATE HANDLE
        // ================================================================
        function dateEndHandler() {
            const dateStart = $('#dateStart').val();
            console.log(dateStart);
            $('#dateEnd').val(dateStart);
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


{{-- ============================================================================================ --}}
{{-- HTML BODY --}}
{{-- ============================================================================================ --}}
<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        @include('theme.sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('theme.navbar')


{{-- =============================================================== --}}
{{-- FORM   --}}
{{-- =============================================================== --}}
<form method="POST" action="main" id="myForm">
    @csrf
    <div class="container-fluid">
        {{-- ========================================================= --}}
        {{-- BASIC SEARCH --}}
        {{-- ========================================================= --}}
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h5 mb-0 text-gray-800">【 Basic Report API Template 】</h1>
        </div>
        <div class="row">
            {{-- ========================================================= --}}
            {{-- BASIC SEARCH --}}
            {{-- ========================================================= --}}
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="form-group form-inline">
                                <label for="docNum">Doc Num: </label>
                                <input class="form-control" type="text" class="" id="docNum" name="docNum">&nbsp;&nbsp;
                                <label for="dateStart">Date Start: </label>
                                <input class="form-control" type="date" class="" id="dateStart" name="dateStart" onchange="dateEndHandler();">
                                &nbsp;&nbsp;
                                <label for="dateEnd">Date End: </label>
                                <input class="form-control" type="date" class="" id="dateEnd" name="dateEnd" onchange="dateEndHandler();">
                                &nbsp;&nbsp;
                            </div>
                            {{-- ========================================================= --}}
                            {{-- ADVANCED SEARCH --}}
                            {{-- ========================================================= --}}
                            <div class="form-group form-inline">
                                <label for="docNum">Created by: </label>
                                <input class="form-control" type="text" class="" id="docNum" name="docNum">&nbsp;&nbsp;
                                <label for="docNum">Updated by: </label>
                                <input class="form-control" type="text" class="" id="docNum" name="docNum">&nbsp;&nbsp;
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
    {{-- HEADER --}}
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
    {{-- BODY --}}
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

{{-- ========================================================= --}}
{{-- FOOTER--}}
{{-- ========================================================= --}}
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
