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
                <form method="POST" action="{{ route('EmfgUpdateShelfsATAC.update', $permissionName) }}" id="myForm">
                    @csrf
                    <div class="container-fluid">
                        {{-- ========================================================= --}}
                        {{-- SUBJECT --}}
                        {{-- ========================================================= --}}
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h5 mb-0 text-gray-800">【 E-MFG UPDATE SHELFS 】</h1>
                        </div>

                        {{-- ========================================================= --}}
                        {{-- SERCH PARAMTER --}}
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
                                                        <?php
                                                        if (isset($keyArray)) {
                                                            foreach ($keyArray as $key => $value) { ?>
                                                                <th scope="col">{{$value}}</th>
                                                        <?php  }
                                                        }elseif(isset($keyArrayRes)) {
                                                            foreach ($keyArrayRes as $key => $value) { ?>
                                                                <th scope="col">{{$value}}</th>
                                                        <?php }
                                                        }?>
                                                    </tr>
                                                </thead>
                                                {{-- ========================================================= --}}
                                                {{-- TABLE BODY --}}
                                                {{-- ========================================================= --}}
                                                <tbody>
                                                    <?php if (isset($result)) {
                                                        foreach ($result as $keyResult => $row) { ?>
                                                            <tr>
                                                                <?php
                                                                foreach ($row as $keyRow => $data) {
                                                                ?>
                                                                    <td>
                                                                        <?php
                                                                        if($keyRow == 'SHELFCODE' or $keyRow == 'SHELFNAME' or $keyRow == 'SLOCCODE' or $keyRow == 'DESCRIPTION' or $keyRow == 'COMPCODE' or $keyRow == 'PLANTCODE' or $keyRow == 'EDITBY' or $keyRow == 'EDITDATE' or $keyRow == 'EDITTIME'){
                                                                        ?>
                                                                            <input type="hidden" id="textbox" name="{{$keyRow}}[]" value="{{$data}}">
                                                                            {{$data}}
                                                                        <?php
                                                                        }else{
                                                                        ?>
                                                                            <input type="textbox" id="textbox" name="{{$keyRow}}[]" value="{{$data}}">
                                                                        <?php
                                                                        }
                                                                        ?>

                                                                    </td>
                                                                    <?php
                                                                } ?>
                                                            </tr>

                                                    <?php }
                                                    }else if (isset($resultRes)) {
                                                        foreach ($resultRes as $keyResult => $row) { ?>

                                                            <tr>
                                                                <?php
                                                                foreach ($row as $keyRow => $data) { ?>
                                                                    <td>{{$data}}</td>
                                                                <?php
                                                                } ?>
                                                            </tr>

                                                    <?php }
                                                    }
                                                      ?>
                                                </tbody>
                                            </table>
                                            {{-- ========================================================= --}}
                                            {{-- END TABLE --}}
                                            {{-- ========================================================= --}}
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            @if(isset($result))
                                            <button type="submit" class="btn btn-primary">Update</button>
                                            @endif
                                            <a class="btn btn-primary" href="{{ route('Update-Shelfs-ATAC','Update-Shelfs-ATAC') }}">Back to UPDATE SHELFS</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Error no data message --}}
                        @if (isset($error))
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                    <li>{{ $error }}</li>
                            </ul>
                        </div>
                        @endif
                        {{-- End no data message --}}
                    </div>

                </form>

{{-- ========================================================= --}}
{{-- SEARCH OUTPUT --}}
{{-- ========================================================= --}}

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