<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::all();

        return view('admin.articles.index', compact('articles'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $articles = Article::all();

        return view('admin.articles.create', compact('articles'));
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
        $request->validate([
            'posted_date' => 'required|date',
            'title' => 'required|string|max:255',
            'article_contents' => 'required|string',
        ]);

        try {
            // トランザクションの開始
            DB::beginTransaction();

        $article = new Article([
            'posted_date' => $request->get('posted_date'),
            'title' => $request->get('title'),
            'article_contents' => $request->get('article_contents'),
        ]);

        $article->save();

        DB::commit();
    } catch (\Exception $e) {
        DB::rollback();
        return back();
    }

    // return redirect('admin.articles.index');
    return redirect()->route('admin.articles.index')->with('success', 'お知らせが更新されました。');
    //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return view('admin.articles.show', ['article' => $article]);
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
        $article = Article::find($id);
        return view('admin.articles.edit', compact('article'));
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
        $article = Article::find($id);
        
        $request->validate([
            'posted_date' => 'required|date',
            'title' => 'required|string|max:255',
            'article_contents' => 'required|string',
        ]);

        try {
            // トランザクションの開始
            DB::beginTransaction();

        $article->posted_date = $request->posted_date;
        $article->title = $request->title;
        $article->article_contents = $request->article_contents;

        $article->save();


        DB::commit();
    } catch (\Exception $e) {
        DB::rollback();
        return back();
    }

        return redirect()->route('admin.articles.index')->with('success', 'お知らせが更新されました。');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        

        $article->delete();

        return redirect(route('admin.articles.index'));

    }
}
