<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;



class ClientsExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('clientes.report', [
            'arrayUsers' => User::where('rol', '=', 'client')
            ->with([
                'orders' => function ($query) {
                    $query->withSum('orders_product', 'price');
                }
            ])->get()
        ]);

        
    }
}
