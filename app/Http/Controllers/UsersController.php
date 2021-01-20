<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersController extends Controller
{
    public function create(){
        return view('users.create');
    }

    public function list(){
        $users = User::all();
        return view('users.list', ['users' => $users]);
    }

    public function edit($id){
        $user = User::findOrFail($id);
        return view('users.edit', ['user' => $user]);
    }










    

    public function store(Request $request){
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return "Usuário criado com sucesso! <a href='/users/list'>Voltar para a lista</a>";
    }

    public function show($id){
        $user = User::findOrFail($id);
        return view('users.show', ['user' => $user]);
    }

  

    public function update(Request $request, $id){
        $user = User::findOrFail($id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return "Usuário atualizado com sucesso! <a href='/users/list'>Voltar para a lista</a>";
    }

    public function delete($id){
        $user = User::findOrFail($id);
        return view('users.delete', ['user' => $user]);
    }

    public function destroy($id){
        $user = User::findOrFail($id);
        $user->delete();

        return "Usuário excluído com sucesso! <a href='/users/list'>Voltar para a lista</a>";
    }
}
