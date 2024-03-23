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
    // top 表示
    // public function top(Request $request) {
    //     $model = new Article();
    //     $articles = $model->getArticle();
    //     $images = $request->file('image');
    //     $model = new Curriculum_progress();
    //     // $images = $request->getImage();
        
    //     return view('top', ['images' =>$images,'articles' => $articles]
    // );
    // }

    // public function top(Request $request) {
    //     $model = new Article();
    //     $articles = $model->getArticle();
    
    //     // Bannerモデルから画像のパスを取得
    //     $banner = Banner::first(); // 例として、最初のBannerを取得
    //     $imagePath = $banner->image; // image_pathはBannerテーブルのカラム名
    
    //     $model = new Curriculum_progress();
    //     $images = $request->file('image');
    
    //     return view('top', ['images' => $images, 'articles' => $articles, 'imagePath' => $imagePath]);
    // }

    public function top(Request $request) {
        $model = new Article();
        $articles = $model->getArticle();
    
        $model = new Curriculum_progress();
        $images = $model->getImage(); // getImageメソッドを呼び出して画像データを取得
    
        return view('top', ['images' => $images, 'articles' => $articles]);
    }

    // delivery 表示
    public function curriculum_progress() {
        return view('delivery');
    }

    public function showList() {
        // インスタンス生成
        $model = new Curriculum_progress();
        $deliveries = $model->getList();

        return view('list', ['deliveries' => $deliveries]);
    }

    public function showArticle() {
        // インスタンス生成
        $model = new Article();
        $articles = $model->getArticle();

        return view('top', ['articles' => $articles]);
    }


    // // フラグ
    // public function updateFlag(Request $request)
    // {
    //     $record = Curriculum_progress::find($request->input('id')); // レコードIDを取得
    //     $record->clear_flg = 1; // フラグを1に更新
    //     $record->save(); // データベースに保存
    
    //     // フラッシュメッセージを使用して、リダイレクト後のビューで変数を利用する
    //     return redirect()->back()->with('success', 'フラグが更新されました。')->with('record', $record);
    // }
}
