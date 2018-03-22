<?php

namespace App\Http\Controllers;

use App\invest;
use Illuminate\Http\Request;

class InvestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //implementar
      $user = Auth::user();
        if ($user->role_id == '1'){
            $invests = Invest::with('user')->get();
            return view('invests.index')->withinvests($invests);
        } else {
          $invests = Invest::where('user_id', $user->id )->get();
          return view('invests.index', compact('invests'));
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
        //implementar, campos ainda não definidos
        $invests = $this->validate(request(), [
						'symbol' => 'required|string|max:255',
						'type' => 'required|string|max:255',
					]);
       Stock::create([
            'symbol' => strtoupper($invests['symbol']),
				 		'type' => strtoupper($invests['type']),
            ]);
       return back()->with('success', 'O investimento foi adicionado.');
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
      $invest = invest::find($id);
      return view('invests.show', array('invest' => $invest));
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\invest  $invest
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //implementar
       $invest = Invest::find($id);
        return view('invests.edit',compact('invest','id'));
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
        //implementar
      	$invest = Invest::find($id);
				$user = Auth::user();
				//dono e admin somente podem alterar
				if ($user->id == $invest->user_id || $user->role_id == '1'){
					$this->validate(request(), [
						'name' => 'required|string|max:255',
						'type' => 'required|string|max:255',
						]);
	        $invest->name = $request->get('name');
	        $invest->type = $request->get('type');
	        $invest->save();
	        return redirect('invests')->with('success','Invest atualizado');
				}else{
					return back()->with('error', 'O invest nao pode ser adicionado');
				}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\invest  $invest
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //implementar
      $invest = Invest::find($id);
			$user = Auth::user();
				//dono e admin somente podem alterar
				if ($user->id == $invest->user_id || $user->role_id == '1'){
       			$invest->delete();
       			return redirect('invests')->with('success','Invest deletado');
		 		}else {
		 				return back()->with('error', 'O invest nao pode ser adicionado');
		 		}
    }
}
