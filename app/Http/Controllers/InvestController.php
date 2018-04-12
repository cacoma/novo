<?php

namespace App\Http\Controllers;

use App\invest;
use App\users;
use App\monthlyQuotes;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class InvestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

		//se usuario estiver registrado, pode visualizar, caso nao, redirecionado para tela de login
			public function __construct()
		{
				$this->middleware('auth');
		}

    public function index()
    {
      //versão com paginação e mostrando tudo usando blade do laravel
//       $user = Auth::user();
//         if ($user->role_id == '1'){
//             $invests = Invest::with('user')->paginate(10);
//             return view('invests.index', compact('invests','user'));
//         } else {
//           $invests = Invest::where('user_id', $user->id )->paginate(10);
//           return view('invests.index', compact('invests','user'));
//         }
		$user = Auth::user();
		if ($user->role_id == '1'){
			$invests = Invest::with(['monthlyQuotes' => function ($query) {
										$query->whereDate('timestamp', '>', Carbon::now()->subMonth(2))->latest();
								}, 'broker'])->get();

 				//$invests = DB::table('invests')->get();
//  				$invests = Invest::with(['monthlyQuotes' => function ($query) {
// 										$query->latest();
// 								}])->get();
				//return response($invests);
// 				$symbols = array();
	 				foreach ($invests as $key => $value) {
// 					//ajusta nome do broker
// 	        $value->brokerName = $value->broker->name;
// 					//ajusta se a cotacao for menor ou maior que o price a forma da célula
	 					$value->quote = $value->monthlyQuotes[0]->close;
							if ($value->price > $value->quote) {
								 $field = array('price' => 'success');
								 $value->_cellVariants = (object) array_merge((array)$value->_cellVariants, (array)$field);
// 									$value->class =  array( 'background-color' => 'red');
// 							} else{
// 								$value->class =  array( 'background-color' => 'green');// 									
// 								$value->class =  "bg-success";
 									} else{
									$field = array('price' => 'warning');
									 $value->_cellVariants = (object) array_merge((array)$value->_cellVariants, (array)$field);
//  								$value->class =  "bg-warning";
								
// // 					if(!in_array($value->symbol,$symbols,true)) {
// // 							$symbols[$value->type] = $value->symbol;
	 					}

 				}
// 				$symbols = array_reduce((array)$invests, function ($acc, $inv) {
//         	$acc['symbols'] == $acc['symbols'] || [];
// 					array_push($acc['symbols'], $inv);
//           return $acc;
//         });
// 				var_dump((array)$invests);
// 				echo "\n\n get_object_vars:\n";
//  				$symbolsobj =  get_object_vars($invests);
// 				var_dump($symbolsobj);
// 				echo "\n\narray keys:\n";
//  				$symbols = array_keys((array)$invests);
//	 				var_dump($symbols);
// 				echo "\n\narray column:\n";
// 				$symbolsIndex = array_column((array)$invests, 'symbols', 'symbols');
// 				var_dump($symbolsIndex);
				//return view('invests.index')->with('invests', $invests)->with('symbols', $symbols)->with('symbolsIndex', $symbolsIndex);
				return view('invests.index')->with('invests', $invests);
				//return view('invests.index')->with('invests', $invests);

		}else {
				//essa query abaixo busca dados da tabela dos investimentos e das cotas mensais de cada ativo, e relaciona as duas.
				//depois ele puxa somente os registros que o timestamp, que eh a data real do fechamento, e puxa somente dos ultimos dois meses e a ultima por primeiro.
				//isso se faz para caso nao tenha sido inserido o valor neste mes ainda
				//alem desse relacionamento ele traz somente os investimentos que o id é o do usuario registrado
				$invests = Invest::with(['monthlyQuotes' => function ($query) {
										$query->whereDate('timestamp', '>', Carbon::now()->subMonth(2))->latest();
								}, 'broker'])->where('user_id',$user->id)->get();
			
				foreach ($invests as $key => $value) {
					$value->quote = $value->monthlyQuotes[0]->close;
							if ($value->price > $value->quote) {
								$value->win = "bg-danger";
							} else{
								$value->win = "bg-success";
							}
				}
			return view('invests.index')->with('invests', $invests);

    }
		}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //implementar
        return view('invests.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //criacao de investimentos vai ser pelo controlador de cada tipo de investimento,
				//afim de dissipar o codigo para os pontos relevantes

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\invest  $invest
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //implementar,
      $invest = invest::findOrFail($id);
      return $invest;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\invest  $invest
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
 				//edicao de investimentos vai ser pelo controlador de cada tipo de investimento,
				//afim de dissipar o codigo para os pontos relevantes

		}
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\invest  $invest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         //update de investimentos vai ser pelo controlador de cada tipo de investimento,
				//afim de dissipar o codigo para os pontos relevantes

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\invest  $invest
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //ainda não decidido se a exclusao do investimento eh por este controller ou pelo controller apropriado
      $invest = Invest::find($id);
			$user = Auth::user();
				//dono e admin somente podem alterar
				if ($user->id == $invest->user_id || $user->role_id == '1'){
       			$invest->delete();
       			return redirect('invests')->with('success','Invest deletado');
		 		}else {
		 				return back()->with('error', 'O invest nao pode ser deletado');
		 		}
    }

		public function indexinvests()
    {
			 $user = Auth::user();
		if ($user->role_id == '1'){
			$invests = Invest::with(['monthlyQuotes' => function ($query) {
										$query->whereDate('timestamp', '>', Carbon::now()->subMonth(2))->latest();
								}, 'broker'])->get();

 				//$invests = DB::table('invests')->get();
//  				$invests = Invest::with(['monthlyQuotes' => function ($query) {
// 										$query->latest();
// 								}])->get();
 				//$invests->lastMonthlyQuote->last();
 				//$invests
				//return response()->json($invests);
				//return response($invests);
				return \Response::json($invests);

		}else {
				//$invests = DB::table('invests')->where('user_id',$user->id)->get();
				//$date = Carbon::now()->subMonth();
				//essa query abaixo busca dados da tabela dos investimentos e das cotas mensais de cada ativo, e relaciona as duas.
				//depois ele puxa somente os registros que o timestamp, que eh a data real do fechamento, e puxa somente dos ultimos dois meses e a ultima por primeiro.
				//isso se faz para caso nao tenha sido inserido o valor neste mes ainda
				//alem desse relacionamento ele traz somente os investimentos que o id é o do usuario registrado
				$invests = Invest::with(['monthlyQuotes' => function ($query) {
										$query->whereDate('timestamp', '>', Carbon::now()->subMonth(2))->latest();
								}])->where('user_id',$user->id)->get();
				return \Response::json($invests);
		}
	}
}
