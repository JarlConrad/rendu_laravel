<?php

namespace App\Http\Controllers;

use App\Article;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


class ArticleController extends Controller
{

    public function __construct()
    {
        $this->middleware('isAdmin', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::paginate(10);
        return view('articles.index', compact('articles'));
    }

    public function indexAdmin()
    {
        $articles = Article::paginate(5);
        return view('admin', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $lastArticle = Article::orderBy('id', 'desc')->first();
        $fileName = null;

        $this->validate($request, [
            'title' => 'required|min:5|max:30',
            'content' => 'required',
            'image_path' => 'mimes:jpeg,jpg,png'
        ],
            [
                'title.required' => 'Titre obligatoire',
                'content.required' => 'Contenu obligatoire',
                'image_path.mimes' => 'Seulement du jpeg,jpg et png'
            ]);

        if($request->hasFile('image_path')) {
            $newArticleId = $lastArticle->id+1;
            $fileName = $newArticleId.'.'.$request->file('image_path')->getClientOriginalExtension();
            $request->file('image_path')->move(base_path() . '/public/images/articles', $fileName);
        }

        $article = Article::create([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'image_path' => $fileName,
            'content' => $request->content
        ]);



        return redirect()->route('article.show', [$article->id])->with('success', 'Article ajouté');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);

        if(!$article) {
            return redirect()->route('article.index');
        }

        return view('articles.show', compact('article', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);

        if(!$article) {
            return redirect()->route('article.index');
        }


        return view('articles.edit', compact('article', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|min:5|max:30',
            'content' => 'required',
            'image_path' => 'mimes:jpeg,jpg,png'
        ],
            [
                'title.required' => 'Titre obligatoire',
                'content.required' => 'Contenu obligatoire',
                'image_path.mimes' => 'Seulement du jpeg,jpg et png'
            ]);

        $article = Article::find($id);
        $article->title = $request->title;
        $article->content = $request->content;
        if($request->hasFile('image_path')) {
            $actuImg = $article->image_path;
            File::delete('/images/'.$actuImg);
            $fileName = $id.'.'.$request->file('image_path')->getClientOriginalExtension();
            $request->file('image_path')->move(base_path() . '/public/images/', $fileName);
        }
        $article->save();

        return redirect()->route('article.show', [$article->id])->with('success', 'Article modifié');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);

        $article->delete();

        return redirect()->route('article.index')->with('success', 'Article supprimé');
    }


}
