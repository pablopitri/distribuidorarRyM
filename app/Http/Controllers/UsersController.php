<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin')->except('show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'desc')->simplePaginate(12);
        return view('users.index', ['users'=> $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User;
        $user->rol = '';
        return view('users.create', ['user' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User;

        $hasFile = $request->hasFile('image') && $request->image->isValid();
        $image = 'images/img.jpg';

        if ($hasFile) {
            $image = "images/users/".uniqid().".".$request->image->extension();
            $url = public_path($image);
            $img = \Image::make($request->file('image'))->resize(320, 240);
        }

        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->image = $image;
        $user->rol = $request->rol ? $request->rol : 'cajero';
        $email = User::where('email', $user->email)->count();
        if($email)
            return view('users.create', ['notice' => 'El email introducido ya esta siendo utilizado por otro usuario', 'user' => $user]);
        if($request->password == $request->password_confirmation){
            if($user->save()){
                if($hasFile)
                    $img->save($url);
                return redirect('/users');
            }
            else
                return view('users.create', ['notice' => 'No se pudo guardar el usuario', 'user' => $user]);
        }
        else    
            return view('users.create', ['notice' => 'Las contraseñas no coinciden. Por favor intentelo nuevamente', 'user' => $user]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit', ['user' => $user]);
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
        $user = User::find($id);
        $email = 0;

        $hasFile = $request->hasFile('image') && $request->image->isValid();

        if ($hasFile) {
            $image = "images/users/".uniqid().".".$request->image->extension();
            $url = public_path($image);
            $img = \Image::make($request->file('image'))->resize(320, 240);
            $user->image = $image;
        }

        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->username = $request->username;
        $user->rol = ($request->rol) ? $request->rol : 'cajero';
        if($user->email != $request->email)
        {
            $user->email = $request->email;
            $email = User::where('email', $user->email)->count();
        }
        if($request->password){
            $user->password = bcrypt($request->password);
            if ($request->password != $request->password_confirmation)
                return view('users.edit', ['notice' => 'Las contraseñas no coinciden. Por favor intentelo nuevamente', 'user' => $user]);
        }
        if($email)
            return view('users.edit', ['notice' => 'El email introducido ya esta siendo utilizado por otro usuario', 'user' => $user]);
        if($user->save())
        {
            if($hasFile)
                $img->save($url);
            return redirect('/users');
        }
        else
            return view('users.edit', ['notice' => 'No se pudo guardar el usuario', 'user' => $user]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if($user->delete())
        {
            return redirect('/users');
        }
    }

    public function search($nombre, $email, $priv){
        $users = User::orderBy('id', 'desc')
                        ->nombre($nombre)
                        ->email($email)
                        ->privilegio($priv)
                        ->get();
        return response()->json($users);
    }
}
