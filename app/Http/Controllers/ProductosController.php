<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CategoriasExport;

class ProductosController extends Controller
{

    
    public function getCategorias(Request $request){
        $paginate = 10;
        $search = $request->filled('search') ? $request->search : '';
        $sort = $request->has('sort') ? $request->sort : 'name';
        $order = $request->has('order') ? $request->order : 'asc';
    
        //En vez de all usar query para añadir condiciones adicionales
        $query = Category::query();

        $query->leftJoin('categories as parent', 'categories.category_id', '=', 'parent.id')
        ->select('categories.*', 'parent.name as parent_name');

        if ($sort === 'parent_name') {
            $sort = 'parent_name';
        }

        $query->orderBy($sort, $order);

        if($search != ''){
            $searchLower = strtolower($search); 

            $query->where(function($queryBuilder) use ($search) {
                $queryBuilder->where('categories.name', 'LIKE', '%'.$search.'%')
                ->orWhere('parent.name', 'LIKE', '%'.$search.'%');
            });

            if($searchLower === 'categoría principal') {
                $query->orWhereNull('categories.category_id');
            }
        }

        $arrayCategorias = $query->paginate($paginate);
        return view('productos/categorias/categorias', compact('arrayCategorias', 'sort', 'order', 'search'));
    }

    public function exportPDF(){
        $arrayCategorias = Category::all();
        $pdf = Pdf::loadView('productos.categorias.report', compact('arrayCategorias'));
        return $pdf->stream('categorias.pdf', compact('arrayCategorias'));
    }
    public function exportExcel(){
        return Excel::download(new CategoriasExport, 'Categorias.xlsx');
    }
    

    public function getProductos(){
        $arrayProductos = Product::all();
        return view('productos/productos', ['arrayProductos' => $arrayProductos]);
    }
    
    public function getProductosInformes(){
        return view('productos/productos_informes');
    }
}
