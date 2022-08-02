<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\User;
use App\Models\UserPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Log;

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
            ->get(['user_permissions.*', 'permissions.name as permission_name']);

        return view('userpermissions.index', compact('userpermissions'));
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
            ->get(['id', 'name']);
        return view('userpermissions.create', compact('permissions'));
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

        try {
            UserPermission::create($request->all());
            return redirect()->route('User-Permission')
                ->with('success', 'User permission created successfully.');
        } catch (\Exception $e) {
            return redirect()->route('User-Permission')
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserPermission  $userPermission
     * @return \Illuminate\Http\Response
     */
    public function show(UserPermission $userPermission)
    {
        return view('userpermissions.show', compact('userPermission'));
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
            ->get(['id', 'name']);
        return view('userpermissions.edit', compact('userPermission', 'permissions'));
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

        try {
            $userPermission->update($request->all());
            return redirect()->route('User-Permission')
                ->with('success', 'User ermission updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('User-Permission')
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserPermission  $userPermission
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserPermission $userPermission)
    {

        try {
            $userPermission->delete();
            return redirect()->route('User-Permission')
                ->with('success', 'User permission deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('User-Permission')
                ->with('error', $e->getMessage());
        }
    }
    public function showauthorize(Request $request)
    {
        $permissions = Permission::where('active', '1')
            ->orderByRaw('LENGTH(sequence) ASC')
            ->orderBy('sequence', 'ASC')
            ->get(['permissions.*']);

        $users = User::orderBy('email', 'ASC')->get();
        $permissionName = $request->permissionName;
        return view('authorizations.index', compact('users', 'permissions','permissionName'));
    }
    public function updateauthorize(Request $request, UserPermission $userPermission)
    {
        $permissions = Permission::where('active', '1')
            ->orderByRaw('LENGTH(sequence) ASC')
            ->orderBy('sequence', 'ASC')
            ->get(['permissions.*']);

        $users = User::orderBy('email', 'ASC')->get();
        // Set to inactive
        $userpermission = UserPermission::query()->delete();

        foreach ($users as $user) {
            $fname = $user->first_name; // First Name
            $permissionarrays = $request->get($fname);

            if (!empty($permissionarrays)) {

                foreach ($permissionarrays as $permissid) {

                    UserPermission::insert([
                        'email' => $user->email,
                        'permission_id' => $permissid,
                        'active' => 1

                    ]);
                }
            }
        }

        return view('authorizations.index', compact('users', 'permissions'));
    }

    public function insertpermission(Request $request, UserPermission $userPermission)
    {
        // ======================================================================
        // SET DATA WRITE LOG
        // ======================================================================
        $permissionName = UserPermission::getPermissionName($request->id);
        $permissionId = UserPermission::getPermissionID($request->perName);
        // ======================================================================

        try {
            UserPermission::insert([
                'email' => $request->email,
                'permission_id' => $request->id,
                'active' => 1,
                'created_at' => date("Y-m-d H:i:s", strtotime('now')),
                'updated_at' => date("Y-m-d H:i:s", strtotime('now'))
            ]);
         
            Log::insertLog(Auth::user()->id, $permissionId, 'Add authorize ' . $permissionName .'to '.$request->id.' completed');
        } catch (\Exception $e) {
            Log::insertLog(Auth::user()->id, $permissionId, 'Add authorize ' . $permissionName . 'to '.$request->id.' failed');
        }
    }

    public function deletepermission(Request $request)
    {
        // ======================================================================
        // SET DATA WRITE LOG
        // ======================================================================
        $permissionName = UserPermission::getPermissionName($request->id);
        $permissionId = UserPermission::getPermissionID($request->perName);
        // ======================================================================
        try{
            UserPermission::where('permission_id', '=', $request->id)
            ->where('email', '=', $request->email)
            ->delete();
            Log::insertLog(Auth::user()->id, $permissionId, 'Delete authorize ' . $permissionName . 'from '.$request->id.' completed');

        }catch (\Exception $e) {
            Log::insertLog(Auth::user()->id, $permissionId, 'Delete authorize ' . $permissionName . 'from '.$request->id.' failed');

        }

    }

    // ====================================================================================================
    //   14/07/2022 Change to use AuthenticationAPIController    (Temp because table not keep view name)
    // ====================================================================================================
    // public function getAuthenticatePOInterfaceAPI(Request $request)
    // {
    //     if(\App\Models\User::getPermission($request->permissionName, Auth::user()->email))
    //         return view('interface-sap-po');
    //     else
    //         return abort(403);
    // }

}
