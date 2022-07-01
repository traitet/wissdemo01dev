@extends('userpermissions.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Laravel 8 User Permissions</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('userpermissions.create') }}"> User Permission</a>
                <a class="btn btn-success" href="{{ route('index') }}"> Index</a>
            </div>
        </div>
    </div>

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

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Email</th>
            <th>Permission Name</th>
            <th>Active</th>
            <th width="280px">Action</th>
        </tr><?php $i = 0; ?>
        @foreach ($userpermissions as $userpermission)
        <tr>
            <td>{{ $userpermission->id }}</td>
            <td>{{ $userpermission->email }}</td>
            <td>{{ $userpermission->permission_name }}</td>
            <td>{{ $userpermission->active() }}</td>
            <td>
                <form action="{{ route('userpermissions.destroy',$userpermission->id) }}" method="POST">

                    <a class="btn btn-info" href="{{ route('userpermissions.show',$userpermission->id) }}">Show</a>

                    <a class="btn btn-primary" href="{{ route('userpermissions.edit',$userpermission->id) }}">Edit</a>

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    <div class="pull-right">
        <a class="btn btn-success" href="{{ route('userpermissions.showauthorize') }}">Permission Table</a>
    </div>


    {{-- Get Permission, Navigation Item, Navigation Group --}}
    <h3>{{ __('Menu') }}</h3>
    <?php
        if(!empty($userpermission)){
        $navigationGroupMenus = $userpermission->getNavigationGroup("satit_po@aisin-ap.com");
    ?>
        @foreach ($navigationGroupMenus as $navigationGroupMenu)
            {{ __('Navigation Group') }}
            {{  $navigationGroupMenu->navigation_group_name }} <br>
                @php
                $navigationGroup = $navigationGroupMenu->navigation_group_name;
                $navigationItemMenus = $userpermission->getNavigationItem($navigationGroup, "satit_po@aisin-ap.com");
                @endphp
                    @foreach ($navigationItemMenus as $navigationItemMenu)
                        {{ __('Navigation Item') }}
                        {{ $navigationItemMenu->navigation_item_name }} <br>
                        @php
                        $navigationItem = $navigationItemMenu->navigation_item_name;
                        $permissionMenus = $userpermission->getPermission($navigationItem, "satit_po@aisin-ap.com");
                        @endphp
                            @foreach ($permissionMenus as $permissionMenu)
                                {{ __('Permission') }}
                                {{ $permissionMenu->permission_name }} <br>
                            @endforeach
                    @endforeach
        @endforeach
    <?php
    }
    ?>

    {{-- <h3>{{ __('Navigation Group') }}</h3>
    <?php
        if(!empty($userpermission)){
        $permiss = $userpermission->getNavigationGroup("satit_po@aisin-ap.com");
    ?>
    @foreach ($permiss as $permis)
        {{ $permis->navigation_group_name }} <br>
    @endforeach
    <?php
    }
    ?> --}}

    {{--<h3>{{ __('Navigation Item') }}</h3>
    <?php
        if(!empty($userpermission)){
        $permiss = $userpermission->getNavigationItem("suchart_au@aisin-ap.com");
    ?>
    @foreach ($permiss as $permis)
        {{ $permis->navigation_item_name }} <br>
    @endforeach
    <?php
    }
    ?>

    <h3>{{ __('Permission') }}</h3>
    <?php
        if(!empty($userpermission)){
        $permiss = $userpermission->getPermission("suchart_au@aisin-ap.com");
    ?>
    @foreach ($permiss as $permis)
        {{ $permis->permission_name }} <br>
    @endforeach
    <?php
    }
    ?> --}}

@endsection
