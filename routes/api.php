<?php

use Illuminate\Http\Request;
use App\Stock;
use App\monthlyQuotes;
use App\User;
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
//filtro ativo da listagem de usuarios, no index
Route::get('/listarusuarios', function() {
  $query = Input::get('query');
  $field = Input::get('field');
  if ($field == ""){
  $users = User::where('name', 'like','%'.$query.'%')->get();
} else {
  $users = User::where($field, 'like','%'.$query.'%')->get();
}
	return response()->json($users);
});
Route::get('/getuser/{id}', function ($id) {
	$user = User::where('id', $id)->get();
	return $user;
});
//listagem de stocks
Route::get('/searchstocks',function(){
 $query = Input::get('query');
 $stocks = DB::table('stocks')->where('symbol','like',$query.'%')->get();
 return response()->json($stocks);
});
//listagem de corretoras
Route::get('/searchbrokers',function(){
 $query = Input::get('query');
 $brokers = DB::table('brokers')->where('name','like',$query.'%')->get();
 return response()->json($brokers);
});
//procura broker em especifico 
Route::get('/searchbroker',function(){
 $query = Input::get('query');
 $broker = DB::table('brokers')->where('id','like',$query.'%')->value('name');
 return response()->json($broker);
});
//listagem de todos invests
Route::get('/searchinvests',function(){
	$user = Auth::user();
		if ($user->role_id == '1'){
 				$invests = DB::table('invests')->get();
 				return response()->json($invests);
		}else {
				$invests = DB::table('invests')->where('user_id',$user->id)->get();
				return response()->json($invests);
	}
});
//coloca na tela as cotacoes de um stock
Route::get('/getquote/{symbol}', function ($symbol) {
//    $stock = 'ITSA3.SA';
		$url = "https://www.alphavantage.co/query?function=TIME_SERIES_MONTHLY&symbol=" . $symbol . "&apikey=" . env('APLHAVANTAGE_APIKEY') . "&datatype=csv";
		$stockquote = file_get_contents($url);
    return view('stocks.getquote', ['stockquote' => $stockquote]);
}); 
// Route::get('/product/{id}', function ($id) {
//     $product = \App\Product::with('category')->find($id);
//     return response(view('product',array('product'=>$product)),200, ['Content-Type' => 'application/json']);
// });
//{!! json_encode($product) !!}