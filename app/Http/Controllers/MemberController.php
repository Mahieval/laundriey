<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $members = \App\Member::paginate(10);

        $filterKeyword = $request->get('name');
 
        if($filterKeyword){
 
            $members = \App\Member::where("name", "LIKE", "%$filterKeyword%")->paginate(10);
        }
        return view('members.index', ['members' => $members]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('members.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $member = new \App\Member; 

        $member->nama = $request->get('nama');
        $member->alamat = $request->get('alamat');
        $member->jenis_kelamin = $request->get('jenis_kelamin');
        $member->no_telp = $request->get('no_telp');
        
        $member->save();
        return redirect()->route('members.index')->with('status', 'Member successfully created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $members  = \App\Member::findOrFail($id);
 
        return view('members.index', ['members' => $members]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $members = \App\Member::findOrFail($id);

        $members->nama = $request->get('nama');
        $members->alamat = $request->get('alamat');
        $members->jenis_kelamin = $request->get('jenis_kelamin');
        $members->no_telp = $request->get('no_telp');
        $members->save();

        return redirect()->route('members.index')->with('status', 'Outlet successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $members = \App\Member::findOrFail($id);
        $members->delete();

        return redirect()->route('members.index')->with('status', 'member successfully move to trash');

    }
       
    public function deletePermanent($id)
       {
        $members = \App\Member::withTrashed()->findOrFail($id);
        if(!$member->trashed()){
        return redirect()->route('members.trash')->with('status', 'member is not in trash!')->with('status_type', 'alert');
        } else {
        $members->outlets()->detach();
        $memberpaket->forceDelete();
        return redirect()->route('members.index')->with('status', 'member permanently deleted!');
        }
      }
}
