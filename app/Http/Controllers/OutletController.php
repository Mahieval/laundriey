<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OutletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $outlets = \App\Outlet::paginate(10);

        $filterKeyword = $request->get('name');
 
        if($filterKeyword){
 
            $outlets = \App\Outlet::where("name", "LIKE", "%$filterKeyword%")->paginate(10);
        }

        return view('outlets.index', ['outlets' => $outlets]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('outlets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_outlet = new \App\Outlet;
        $new_outlet->nama = $request->get('nama');
        $new_outlet->alamat = $request->get('alamat');
        $new_outlet->tlp = $request->get('tlp');
        $new_outlet->save();
           
        return redirect()->route('outlets.index')->with('status', 'Outlet successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $outlets = \App\Outlet::findOrFail($id);
 
        return view('outlets.show', ['outlets' => $outlets]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $outlets = \App\Outlet::findOrFail($id);
        return view('outlets.edit', ['outlets' => $outlets]);
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
        $outlets = \App\Outlet::findOrFail($id);

        $outlets->nama = $request->get('nama');
        $outlets->alamat = $request->get('alamat');
        $outlets->tlp = $request->get('tlp');
        $outlets->save();
           
        return redirect()->route('outlets.index')->with('status', 'Outlet successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $outlets = \App\Outlet::findOrFail($id);
        $outlets->delete();

        return redirect()->route('outlets.index')->with('status', 'outlet successfully ');

    }
       
    public function deletePermanent($id)
       {
        $outlets = \App\Oulet::withTrashed()->findOrFail($id);
        if(!$outlets->trashed()){
        return redirect()->route('outlets.trash')->with('status', 'paket is not in trash!')->with('status_type', 'alert');
        } else {
        $outlets->outlets()->detach();
        $outlets->forceDelete();
        return redirect()->route('outlets.index')->with('status', 'paket permanently deleted!');
        }
      }
}
