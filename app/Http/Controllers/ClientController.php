<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Order_product;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ClientsExport;
use Alert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;

class ClientController extends Controller
{

    //Get method for the client
    public function getClients(Request $request){
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
                        ->orWhere('email', 'LIKE', '%'.$search.'%');
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

        $pdf = Pdf::loadView('clientes.report', compact('arrayUsers'));
        return $pdf->stream('clientes.pdf');
    }
    public function exportExcel(){
        return Excel::download(new ClientsExport, 'Clientes.xlsx');
    }

    public function putEditClient(Request $request, $id){
    $user = User::findOrFail($id);

    // Validar la entrada, incluida la imagen
    $validator = Validator::make($request->all(), [
        'image' => 'image|mimes:jpeg,png,jpg|max:4096',
    ]);

    if ($validator->fails()) {
        return redirect('/clientes')
        ->withErrors($validator)
        ->withInput();
    }

    // Si se proporciona una nueva imagen, procesarla
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $destinationPath = 'images/avatarsUser/';
        $filename = time() . '-' . $file->getClientOriginalName();

        // Redimensionar y guardar la imagen
        $resizedImage = Image::make($file)->fit(512, 512);

        $resizedImagePath = $destinationPath . $filename;
        $resizedImage->save($resizedImagePath);

        // Eliminar la imagen anterior si existe
        if ($user->image) {
            File::delete($user->image);
        }
        // Actualizar el atributo de imagen del usuario con la nueva ruta
        $user->image = $resizedImagePath;
    }

    // Actualizar otros atributos del usuario
    $user->name = $request->input('name_update');
    $user->surname = $request->input('surname_update');
    $user->email = $request->input('emailPost_update');
    $user->phone = $request->input('phone_update');
    $user->street = $request->input('street_update');
    $user->city = $request->input('city_update');
    $user->state = $request->input('state_update');
    $user->CP = $request->input('CP_update');
    $user->save();

    return redirect('/clientes')->with('success', 'Cambios realizados correctamente');
    }

    public function postClient(Request $request){
        $user = new User;
        $user->name = $request->input('name_add');
		$user->surname = $request->input('surname_add');
        $user->email = $request->input('email_add');
        $user->password = $request->input('password_add');
        $user->rol = 'client';
        $user->phone = $request->input('phone_add');
        $user->state = $request->input('state_add');
        $user->city = $request->input('city_add');
        $user->street = $request->input('street_add');
        $user->CP = $request->input('CP_add');

        $currentDate = date('Y-m-d');
        $user->registration_date = $currentDate;
        
        $user->save();
		return redirect('/clientes');
    }
}
