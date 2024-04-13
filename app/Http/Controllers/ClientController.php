<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Order_product;
use Barryvdh\DomPDF\Facade\Pdf;

class ClientController extends Controller
{

    public function getClients(Request $request)
    {
        $paginate = 10;
        $search = $request->filled('search') ? $request->search : '';
        $sort = $request->has('sort') ? $request->sort : 'name';
        $order = $request->has('order') ? $request->order : 'asc';
    
        $query = User::where('rol', '=', 'client')
            ->with([
                'orders' => function ($query) {
                    $query->withSum('orders_product', 'price');
                }
            ]);
    
        if ($search != '') {
            $arrayUsers = $query->where(function($query) use ($search) {
                    $query->where('name', 'LIKE', '%'.$search.'%')
                        ->orWhere('email', 'LIKE', '%'.$search.'%')
                        ->orWhere('phone', 'LIKE', '%'.$search.'%');
                })
                ->orderBy($sort, $order)
                ->paginate($paginate);
        } else {
            $arrayUsers = $query->orderBy($sort, $order)
                ->paginate($paginate);
        }
        
        return view('clientes.clientes', compact('arrayUsers', 'sort', 'order', 'search'));
    }

    public function exportPDF(){
        $arrayUsers = User::where('rol', '=', 'client')
            ->with([
                'orders' => function ($query) {
                    $query->withSum('orders_product', 'price');
                }
            ])->get();
        /* $arrayUsers = User::all(); */
        $pdf = Pdf::loadView('clientes.report', compact('arrayUsers'));
        return $pdf->stream('clientes.pdf');
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
