<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Curriculum_progress;
use App\Models\Article;
use App\Controllers\Banner;


class Curriculum_progressController extends Controller
{

// top表示
    public function top(Request $request) {
        $model = new Article();
        $articles = $model->getArticle();
        $model = new Curriculum_progress();
        $images = $model->getImage()->take(4);
        return view('top', ['articles' => $articles, 'images' => $images]);
    }






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




    // delivery 表示
    public function delivery($id) {
        $model = new Curriculum_progress();
        $Curriculum_progresses = $model->getCurriculum_progress();
        $record = Curriculum_progress::find($id);
        $flg = $record ? $record->flg : null;

        $isWithinDeliveryPeriod = true;

        return view('delivery', ['Curriculum_progresses' => $Curriculum_progresses, 'flg' => $flg, 'record' => $record], compact('isWithinDeliveryPeriod'));
    }


    // フラグ
    public function updateFlag(Request $request){
            $record = Curriculum_progress::find($request->input('id'));
            $record->clear_flg = 1;
            $record->save();

            return redirect()->back();
    }

}