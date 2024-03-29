<?php
 
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Hash;
use Illuminate\Http\Request;
use App\User;
 
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
        $users = User::latest()->paginate(5);
        return view('users.all', compact('users'));
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
          return view('users.create');
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
         $validatedData =  Validator::make($request->all(),[
        'name' => 'required|max:40',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6'
    ]);
          if ($validatedData->fails()) {
            return redirect('users/create')
                        ->withErrors($validatedData)
                        ->withInput();
        }
        $inputs=[
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ];
       if(User::create($inputs)){
 
        return  redirect('users');
      }
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