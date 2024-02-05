<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
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
                        ->with('succes-create', 'Articulo creado correctamente');

    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        //
    }
}
