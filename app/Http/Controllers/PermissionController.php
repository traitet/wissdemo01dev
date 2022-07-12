<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\NavigationItem;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::join('navigation_items', 'permissions.navigation_item_id', '=', 'navigation_items.id')
        ->get(['permissions.*','navigation_items.name as navigation_name']);

        return view('permissions.index',compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $navigationItems = NavigationItem::where('active', '1')
        ->orderBy('name')
        ->get(['id','name']);
        return view('permissions.create',compact('navigationItems'));
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
            'navigation_item_id' => 'required',
            'name' => 'required',
            'sequence' => 'required',
            'active' => 'required',
        ]);

        try {
            Permission::create($request->all());
        return redirect()->route('Permission')
                        ->with('success','Permission group created successfully.');
        } catch (\Exception $e) {
              return redirect()->route('Permission')
                        ->with('error',$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        return view('permissions.show',compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        // return view('permissions.edit',compact('permission'));

        $navigationItems = NavigationItem::where('active', '1')
        ->orderBy('name')
        ->get(['id','name']);
        return view('permissions.edit',compact('permission','navigationItems'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'navigation_item_id' => 'required',
            'name' => 'required',
            'sequence' => 'required',
            'active' => 'required',
        ]);

        try {
            $permission->update($request->all());
            return redirect()->route('Permission')
                        ->with('success','Permission updated successfully');
        } catch (\Exception $e) {
              return redirect()->route('Permission')
                        ->with('error',$e->getMessage());
        }



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        try {
            $permission->delete();
        return redirect()->route('Permission')
                        ->with('success','Permission deleted successfully');
        } catch (\Exception $e) {
              return redirect()->route('Permission')
                        ->with('error',$e->getMessage());
        }

    }

}
