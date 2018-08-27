<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Communication;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.user_list')->with(['user'=>User::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.add_user');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,['name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:users']);
        $save_user = new User($request->all());
        $characters = '123456789ABCDEFGHKMNP%&*$#%@';
        $charactersLength = strlen($characters);
        $randomString = '';
            for ($i = 0; $i < 5; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }     
        $save_user->password = bcrypt($randomString);
        $save_user->remember_token=str_random(32);
        $save_user->save();

        $role=\DB::table('roles')->where('name','store')->select('id')->first();
        \DB::table('role_user')->insert([['user_id' => $save_user->id, 'role_id' => $role->id],]);
        $sms = "Hello ".$save_user->name." Your SulaShop Account has been created, your initial password is ".$randomString;
        $communication_object = new Communication();
        $communication_object->send_Email($save_user->email,"Sulashop",$sms,env("SULASHOP_EMAIL"));
        return redirect()->route('user.index');
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
        //
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
        //
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
