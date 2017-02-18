<?php

namespace App\Http\Controllers;

use App\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $article_id = $request->article_id;

        Like::create([
            'user_id' => Auth::user()->id,
            'article_id'=> $article_id
        ]);



        return redirect()->route('article.show', [$article_id])->with('success', 'Vous aimez l\'article');
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
        $a_aime= false;

        if(!$article) {
            return redirect()->route('article.index');
        }

        foreach($article->likes as $like) {
            if($like->user_id == Auth::user()->id){
                $a_aime=true;
            }
        }

        return view('articles.show', compact('a_aime'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $like = Like::find($id);
        $article_id = $like->article_id;

        $like->delete();

        return redirect()->route('article.show', [$article_id])->with('success', 'Vous n\'aimez plus cette article');
    }
}
