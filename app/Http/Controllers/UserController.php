<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Grade;
use App\Models\User;
use App\Models\Article;
use App\Models\Curriculum;
use App\Models\CurriculumProgress;
use App\Http\Requests\UserRequest;
use Validator;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function progress($userId)
    {
        $user = User::find($userId); 
        $userName = $user->name;
        $gradeName = $user->grade->name;
        $userId = $user->id;
        $grades = Grade::all();
        $curriculums = Curriculum::all();
        $curriculum = $user->grade->curriculums;
        $progress = CurriculumProgress::all();
        
            
            return view('user.progress', compact('userName', 'gradeName', 'grades', 'userId', 'curriculum', 'curriculums','user','progress'));
        }
    

    public function article($articleId)
    {
        $article = Article::find($articleId);
        $articleId = $article->id;

        return view('user.articles', compact('article', 'articleId'));
    }
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
        //
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

    /**プロフィール編集画面表示
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        // $user = User::all();
        // $userId = $user->id;
        return view('user.edit', compact('user'));
        //
    }

    /**プロフィール編集機能（ユーザー名、カナ、メールアドレス）
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request)
    {
            // トランザクションの開始
            DB::beginTransaction();
            try {
                
            $user = auth()->user();
            
            $user->name = $request->name;
        $user->name_kana = $request->name_kana;
        $user->email = $request->email;

            // 画像をアップロードした場合の処理
            if ($request->hasFile('profile_image')) {
                $filename = $request->profile_image->getClientOriginalName();
            $filePath = $request->iprofile_image->storeAs('profiles', $filename, 'public');
            $user->profile_image = '/storage/' . $filePath;

            }
    
            // $user->update($input);
            $user->save();

        DB::commit();
    } catch (\Exception $e) {
        DB::rollback();
        return back();
    }

        return redirect()->route('user.edit', $user->id)->with('success', 'プロフィールが更新されました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
