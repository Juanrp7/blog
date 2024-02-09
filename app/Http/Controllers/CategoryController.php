<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Mostrar categorias en el admin
        $categories = Category::orderBy('id','desc')
                        ->simplePaginate(8);

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $category = $request->all();

        //Validacion
        if($request->hasFile('image')){
            $category['image'] = $request->file('image')->store('categories');
        }

        //Guardar
        Category::create($category);

        return redirect()->action([CategoryController::class, 'index'])
            ->with('success-create','La categoría se ha creado correctamente');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        //Si el usuario sube una imagen
        if($request->hasFile('image')){
            //Eliminar la imagen anterior
            File::delete(public_path('storage/' . $category->image));
            //Subir la nueva imagen
            $category['image'] = $request->file('image')->store('categories');
        }

        //Actualizar
        $category->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'status' => $request->status,
            'is_featured' => $request->is_featured,
        ]);

        return redirect()->action([CategoryController::class, 'index'], compact( 'category'))
            ->with('success-update','La categoría se ha actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //Eliminar la imagen
        if($category->image)
            File::delete(public_path('storage/'. $category->image));

        //Eliminar la categoria
        $category->delete();

        return redirect()->action([CategoryController::class, 'index'])
            ->with('success-delete','La categoría se ha eliminado correctamente');
    }

    //Filtrar articulos por categorias
    public function detail(Category $category){

        $articles = Article::where([
            ['category_id', $category->id],
            ['status', '1']
        ])
            ->orderBy('id', 'desc')
            ->simplePaginate(5);

        //Obtener las categorias con estado publico y detacadas
        $navbar = Category::where([
            ['status', '1'],
            ['is_featured', '1']
        ])->paginate(3);

        return view('subscriber.categories.detail', compact('articles', 'category', 'navbar'));
    }
        
}
