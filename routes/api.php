<?php

use Illuminate\Http\Request;
use App\Stock;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/searchstocks',function(){
 $query = Input::get('query');
 $stocks = DB::table('stocks')->where('symbol','like',$query.'%')->get();
 return response()->json($stocks);
});
