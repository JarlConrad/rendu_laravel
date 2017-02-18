<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        $this->validate($request, [
            'comment' => 'required|min:5|max:400',
            'comment_img' => 'mimes:jpeg,jpg,png'
        ],
            [
                'comment.required' => 'Texte obligatoire pour publier un commentaire',
                'comment_img' => 'Seulement du jpeg,jpg et png'
            ]);


        Like::create([
            'user_id' => Auth::user()->id,
            'article_id'=> $article_id,
        ]);



        return redirect()->route('article.show', [$article_id])->with('success', 'Commentaire ajouté');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $article_id = $comment->article_id;

        $comment->delete();

        return redirect()->route('article.show', [$article_id])->with('success', 'Commentaire supprimé');
    }
}
