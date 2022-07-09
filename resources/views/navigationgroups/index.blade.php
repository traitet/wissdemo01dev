<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

{{-- ============================================================================================================================== --}}
{{-- HTML HEAD --}}
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
                dom: '<lf<t>ip>'
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
{{-- HTML BODY --}}
{{-- ============================================================================================================================== --}}

<body id="page-top">
    <div id="wrapper">
        @include('theme.sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('theme.navbar')

                @csrf

                <div class="container-fluid">
                    {{-- ========================================================= --}}
                    {{-- SUBJECT --}}
                    {{-- ========================================================= --}}
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h5 mb-0 text-gray-800">【 Navigation Group 】</h1>
                    </div>
                    {{-- ========================================================= --}}
                    {{-- Alert  message --}}
                    {{-- ========================================================= --}}
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
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
                                    <div class="text-right mb-4">
                                        <a class="btn btn-success" href="{{ route('navigationgroups.create') }}"> +
                                            New Group</a>
                                    </div>
                                    <div class="table-responsive">
                                        {{-- ========================================================= --}}
                                        {{-- TABLE --}}
                                        {{-- ========================================================= --}}
                                        <table class="table table-bordered" id="table_id" width="100%"
                                            cellspacing="0">
                                            {{-- ========================================================= --}}
                                            {{-- TABLE HEADER --}}
                                            {{-- ========================================================= --}}
                                            <thead>
                                                <tr>
                                                    <th class="text-center">No</th>
                                                    <th class="text-center">Name</th>
                                                    <th class="text-center">Sequence</th>
                                                    <th class="text-center">Active</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            {{-- ========================================================= --}}
                                            {{-- TABLE BODY --}}
                                            {{-- ========================================================= --}}
                                            <tbody>
                                                @foreach ($navigationGroups as $navigationGroup)
                                                    <tr>
                                                        <td>{{ $navigationGroup->id }}</td>
                                                        <td>{{ $navigationGroup->name }}</td>
                                                        <td>{{ $navigationGroup->sequence }}</td>
                                                        <td>{{ $navigationGroup->active() }}</td>
                                                        <td class="text-right">
                                                            <form
                                                                action="{{ route('navigationgroups.destroy', $navigationGroup->id) }}"
                                                                method="POST">
                                                                {{-- <a class="btn btn-primary" href="{{ route('navigationgroups.edit',$navigationGroup->id) }}">Edit</a> --}}
                                                                <a class="btn btn-danger btn-sm"
                                                                    href="{{ route('navigationgroups.edit', $navigationGroup->id) }}"><i
                                                                        class="fa fa-edit"></i></a>
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-secondary btn-sm"><i
                                                                        class="fa fa-trash"></i></button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
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

        {{-- =============================================================== --}}
        {{-- INCLUDE FOOTER THEME --}}
        {{-- =============================================================== --}}
        @include('theme.footer')
</body>

</html>
