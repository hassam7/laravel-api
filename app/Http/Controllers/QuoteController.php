<?php

namespace App\Http\Controllers;
use App\Quote;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use JWTAuth;


class QuoteController extends Controller
{

    public function __construct(){
        $this->middleware('jwt.auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(! $user=JWTAuth::parseToken()->authenticate()){
            return response()->json(['msg'=>'Invalid User'],404);
        }
        return User::findOrFail($user->id)->quotes;
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
            'quote_text' => 'required',
            'author_text'=> 'required',

        ];
     
        if(! $user=JWTAuth::parseToken()->authenticate()){
            return response()->json(['msg'=>'Invalid User'],404);
        }

        $validator = Validator::make(Input::all(),$rules);
        if($validator->fails()){
            return $validator->messages();
        }
        
        $quote_text  =  $request->input('quote_text');
        $author_text =  $request->input('author_text');
        $user_id     =  $user->id;

        $q = new Quote();
        $q->quote_text = $quote_text;
        $q->author_text= $author_text;
        $q->user_id = $user_id;
        return User::findOrFail($user_id)->quotes()->save($q);

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
        if(! $user=JWTAuth::parseToken()->authenticate()){
            return response()->json(['msg'=>'Invalid User'],404);
        }
        
        $q = User::findOrFail($user->id)->quotes()->findOrFail($id);
        $q->delete();
        return $q;
    }
    public function quoteById($id)
    {
        if(! $user=JWTAuth::parseToken()->authenticate()){
            return response()->json(['msg'=>'Invalid User'],404);
        }
        return response()->json(User::findOrFail($user->id)->quotes()->findOrFail($id),200);
    }
}
