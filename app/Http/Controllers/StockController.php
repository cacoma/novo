<?php

namespace App\Http\Controllers;

use App\stock;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
      $stocks = DB::table('stocks')->paginate(15);
      return view('stocks.index', ['stocks' => $stocks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        ////
      return view('stocks.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //valida antes de dar o store
				$stock = $this->validate(request(), [
						'symbol' => 'required|string|max:255',
						'type' => 'required|string|max:255',
					]);
       Stock::create([
            'symbol' => strtoupper($stock['symbol']),
				 		'type' => strtoupper($stock['type']),
            ]);
       return back()->with('success', 'A ação foi adicionada.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
      $stock = stock::find($id);
      return view('stocks.show', array('stock' => $stock));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $stock = Stock::find($id);
        return view('stocks.edit',compact('stock','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
			$user = Auth::user();
			if ($user->role_id == '1'){
      $stockUpdate = Stock::find($id);
			$this->validate(request(), [
						'symbol' => 'required|string|max:255',
						'type' => 'required|string|max:255',
						]);
	        $stockUpdate->symbol = strtoupper($request->get('symbol'));
	        $stockUpdate->type = strtoupper($request->get('type'));
	        $stockUpdate->save();
	         return back()->with('success','Acao atualizada');
				}else{
				return back()->with('error','Acao nao atualizada!');
		    }
			//admin somente podem alterar -->implementar
		  //$user = Auth::user();
		  
//         if ($user->role_id == '1'){
//             $this->validate(request(), [
//                 'symbol' => 'required|string|max:255',
//             ]);
//         $stockUpdate->symbol = $request->get('symbol');
//         $stockUpdate->save();
//         return response()->json([
//                 'success' => 'Stock updated successfully!'
//             ], 200);
//         }else{
//         return response()->json([
//                 'error' => 'Stock NOT updated successfully!'
//         ], 200);
//     }
			
			
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
       $stockDel = Stock::find($id);
       $stockDel->delete();
			 return back()->with('success', 'A ação foi deletada.');
    }
}
