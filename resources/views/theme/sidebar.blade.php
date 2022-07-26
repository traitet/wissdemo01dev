       <!-- Sidebar -->
       <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

           <!-- Sidebar - Brand -->
           <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('index') }}">
               {{-- <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
               </div> --}}
               <div class="sidebar-brand-icon">
                    <img class="img-profile rounded-circle" src="{{ asset('theme/img/wisslogo.svg') }}">
               </div>

               <div class="sidebar-brand-text mx-3">WISS Dev<sup>3</sup></div>

           </a>


           <!-- Divider -->
           <hr class="sidebar-divider my-0">

           {{-- ========================================================================== --}}
           {{-- DASHBOARD --}}
           {{-- ========================================================================== --}}

           <!-- Nav Item - Dashboard -->
           <li class="nav-item active">
               <a class="nav-link" href="{{ route('index') }}">
                   <i class="fas fa-fw fa-tachometer-alt"></i>
                   <span>Dashboard</span></a>
           </li>


           {{-- /////////////////////////////////////////////////////////////////////////////////////////////////// --}}
           {{-- /////////////////////////////          Start Render Menu         ////////////////////////////////// --}}
           {{-- /////////////////////////////////////////////////////////////////////////////////////////////////// --}}
           {{-- =================================== Chang to render menu 05/07/2022 ================================ --}}
           <?php
                if (!empty(Auth::user()->name)) {
                $navigationGroupMenus = \App\Models\UserPermission::getNavigationGroup(Auth::user()->email);
                $i = 0;
            ?>
           @foreach ($navigationGroupMenus as $navigationGroupMenu)
               <!-- Divider -->
               <hr class="sidebar-divider">
               <!-- Heading -->
               <div class="sidebar-heading">
                   <?php
                   $navigationGroupId = $navigationGroupMenu->id;
                   $navigationGroupName = \App\Models\UserPermission::getNavigationGroupName($navigationGroupId);
                   ?>
                   {{ $navigationGroupName }}
               </div>
               @php
                   $navigationItemMenus = \App\Models\UserPermission::getNavigationItem($navigationGroupId, Auth::user()->email);
               @endphp
               @foreach ($navigationItemMenus as $navigationItemMenu)
                   <!-- Nav Item - Pages Collapse Menu -->
                   <?php ++$i; ?>
                   <li class="nav-item">
                       <a class="nav-link collapsed" href="#" data-toggle="collapse"
                           data-target="#collapseTwo{{ $i }}" aria-expanded="true"
                           aria-controls="collapseTwo{{ $i }}">
                           {{-- <i class="fas fa-fw fa-coins"></i> --}}
                           <?php
                           $navigationItemId = $navigationItemMenu->id;
                           $navigationItemName = \App\Models\UserPermission::getNavigationItemName($navigationItemId);
                           ?>
                           <span>{{ $navigationItemName }}</span>
                       </a>
                       <div id="collapseTwo{{ $i }}" class="collapse"
                           aria-labelledby="headingTwo{{ $i }}" data-parent="#accordionSidebar">
                           <div class="bg-white py-2 collapse-inner rounded">
                               <?php
                                            $permissionMenus = \App\Models\UserPermission::getPermission($navigationItemId, Auth::user()->email);

                                                    foreach ($permissionMenus as $permissionMenu){
                                                    $permissionId =  $permissionMenu->id;
                                                    $permissionName = \App\Models\UserPermission::getPermissionName($permissionId);
                                                    $routename = $permissionName;
                                                    if ($navigationGroupName == 'Infrastructure Monitor'){
                                                    ?>
                                <a class="collapse-item" target="_blank" href="{{ route($routename, $routename) }}">{{ $routename }}</a>
                                                    <?php
                                                    }
                                                    else{
                                                ?>
                               <a class="collapse-item" href="{{ route( $routename, $routename) }}">{{ $routename }}</a>
                               <?php
                                                    }
                                                }
                                                ?>

                           </div>
                       </div>
                   </li>
               @endforeach
           @endforeach


           <?php
                }

            ?>


           {{-- ////////////////////////////////////////////////////////////////////////////////////////////////// --}}
           {{-- ////////////////////////////           End Render Menu          ////////////////////////////////// --}}
           {{-- ////////////////////////////////////////////////////////////////////////////////////////////////// --}}

           {{-- ========================================================================== --}}
           {{-- TOGGER --}}
           {{-- ========================================================================== --}}
           <!-- Sidebar Toggler (Sidebar) -->
           <div class="text-center d-none d-md-inline">
               <button class="rounded-circle border-0" id="sidebarToggle"></button>
           </div>

           {{-- <!-- Sidebar Message -->
           <div class="sidebar-card d-none d-lg-flex">
               <img class="sidebar-card-illustration mb-2" src="theme/img/undraw_rocket.svg" alt="...">
               <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
               <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
           </div> --}}

       </ul>
       <!-- End of Sidebar -->

       <!-- Divider -->
       <hr class="sidebar-divider">

       {{-- <a class="collapse-item" target="_blank" href="{{ route('Atgn') }}">test menu external</a> --}}

