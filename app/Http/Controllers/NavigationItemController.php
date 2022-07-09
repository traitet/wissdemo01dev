<?php

namespace App\Http\Controllers;

use App\Models\NavigationItem;
use App\Models\NavigationGroup;
use Illuminate\Http\Request;

class NavigationItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $navigationItems = NavigationItem::join('navigation_groups', 'navigation_items.navigation_group_id', '=', 'navigation_groups.id')
                                            ->get(['navigation_items.*','navigation_groups.name as navigation_group_name']);

        // foreach ($navigationItems as $navigationItem){

        //     dd($navigationItem->id);
        // }

        return view('navigationitems.index',compact('navigationItems'));

        // NavigationItem = User model , navigation_items

        // $navigationItems = NavigationItem::latest()->paginate(5);

        // return view('navigationitems.index',compact('navigationItems'))
            // ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $navigationGroups = NavigationGroup::where('active', '1')
        ->orderBy('name')
        ->get(['id','name']);
        return view('navigationitems.create',compact('navigationGroups'));
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
            'navigation_group_id' => 'required',
            'name' => 'required',
            'sequence' => 'required',
            'active' => 'required',
        ]);

        try {
            NavigationItem::create($request->all());
            return redirect()->route('Navigation-Item')
                        ->with('success','Navigatioin group created successfully.');
        } catch (\Exception $e) {
              return redirect()->route('Navigation-Item')
                        ->with('error',$e->getMessage());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NavigationItem  $navigationItem
     * @return \Illuminate\Http\Response
     */
    public function show(NavigationItem $navigationItem)
    {
        return view('navigationitems.show',compact('navigationItem'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NavigationItem  $navigationItem
     * @return \Illuminate\Http\Response
     */
    public function edit(NavigationItem $navigationItem)
    {
        // return view('navigationitems.edit',compact('navigationItem'));

        $navigationGroups = NavigationGroup::where('active', '1')
        ->orderBy('name')
        ->get(['id','name']);
        return view('navigationitems.edit',compact('navigationItem','navigationGroups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NavigationItem  $navigationItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NavigationItem $navigationItem)
    {
        $request->validate([
            'navigation_group_id' => 'required',
            'name' => 'required',
            'sequence' => 'required',
            'active' => 'required',
        ]);

        try {
            $navigationItem->update($request->all());
            return redirect()->route('Navigation-Item')
                        ->with('success','Navigatioin item update successfully.');
        } catch (\Exception $e) {
              return redirect()->route('Navigation-Item')
                        ->with('error',$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NavigationItem  $navigationItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(NavigationItem $navigationItem)
    {
        try {
            $navigationItem->delete();
            return redirect()->route('Navigation-Item')
                        ->with('success','Navigatioin item delete successfully.');
        } catch (\Exception $e) {
              return redirect()->route('Navigation-Item')
                        ->with('error',$e->getMessage());
        }
    }


}
