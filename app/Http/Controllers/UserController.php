<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Grade;
use App\Models\User;
use App\Models\Article;
use App\Models\Curriculum;

class UserController extends Controller
{
    // protected $table = 'grades';

    public function progress($id)
    {
        $user = User::find($id);
        $grades = Grade::find($id);
        $curriculums = Curriculum::find($id);

        // $input = $request->all();
        // dd($userId);
        // if (Auth::check()){
        //     $user = User::find($userId); 
        //     if (!$user) {
        //         return redirect('/home')->with('error', 'ユーザーが見つかりません。');
        //     }   

            // $userName = $user->name;
            // $userName = $request->input('');
            // $userName = User::find($input['name']); 
            // $gradeName = $grades->name;
            
            $userId = $user->id;
            // $curriculums =1;
            // $curriculum = $user->grade->curriculums;
            
            
            

            return view('user.progress', compact('user', 'grades', 'curriculums', 'userId'));
            // return view('user.progress', compact('userName', 'gradeName', 'grades', 'userId', 'curriculum', 'user'));
        }
    

    public function article(Article $article)
    {
        // $article = Article::all();

        // if (!$article) {
        //     return redirect()->route('home')->with('error', 'お知らせが見つかりません。');
        // }

        return view('user.articles', compact('article'));
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
    public function edit(User $user)
    {
        
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
    public function update(Request $request, User $user)
    {
        $user = auth()->user();

        $rules = [
            'name' => 'required|string|max:255',
            'name_kana' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' .$user->id,
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        $request->validate($rules);

        $input = $request->only(['name', 'name_kana', 'email']);

        // 画像をアップロードした場合の処理
        if ($request->hasFile('profile_image')) {
            $imagePath = $request->file('profile_image')->store('profiles', 'public');
            $input['profile_image'] = $imagePath;
        }
        
        // $user->update($input);
        return redirect()->route('user.edit')->with('success', 'プロフィールが更新されました。');
        
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
        //
    }
}
