<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CategoriasExport;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;

class ProductosController extends Controller
{


    public function getCategorias(Request $request)
    {
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

        if ($search != '') {
            $searchLower = strtolower($search);

            $query->where(function ($queryBuilder) use ($search) {
                $queryBuilder->where('categories.name', 'LIKE', '%' . $search . '%')
                    ->orWhere('parent.name', 'LIKE', '%' . $search . '%');
            });

            if ($searchLower === 'categoría principal') {
                $query->orWhereNull('categories.category_id');
            }
        }

        $arrayCategorias = $query->paginate($paginate);

        /* Array de todas las categorías para seleccionar el campo de select de categoría padre */
        $arrayCategoriasAll = Category::with('categories')
            ->with('products')
            ->orderBy('name', 'asc')
            ->get();

        return view(
            'productos/categorias/categorias',
            compact(
                'arrayCategorias',
                'arrayCategoriasAll',
                'sort',
                'order',
                'search'
            )
        );
    }

    /* Funciones de exporta categorías en PDF y EXCEL */
    public function exportPDFCategorias()
    {
        $arrayCategorias = Category::all();
        $pdf = Pdf::loadView('productos.categorias.report', compact('arrayCategorias'));
        return $pdf->stream('categorias.pdf');
    }
    public function exportExcelCategorias()
    {
        return Excel::download(new CategoriasExport, 'Categorias.xlsx');
    }

    public function postCategory(Request $request)
    {
        $category = new Category;
        $category->name = $request->input('name_add');
        $category->fondo = $request->input('colorPickerTextAdd');

        /* Subida de imagen */
        $validator = Validator::make($request->all(), [
            'image_category_add' => 'image|mimes:jpeg,png,jpg|max:20000',
        ]);

        if ($validator->fails()) {
            return redirect('/categorias')
                ->withErrors($validator)
                ->withInput();
        }

        // Si se proporciona una nueva imagen, procesarla
        if ($request->hasFile('image_category_add')) {
            $file = $request->file('image_category_add');
            $destinationPath = 'images/categoryImage/';
            $filename = time() . '-' . $file->getClientOriginalName();
            // Redimensionar y guardar la imagen
            $resizedImage = Image::make($file)->fit(512, 512);
            $resizedImagePath = $destinationPath . $filename;
            $resizedImage->save($resizedImagePath);
            // Actualizar el atributo de imagen del usuario con la nueva ruta
            $category->imagen = $resizedImagePath;
        }

        if($request->input('category_parent_add') !== "CATEGORÍA PRINCIPAL"){
            $category->category_id = $request->input('category_parent_add');
        }

        $category->save();
        /* $category->imagen = $request->input('imagen'); */
        return redirect('/categorias');
    }

    public function putCategory(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'image_category_update' => 'image|mimes:jpeg,png,jpg|max:20000',
        ]);

        if ($validator->fails()) {
            return redirect('/categorias')
            ->withErrors($validator)
            ->withInput();
        }

        // Si se proporciona una nueva imagen, procesarla
        if ($request->hasFile('image_category_update')) {
            $file = $request->file('image_category_update');
            $destinationPath = 'images/categoryImage/';
            $filename = time() . '-' . $file->getClientOriginalName();
            // Redimensionar y guardar la imagen
            $resizedImage = Image::make($file)->fit(512, 512);
            $resizedImagePath = $destinationPath . $filename;
            $resizedImage->save($resizedImagePath);

            // Eliminar la imagen anterior si existe
            if ($category->imagen) {
                File::delete($category->imagen);
            }
            // Actualizar el atributo de imagen del usuario con la nueva ruta
            $category->imagen = $resizedImagePath;
        }

        $category->fondo = $request->input('colorPicker');
        $category->name = $request->input('name_update');

        if($request->input('category_parent_update') === "CATEGORÍA PRINCIPAL"){
            $category->category_id = null;
        }else{
            $category->category_id = $request->input('category_parent_update');
        }

        $category->save();
        return redirect('/categorias');
    }



    public function getProductos()
    {
        $arrayProductos = Product::all();
        return view('productos/productos', ['arrayProductos' => $arrayProductos]);
    }

    public function getProductosInformes()
    {
        return view('productos/productos_informes');
    }
}
