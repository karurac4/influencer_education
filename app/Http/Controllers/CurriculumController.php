<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curriculum;

class CurriculumController extends Controller
{
    // カリキュラム一覧を表示するメソッド
    public function index()
    {
        $curriculums = Curriculum::all();
        return view('admin.curriculums', compact('curriculums'));
    }

    // カリキュラムの詳細を表示するメソッド
    public function show($id)
    {
        $curriculum = Curriculum::findOrFail($id);
        return view('curriculums.show', compact('curriculum'));
    }

    

    public function deliveryTime(Curriculum $curriculum)
    {
        $deliveryTimes = $curriculum->deliveryTimes()->get();

        return view('admin.delivery_times_management', compact('deliveryTimes', 'curriculum'));
    }
}