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

        // ================================================================
        // Check box event
        // ================================================================
        document.addEventListener('DOMContentLoaded', function() {
            var checkboxes = document.querySelectorAll('input[type=checkbox][name=permissionCHB]');

            for (var checkbox of checkboxes) {
                checkbox.addEventListener('change', function(event) {
                    if (event.target.checked) {
                        // alert(`${event.target.value} is checked`);
                        let text = event.target.value;
                        const myArray = text.split("|");
                        // let word = myArray[1];
                        $.ajax({
                            url: "{{ route('Authorization.insertpermission') }}",
                            data: {"id":myArray[0],"email":myArray[1],"perName":"Authorization"},
                            type: 'get',
                            success: function(result){
                                // location.reload();
                                location.replace(location.href.split('#')[0]);
                                // console.log(result)
                            }
                            });

                    } else {
                        // alert(`${event.target.value} is unchecked`);
                        let text = event.target.value;
                        const myArray = text.split("|");
                        // let word = myArray[1];
                        $.ajax({
                            url: "{{ route('Authorization.deletepermission') }}",
                            data: {"id":myArray[0],"email":myArray[1],"perName":"Authorization"},
                            type: 'get',
                            success: function(result){
                                // location.reload();
                                location.replace(location.href.split('#')[0]);
                                // console.log(result)
                            }
                            });

                    }
                });
            }
        }, false);
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
                {{-- =============================================================== --}}
                {{-- FORM  ACTION = VIEW --}}
                {{-- =============================================================== --}}
                {{-- <form method="POST" action="{{ route('Authorization.update') }}"> --}}
                    @csrf

                    <div class="container-fluid">
                        {{-- ========================================================= --}}
                        {{-- SUBJECT --}}
                        {{-- ========================================================= --}}
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h5 mb-0 text-gray-800">【 Authorization Matrix 】</h1>
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
                                <div class="card shadow mb-4" style="overflow-x: auto;">
                                    {{-- ========================================================= --}}
                                    {{-- TABLE --}}
                                    {{-- ========================================================= --}}
                                    <table>
                                        {{-- ========================================================= --}}
                                        {{-- TABLE HEADER --}}
                                        {{-- ========================================================= --}}
                                        <thead>
                                            <tr>
                                                <th class="text-center">Permission \ Name</th>
                                                @foreach ($users as $user)
                                                    <th class="text-center">{{ $user->first_name }}</th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        {{-- ========================================================= --}}
                                        {{-- TABLE BODY --}}
                                        {{-- ========================================================= --}}
                                        <tbody>
                                            <?php
                                            $showNavigationItemId = "";
                                            $previousNavigationItemId = "";
                                            $colnumber = 0;
                                            $i = 0;
                                            foreach ($users as $user) {
                                                $i++;
                                                $emails[$i] = $user->email;
                                                $names[$i] = $user->first_name;
                                            }
                                            ?>
                                            @foreach ($permissions as $permission)
                                                @php
                                                    $permissionname = $permission->name;
                                                    $permissionid = $permission->id;
                                                @endphp

                                                    <?php
                                                        $currentNavigationItemId = $permission->navigation_item_id;

                                                        if ($currentNavigationItemId == $previousNavigationItemId){
                                                            $showNavigationItemId = "";

                                                        }else {
                                                            $showNavigationItemId = $currentNavigationItemId;
                                                            $colnumber = count($users) + 1;
                                                            ?>
                                                            <tr>
                                                                <td colspan="{{ $colnumber }}">{{ \App\Models\UserPermission::getNavigationItemName($showNavigationItemId); }}</td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    ?>

                                                    <tr>
                                                    <td  style="position: sticky;">{{ $permissionname }}</td>
                                                    <?php
                                                    $j = 0;
                                                    ?>

                                                    @foreach ($emails as $email)
                                                        <td class="text-center">
                                                            <?php
                                                            $j++;
                                                            $status = \App\Models\UserPermission::getPermissionActive($email, $permissionid) ;
                                                            if($status == "1"){
                                                        ?>
                                                            {{-- <input name="{{ $names[$j] }}[]" type="checkbox"
                                                                value="{{ $permissionid }}" onclick="checkFluency()" checked /> --}}
                                                            <input name="permissionCHB" type="checkbox"
                                                                value="{{ $permissionid}}|{{ $email }}" checked />
                                                            <?php
                                                            }else{
                                                            ?>
                                                            {{-- <input name="{{ $names[$j] }}[]" type="checkbox"
                                                                value="{{ $permissionid }}" onclick="checkFluency()" /> --}}
                                                            <input name="permissionCHB" type="checkbox"
                                                                value="{{ $permissionid}}|{{ $email }}" />
                                                            <?php
                                                            }
                                                        ?>
                                                        </td>
                                                    @endforeach
                                                </tr>
                                                <?php
                                                     $previousNavigationItemId = $permission->navigation_item_id;
                                                ?>
                                            @endforeach


                                        </tbody>
                                    </table>
                                    {{-- ========================================================= --}}
                                    {{-- END TABLE --}}
                                    {{-- ========================================================= --}}


                                </div>
                            </div>
                            {{-- <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div> --}}
                        </div>
                    </div>
                {{-- </form> --}}
                <!-- /////////////////////////////////////////////////////////////////////////////////// -->
                <!-- Show permission -->
                <!-- /////////////////////////////////////////////////////////////////////////////////// -->
                {{-- <div class="containner">
                <h4>{{ __('Menu') }}</h4>
                <?php
                    if(!empty($userpermission)){
                    $navigationGroupMenus = $userpermission->getNavigationGroup("suchart_au@aisin-ap.com");
                ?>
                    @foreach ($navigationGroupMenus as $navigationGroupMenu)
                        <b>{{ __('Navigation Group: ') }} </b>
                        {{  $navigationGroupMenu->navigation_group_name }} <br>
                            @php
                            $navigationGroup = $navigationGroupMenu->navigation_group_name;
                            $navigationItemMenus = $userpermission->getNavigationItem($navigationGroup, "suchart_au@aisin-ap.com");
                            @endphp
                                @foreach ($navigationItemMenus as $navigationItemMenu)
                                <b>{{ __('Navigation Item: ') }}</b>
                                    {{ $navigationItemMenu->navigation_item_name }} <br>
                                    @php
                                    $navigationItem = $navigationItemMenu->navigation_item_name;
                                    $permissionMenus = $userpermission->getPermission($navigationItem, "suchart_au@aisin-ap.com");
                                    @endphp
                                        @foreach ($permissionMenus as $permissionMenu)
                                        <b>{{ __('Permission: ') }}</b>
                                            {{ $permissionMenu->permission_name }} <br>
                                        @endforeach
                                @endforeach
                    @endforeach
                <?php
                }
                ?>
            </div> --}}
                <!-- /////////////////////////////////////////////////////////////////////////////////// -->
                <!-- End Show permission -->
                <!-- /////////////////////////////////////////////////////////////////////////////////// -->

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
