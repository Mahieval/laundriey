<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pakets = \App\Paket::paginate(10);

        $filterKeyword = $request->get('name');
 
        if($filterKeyword){
 
            $pakets = \App\Paket::where("name", "LIKE", "%$filterKeyword%")->paginate(10);
        }

        return view('pakets.index', ['pakets' => $pakets]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pakets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_paket = new \App\Paket;
        $new_paket->nama_paket = $request->get('nama_paket');
        $new_paket->jenis = $request->get('jenis');
        $new_paket->harga = $request->get('harga');
        $new_paket->outlet_id = $request->get('outlets');
        $new_paket->outlets()->attach($request->get('outlets'));
        
        $new_paket->save();
        return redirect()->route('pakets.index')->with('status', 'Paket successfully created');
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
        $paket_to_edit = \App\Paket::findOrFail($id);

        return view('pakets.edit', ['pakets' => $paket_to_edit]);
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
        $paket1 = \App\Paket::findOrFail($id);
        
        $paket1->nama_paket = $request->get('nama_paket');
        $paket1->jenis = $request->get('jenis');
        $paket1->harga = $request->get('harga');
        $paket1->save(); 
        $paket1->outlets()->sync($request->get('outlets'));

        return redirect()->route('pakets.index')->with('status', 'Paket successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pakets = \App\Paket::findOrFail($id);
        $pakets->delete();

        return redirect()->route('pakets.index')->with('status', 'paket successfully move to trash');

    }

    public function trash()
       {
        $pakets = \App\Paket::onlyTrashed()->paginate(10);
        return view('pakets.trash', ['pakets' => $pakets]);
       }
       

    public function restore($id)
       {
        $paket = \App\Paket::withTrashed()->findOrFail($id);
        if($paket->trashed()){
        $paket->restore();
        return redirect()->route('pakets.index')->with('status', 'paket successfully restored');
        } else {
        return redirect()->route('pakets.trash')->with('status', 'paket is not in trash');
        }
        }
       
    public function deletePermanent($id)
       {
        $paket = \App\Paket::withTrashed()->findOrFail($id);
        if(!$paket->trashed()){
        return redirect()->route('pakets.trash')->with('status', 'paket is not in trash!')->with('status_type', 'alert');
        } else {
        $paket->outlets()->detach();
        $paket->forceDelete();
        return redirect()->route('pakets.index')->with('status', 'paket permanently deleted!');
        }
      }
}
