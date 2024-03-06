<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Order_product;



class ClientController extends Controller
{

    public function getClients()
    {
        $arrayUsers = User::where('rol', '=', 'client')
        ->with([
            'orders' => function ($query) {
                $query->withSum('orders_product', 'price');
            }
        ])->get();
        return view('clientes/clientes', ['arrayUsers' => $arrayUsers]);
    }

    public function putEditClient(Request $request, $id)
	{
		$user = User::findOrFail($id);


        if($request->file('image') != null){
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Ajusta los mime types y el tamaño máximo según tus necesidades
            ]);
            if($request->file('image')->isValid()){
                $file = $request->file('image');
                $destinationPath = 'images/avatarsUser/';
                $filename = time().'-'.$file->getClientOriginalName();
                $request->file('image')->move($destinationPath, $filename);
                $user->image = $destinationPath . $filename;
            }
        }
		$user->name = $request->input('name');
		$user->surname = $request->input('surname');
        $user->email = $request->input('emailPost');
		$user->street = $request->input('street');
		$user->city = $request->input('city');
		$user->state = $request->input('state');
		$user->CP = $request->input('CP');
		$user->save();
		return redirect('/clientes');
	}

    public function postClient(Request $request){
        $user = new User;
        $user->name = $request->input('name');
		$user->surname = $request->input('surname');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->rol = 'client';
        $user->save();
		return redirect('/clientes');
    }
}
