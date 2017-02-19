<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class CommentaireController extends Controller
{

    public function __construct()
    {
        //$this->middleware('isAdmin', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Comment::paginate(10);
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
        $lastComment = Comment::orderBy('id', 'desc')->first();
        $fileName = null;

        $this->validate($request, [
            'comment' => 'required|min:5|max:400',
            'comment_img' => 'mimes:jpeg,jpg,png'
        ],
            [
                'comment.required' => 'Texte obligatoire pour publier un commentaire',
                'comment_img' => 'Seulement du jpeg,jpg et png'
            ]);

        if($request->hasFile('comment_img')) {
            $newCommentId = $lastComment->id+1;
            $fileName = $newCommentId.'.'.$request->file('comment_img')->getClientOriginalExtension();
            $request->file('comment_img')->move(base_path() . '/public/images/comments', $fileName);
        }

         Comment::create([
            'user_id' => Auth::user()->id,
            'article_id'=> $article_id,
            'comment' => $request->comment,
            'comment_img' => $fileName
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
        $commentaire = Comment::find($id);


        if(!$commentaire) {
            return redirect()->route('article.index');
        }


        return view('commentaires.edit', compact('commentaire', 'id'));
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
            'comment' => 'required|min:5|max:400',
            'comment_img' => 'mimes:jpeg,jpg,png'
        ],
            [
                'comment.required' => 'Texte obligatoire pour publier un commentaire',
                'comment_img' => 'Seulement du jpeg,jpg et png'
            ]);

        $comment = Comment::find($id);
        $comment->comment = $request->comment;
        if($request->hasFile('comment_img')) {
            $actuImg = $comment->comment_img;
            File::delete('/public/images/comments/'.$actuImg);
            $fileName = $id.'.'.$request->file('comment_img')->getClientOriginalExtension();
            $request->file('comment_img')->move(base_path() . '/public/images/comments', $fileName);
        }
        $comment->save();
        $article = $comment->article_id;

        return redirect()->route('article.show', [$article])->with('success', 'Article modifié');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);
        $article_id = $comment->article_id;

        $comment->delete();

        return redirect()->route('article.show', [$article_id])->with('success', 'Commentaire supprimé');
    }
}
