<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UsersRequest;
use App\User;
//use cacoma\Role; **nao precisa mais
class UserController extends Controller
{
	public function __construct()
{
    $this->middleware('auth');
}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		//$user = Auth::user();
		//clock(User::first(), auth()->user(), $username);
		//if ($user->role_id == '1'){
        //$users = User::all()->toArray();
       // return view('users.index', compact('users'));
		//} else {
		//	return view('welcome');
		//}
      $users = DB::table('users')->paginate(15);

        return view('users.index', ['users' => $users]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
       // return view('users.create');
			return redirect('users')->with('errors','Usuarios devem ser criados pela pagina principal.');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
//         return User::create([
//             'name' => $data['name'],
//             'password' => bcrypt($data['password']),
//             'lastname' => $data['lastname'],
//             'sex' => $data['sex'],
//             'etnia' => $data['etnia'],
//             'cidade' => $data['cidade'],
//             'uf' => $data['uf'],
//             'pais' => $data['pais'],
//             'email' => $data['email'],
//             ]);
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
        $user = Invest::find($id);
        return view('users.edit',compact('user','id'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    // public function update(Request $request)
    {
		$userUpdate = User::find($id);
		$user = Auth::user();
		//dono e admin somente podem alterar
		if ($user->role_id == '1'){
			$this->validate(request(), [
				'name' => 'required|string|max:255',
				'email' => 'required|email|max:255',
				'role_id' => 'required',
		]);
		$userUpdate->name = $request->get('name');
		$userUpdate->email = $request->get('email');
		$userUpdate->role_id = $request->get('role_id');
		$userUpdate->save();
		return response()->json([
            'success' => 'Usuario atualizado com sucesso.'
        ], 200);
		// return redirect('users.index')->with('success','Usuario atualizado');
	}else{
		return response()->json([
            'error' => 'Acesso negado.'
        ], 200);
		// return redirect('users.index')->with('error','Nao foi possivel atualizar o usuario.');
	}
	// 	return $request->input('name');
	// } else {
	// 	return $request->input('email');
	// }
		// return $request->input('name');
		//----old
		// 		$userUp = User::findOrFail($request->id);
				// $this->validate(request(), [
        //     'name' => 'required|max:255',
        //     'email' => 'required|email',
        // ]);
		//
    //     $userUp->name = $request->get('name');
    //     $userUp->email = $request->get('email');
    //     $userUp->save();
		//
    //     return response()->json([
    //         'message' => 'Task updated successfully!'
    //     ], 200);
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
    $userDel = User::find($id);
		$user = Auth::user();
		//dono e admin somente podem alterar
			if ($user->role_id == '1'){
       $userDel->delete();
			 return response()->json([
	             'success' => 'Usuario deletado com sucesso!'
	         ], 200);
      //  return redirect('users.index')->with('success','Usuario deletado');
    }else{
		return response()->json([
            'error' => 'Acesso negado.'
        ], 200);
			}
		}
}