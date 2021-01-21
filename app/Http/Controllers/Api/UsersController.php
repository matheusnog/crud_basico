<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersController extends Controller
{
    public function getAll(){
        return User::all();
    }

    public function get($id){
        return User::find($id);
    }

    public function post(Request $request){
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            'message'=>'Usuario criado com sucesso!',
            'data'=>$user],200);
    }

    public function put($id, Request $request){
        $user = User::find($id);
        
        if(is_object($user)){
            $user->name = $request->name;
            $user->email = $request->email;
            if($request->password != ""){
                $user->password = Hash::make($request->password);
            }
            // comentario
            $user->save();

            return response()->json([
            'message'=>'Usuario alterado com sucesso!',
            'data'=>$user],200);
        }else{
            return response()->json([
            'message'=>'Não foi possível alterar o usuario',
            'data'=>''],404);
        }
    }

    public function delete($id){
        $user = User::find($id);
        if(is_object($user)){
            $user->delete();
            return response()->json([
                'message'=>'Usuario deletado com sucesso!',
                'data'=>$user],200);
        }else{
            return response()->json([
                'message'=>'Não foi possível deletar o usuario!',
                'data'=>''],404);
        }
    }
}
