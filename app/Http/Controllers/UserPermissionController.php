<?php

namespace App\Http\Controllers;

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
        //$permissions = UserPermission::all();
        $permissions = UserPermission::where('active_status', 'Y')
        ->orderBy('email')
        ->take(10)
        ->get();

        foreach ($permissions as $key) {
            error_log($key->email);
        }

        return view('profile.userpermission',compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('profile.adduserpermission');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->email,$request->permission_form,$request->active_status);
        $request->validate([
            'email'=> 'required|unique:user_permissions|max:255',
            'permission_form' => 'required|max:255',
            'active_status' => 'required|max:1',
        ]);

        $UserPermission = new UserPermission;
        $UserPermission->email = $request->email;
        $UserPermission->permission_id = $request->permission_form;
        $UserPermission->active_status = $request->active_status;

        $UserPermission->save();
        return redirect()->back()->with('Success',"Save completed!");

        // $user = UserPermission::create([
        //     'email' => $request->email,
        //     'permission_id' => $request->permission_form,
        //     'active_status' => $request->active_status,
        // ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserPermission  $userPermission
     * @return \Illuminate\Http\Response
     */
    public function show(UserPermission $userPermission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserPermission  $userPermission
     * @return \Illuminate\Http\Response
     */
    public function edit(UserPermission $userPermission)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserPermission  $userPermission
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserPermission $userPermission)
    {
        //
    }
}
