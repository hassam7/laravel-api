<?php

namespace App\Http\Controllers;
use App\User;
Use App\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\facades\Input;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response()->json(User::get(),200);  
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = [
            'username' => 'required',
            'email'=> 'required|email|unique:users,email',
            'password'=>'required|min:6'

        ];
        $messages = [
            'email.unique'=>'Email Address Already Exists',
            'password.min' =>'Password must be atleast 6 characters long'
        ];


        $validator = Validator::make(Input::all(),$rules,$messages);
        if($validator->fails()){
            return $validator->messages();
        }


        $username = $request->input('username');
        $email = $request->input('email');
        $password = $request->input('password');

        return ['username'=>$username,'email'=>$email,'password'=>$password];
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
