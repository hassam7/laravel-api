<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:api');
/*
    
GET 	/api/user			==> List All users
POST 	/api/user			==> Add new user

=========================================
GET 	/api/quote			==> List All Quotes
GET		/api/quote/id		==> Detail of Quote with id
POST 	/api/quote			==> Add New Qoute
DELETE	/api/quote/id		==> Delete Quote with id

*/
Route::resource('user', 'UserController');