<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;

class ProfileController extends Controller
{

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('profile.edit',['profile' => auth()->user()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = auth()->user();
        $this->validate($request,[
            'location' => 'required|max:255',
            'employee_id' => 'required|max:10',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$user->id,
            'section' => 'max:255',
            'department' => 'max:255',
            'division' => 'max:255',
        ]);

        $input = $request->only('locatioin',
        'employee_id',
        'first_name',
        'last_name',
        'email',
        'section',
        'department',
        'division');

        // $user->update($input);
        $user->update([
            'locatioin' => strtoupper($request->location),
            'employee_id' => strtoupper($request->employee_id),
            'first_name' => strtoupper($request->first_name),
            'last_name' => strtoupper($request->last_name),
            'email' => $request->email,
            'section' => strtoupper($request->section),
            'department' => strtoupper($request->department),
            'division' => strtoupper($request->division)

        ]);

        // return back();
        return redirect(RouteServiceProvider::HOME);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
