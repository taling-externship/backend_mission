<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\LikeManager;
use Illuminate\Http\Request;

class LikedController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

     /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */

    public function liked(Article $article){
        $you = auth()->user(); 
        $articleCheck = Article::where('id', $article->id)->first();
        $articleCheck->liked += 1;
        $articleCheck->save();

        $likedCheck = LikeManager::where(['user_id'=>$you->id, 'articles_id'=>$article->id])->first();
        if($likedCheck == null){
           $likeCheck = new LikeManager;
           $likeCheck->user_id = $you->id;
           $likeCheck->articles_id = $article->id;
           $likeCheck->like_check = 1;
           $likeCheck->save();
        }
        else{
            $likedCheck->like_check = 1;
            $likedCheck->save();
        }
        return redirect()->route('articles.detail', $article->id)->with('liked', "좋아요가 완료되었습니다.");
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */

    public function disliked(Article $article){
        $you = auth()->user(); 
        $likedCheck = LikeManager::where(['user_id'=>$you->id, 'articles_id'=>$article->id])->first();
        if($likedCheck == null){
           $likeCheck = new LikeManager;
           $likeCheck->user_id = $you->id;
           $likeCheck->articles_id = $article->id;
           $likeCheck->like_check = 0;
        }
        else{
            $likedCheck->like_check = 0;
            $likedCheck->save();
        }
        return redirect()->route('articles.detail', $article->id)->with('liked', "좋아요가 해제되었습니다.");
    }
}
