<?php

namespace App\Http\Controllers;

use App\Models\NavigationGroup;
use Illuminate\Http\Request;

class NavigationGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $navigationGroups = NavigationGroup::all();

        return view('navigationgroups.index',compact('navigationGroups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('navigationgroups.create');
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
            'name' => 'required',
            'sequence' => 'required',
            'active' => 'required',
        ]);

        try {
            NavigationGroup::create($request->all());
            // return redirect()->route('navigationgroups.index')
            return redirect()->route('Navigation-Group')
                        ->with('success','Navigation group created successfully.');
        } catch (\Exception $e) {
            // return redirect()->route('navigationgroups.index')
            return redirect()->route('Navigation-Group')
                        ->with('error',$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NavigationGroup  $navigationGroup
     * @return \Illuminate\Http\Response
     */
    public function show(NavigationGroup $navigationGroup)
    {
        // $data = NavigationGroup::query()->get();
        // dd($data);
        // dd($navigationGroup);
        return view('navigationgroups.show',compact('navigationGroup'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NavigationGroup  $navigationGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(NavigationGroup $navigationGroup)
    {
        return view('navigationgroups.edit',compact('navigationGroup'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NavigationGroup  $navigationGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NavigationGroup $navigationGroup)
    {
        $request->validate([
            'name' => 'required',
            'sequence' => 'required',
            'active' => 'required',
        ]);

        try {
            $navigationGroup->update($request->all());
            return redirect()->route('Navigation-Group')
                        ->with('success','Product updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('Navigation-Group')
                        ->with('error',$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NavigationGroup  $navigationGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(NavigationGroup $navigationGroup)
    {
        try {
            $navigationGroup->delete();
            return redirect()->route('Navigation-Group')
                        ->with('success','Navigation group deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('Navigation-Group')
                        ->with('error',$e->getMessage());
        }
    }

    // public function action(Request $request){
    //     if($request->id){
    //         $data = NavigationGroup::query()->whereId($request->id)->first();
    //     }else{
    //         $data = new NavigationGroup();
    //     }
    //     $data->action($request->all());
    //     return 'ok';
    // }
}
