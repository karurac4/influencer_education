<?php

namespace App\Http\Controllers;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Article;
use App\Models\Top;


class TopController extends Controller
{

    // Article 表示
    public function showArticle() {
        // インスタンス生成
        $model = new Article();
        $articles = $model->getArticle();

        return view('top', ['articles' => $articles]);
    }


    // article id 遷移
    public function showArticles() {
        // インスタンス生成
        $model = new Article();
        $articles = $model->getArticle();

        return view('show.articles/{id}', ['articles' => $articles]);
    }


    // top表示
    public function top(Request $request) {
        $model = new Article();
        $articles = $model->getArticle();
        $model = new Top();
        $images = $model->getImage()->take(4);
        return view('top', ['articles' => $articles, 'images' => $images]);
    }
}
