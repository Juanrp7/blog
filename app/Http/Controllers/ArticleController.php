<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ArticleController extends Controller
{
    //Proteger rutas
    public function __construct() {
        $this->middleware('can:articles.index')->only('index');
        $this->middleware('can:articles.create')->only('create', 'store');
        $this->middleware('can:articles.edit')->only('edit', 'update');
        $this->middleware('can:articles.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user(); //Taer la info del usuario autenticado
        $articles = Article::where('user_id', $user->id)
                    ->orderBy('id', 'desc')
                    ->simplePaginate(10);

        return view('admin.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //obtener categorias publicas
        $categories =  Category::select(['id', 'name'])
                        ->where('status', '1')
                        ->get();

        return view('admin.articles.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleRequest $request)
    {
        $request->merge([
            'user_id' => Auth::user()->id,
        ]);

        $article = $request->all();

        //Validar si aun un archivo en el request
        if($request->hasFile('image')){
            $article['image'] = $request->file('image')->store('articles', 'public');
        }

        //Gaurda la informacion de articulo en la BD
        Article::create($article);

        //Redireccionar al index de articulos
        return redirect()->action([ArticleController::class, 'index'])
                        ->with('success-create', 'Articulo creado correctamente');

    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        $this->authorize('published', $article);

        $comments = $article->comments()->simplePaginate(5);

        return view('subscriber.articles.show', compact('article', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        $this->authorize('view', $article);

        //obtener categorias publicas
        $categories =  Category::select(['id', 'name'])
                        ->where('status', '1')
                        ->get();

        return view('admin.articles.edit', compact('categories', 'article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleRequest $request, Article $article)
    {
        $this->authorize('update', $article);
        //Si el usuario sube una nueva imagen
        if($request->hasFile('image')){
            //Eliminar la imagen anterior
            File::delete(public_path('storage/'.$article->image));
            //Guardar la nueva imagen
            $article['image'] = $request->file('image')->store('articles');
        }

        //Actualizar datos
        $article->update(
            [
                'title' => $request->title,
                'slug' => $request->slug,
                'introduction' => $request->introduction,
                'body' => $request->body,
                'user_id' => Auth::user()->id,
                'category_id' => $request->category_id,
                'status' => $request->status,
            ]
        );

        return redirect()->action([ArticleController::class, 'index'])
                        ->with('success-update', 'Articulo modificado correctamente');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $this->authorize('delete', $article);
        //Eliminar la imagen
        if($article->image){
            File::delete(public_path('storage/'.$article->image));
        }

        //Eliminar el articulo
        $article->delete();

        return redirect()->action([ArticleController::class, 'index'], compact('article'))
                        ->with('success-delete', 'Articulo eliminado correctamente');
        
        
    }
}
