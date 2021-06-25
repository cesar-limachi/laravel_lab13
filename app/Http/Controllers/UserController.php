<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;




class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function editar_usuario(Request $request, $id)
    {
        $user = User::find($id);
        if (($request->name && $request->email && $request->password) != null ) {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password =  password_hash($request->password, PASSWORD_DEFAULT);
            $user->save();

            return redirect()
            ->route('index');
        } else {
        return redirect()->back();
        }
    }

    public function eliminar_usuario()
    {
        $id = Auth::id();
        $user = User::where('_id', '=', $id)->delete();
        $posts = Post::where('user_id', '=', $id)->delete();
        return redirect()->route('index');
    }
}