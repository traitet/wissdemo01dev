<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\UserPermission;
use Illuminate\Http\Request;

class UserPermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userpermissions = UserPermission::join('permissions', 'user_permissions.permission_id', '=', 'permissions.id')
        ->orderBy('user_permissions.email', 'asc')
        ->get(['user_permissions.*','permissions.name as permission_name']);

        return view('userpermissions.index',compact('userpermissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::where('active', '1')
        ->orderBy('name')
        ->get(['id','name']);
        return view('userpermissions.create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'permission_id' => 'required',
            'active' => 'required',
        ]);

        UserPermission::create($request->all());

        return redirect()->route('userpermissions.index')
                        ->with('success','User permission created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserPermission  $userPermission
     * @return \Illuminate\Http\Response
     */
    public function show(UserPermission $userPermission)
    {
        return view('userpermissions.show',compact('userPermission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserPermission  $userPermission
     * @return \Illuminate\Http\Response
     */
    public function edit(UserPermission $userPermission)
    {
        // return view('userpermissions.edit',compact('userPermission'));
        $permissions = Permission::where('active', '1')
        ->orderBy('name')
        ->get(['id','name']);
        return view('userpermissions.edit',compact('userPermission','permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserPermission  $userPermission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserPermission $userPermission)
    {
        $request->validate([
            'email' => 'required',
            'permission_id' => 'required',
            'active' => 'required',
        ]);

        $userPermission->update($request->all());

        return redirect()->route('userpermissions.index')
                        ->with('success','User ermission updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserPermission  $userPermission
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserPermission $userPermission)
    {
        $userPermission->delete();

        return redirect()->route('userpermissions.index')
                        ->with('success','User permission deleted successfully');
    }

    public function showauthorize()
    {
        $permissiontables = UserPermission::join('permissions', 'user_permissions.permission_id', '=', 'permissions.id')
        ->join('navigation_items', 'permissions.navigation_item_id', '=', 'navigation_items.id')
        ->join('navigation_groups', 'navigation_items.navigation_group_id', '=', 'navigation_groups.id')
        ->orderBy('user_permissions.email', 'asc')
        ->get(['user_permissions.*','permissions.name as permission_name', 'navigation_items.name as navigation_item_name', 'navigation_groups.name as navigation_group_name']);

        return view('userpermissions.showauthorize',compact('permissiontables'));
    }

}
