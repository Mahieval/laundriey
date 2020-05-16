<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = \App\User::paginate(10);

        $filterKeyword = $request->get('name');
 
        if($filterKeyword){
 
            $users = \App\User::where("name", "LIKE", "%$filterKeyword%")->paginate(10);
        }

        return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("users.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_user = new \App\User; 

        $new_user->name = $request->get('name');
        $new_user->username = $request->get('username');
        $arrayTostring = implode(',', $request->input('roles'));
        $new_user['roles'] = $arrayTostring;
        $new_user->address = $request->get('address');
        $new_user->phone = $request->get('phone');
        $new_user->email = $request->get('email');
        $new_user->password = \Hash::make($request->get('password'));

        if($request->file('avatar')){
            $file = $request->file('avatar')->store('avatars', 'public');
            $new_user->avatar = $file;
            }
            $new_user->save();
            $new_user->outlets()->attach($request->get('outlets'));
            return redirect()->route('users.index')->with('status', 'User successfully created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users = \App\User::findOrFail($id);
 
        return view('users.show', ['users' => $users]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = \App\User::findOrFail($id);
 
        return view('users.index', ['users' => $users]);
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
        $user = \App\User::findOrFail($id);

        $user->name = $request->get('name');
        $user->username = $request->get('username');
        $arrayTostring = implode(',', $request->input('roles'));
        $user['roles'] = $arrayTostring;
        $user->address = $request->get('address');
        $user->phone = $request->get('phone');
        $user->email = $request->get('email');
        
        if($user->avatar && file_exists(storage_path('app/public/' . $user->avatar))){
        \Storage::delete('public/'.$user->avatar);
        $file = $request->file('avatar')->store('avatars', 'public');
        $user->avatar = $file;
        }

        $user->save();
        $user->outlets()->sync($request->get('outlets'));
        return redirect()->route('users.edit', [$id])->with('status', 'User succesfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = \App\User::findOrFail($id);
 
        $user->delete();
 
        return redirect()->route('users.index')->with('status', 'success delete');
    }

    public function ajaxSearch(Request $request){
        
        $keyword = $request->get('q');
       
        $users = \App\User::where("name", "LIKE", "%$keyword%")->get();
        
        return $users;
       }
       
}
