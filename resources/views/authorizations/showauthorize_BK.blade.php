@extends('authorizations.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Permission Table</h2>
            </div>
            <div class="pull-right">
                {{-- <a class="btn btn-primary" href="{{ route('userpermissions.index') }}"> Back</a> --}}
            </div>
        </div>
    </div>

    <div class="row">

        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Email</th>
                <th>Permission</th>
                <th>Permission Item</th>
                <th>Permission Group</th>
                <th>Active</th>
            </tr><?php $i = 0; ?>
            @foreach ($permissiontables as $userpermission)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $userpermission->email }}</td>
                <td>{{ $userpermission->permission_name }}</td>
                <td>{{ $userpermission->navigation_item_name }}</td>
                <td>{{ $userpermission->navigation_group_name }}</td>
                <td>{{ $userpermission->active() }}</td>
            </tr>
            @endforeach
        </table>

    </div>

      {{-- Get Permission, Navigation Item, Navigation Group --}}
    <h4>{{ __('Menu') }}</h4>
    <?php
          if(!empty($userpermission)){
          $navigationGroupMenus = $userpermission->getNavigationGroup("suchart_au@aisin-ap.com");
    ?>
          @foreach ($navigationGroupMenus as $navigationGroupMenu)
              <b>{{ __('Navigation Group') }} </b>
              {{  $navigationGroupMenu->navigation_group_name }} <br>
                  @php
                  $navigationGroup = $navigationGroupMenu->navigation_group_name;
                  $navigationItemMenus = $userpermission->getNavigationItem($navigationGroup, "suchart_au@aisin-ap.com");
                  @endphp
                      @foreach ($navigationItemMenus as $navigationItemMenu)
                      <b>{{ __('Navigation Item') }}</b>
                          {{ $navigationItemMenu->navigation_item_name }} <br>
                          @php
                          $navigationItem = $navigationItemMenu->navigation_item_name;
                          $permissionMenus = $userpermission->getPermission($navigationItem, "suchart_au@aisin-ap.com");
                          @endphp
                              @foreach ($permissionMenus as $permissionMenu)
                              <b>{{ __('Permission') }}</b>
                                  {{ $permissionMenu->permission_name }} <br>
                              @endforeach
                      @endforeach
          @endforeach
    <?php
      }
    ?>
@endsection
