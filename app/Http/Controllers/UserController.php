<?php

namespace App\Http\Controllers;
use App\User;
Use App\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\facades\Input;
use Illuminate\Support\Facades\Hash;

use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
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
        $u = User::create(['name'=>$username,'email'=>$email,'password'=>bcrypt($password)]);
        return  response()->json($u, 201);
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

    public function signin(Request $request)
    {
         $rules = [
            'email' => 'required|email',
            'password'=>'required|min:6'

        ];
        $validator = Validator::make(Input::all(),$rules);
        if($validator->fails()){
            return $validator->messages();
        }
        $credentials = ['email'=> $request->input('email'),
                        'password'=> ($request->input('password'))
                         ];

        try{
            if(! $token=JWTAuth::attempt($credentials)){
                return response()->json(['msg'=>'Authentication Failed'],401);
            }
        }catch(JWTException $e){
            return response()->json(['msg'=>'Error Occured'],500);

        }
        return response()->json(['token'=>$token]);

    }
}
