<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curriculum;
use App\Models\Grade;
use App\Models\DeliveryTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class CurriculumController extends Controller
{
    public function index()
    {
        $curriculums = Curriculum::all();
        $grades = Grade::all();

        return view('admin.curriculums', compact('grades', 'curriculums'));
    }

    public function getCurriculums(Request $request) {
        $gradeId = $request->input('grade_id');
        $curriculums = Curriculum::where('grade_id', $gradeId)
            ->with('deliveryTimes') 
            ->get();
    
            foreach ($curriculums as $curriculum) {
                // DeliveryTimeモデルからdelivery_fromとdelivery_toを取得
                $deliveryTimes = $curriculum->deliveryTimes; // delivery_timesを取得
                if ($deliveryTimes->isNotEmpty()) { // delivery_timesが空でないことを確認
                    $deliveryTime = $deliveryTimes->first(); // 最初のdelivery_timeのみを取得
                    $curriculum->delivery_from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $deliveryTime->delivery_from)->format('m-d H:i');
                    $curriculum->delivery_to = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $deliveryTime->delivery_to)->format('m-d H:i');
                    
                    \Log::info("delivery_from: " . $curriculum->delivery_from);
                }
            }
            
           

        if ($request->ajax()) {
            return view('admin.partial_curriculums', compact('curriculums'))->render();
        }
    
        return view('admin.partial_curriculums', compact('curriculums'));
    }
       
    public function showGrade($id)
    {
        $grade = Grade::findOrFail($id);
        return view('grades.show', compact('grade'));
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

    public function edit($id)
{
    $curriculum = Curriculum::find($id);
    $grades = Grade::all();
    return view('admin.curriculum_edit', compact('curriculum', 'grades'));
}

public function update(Request $request, $id)
{
    $curriculum = Curriculum::find($id);

    \Log::info($request->all());
    \Log::info('Curriculum before update: ' . json_encode($curriculum->toArray()));
    
    $request->validate([
        'title' => 'required|string',
        'thumbnail' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
        'grade_id' => 'required|integer|exists:grades,id',
        'video_url' => 'nullable|url',
        'description' => 'nullable|string',
    ]);

    

    // サムネイルのアップロードと保存
    if ($request->hasFile('thumbnail')) {
        $thumbnail = $request->file('thumbnail');
        $filename = time() . '_' . $thumbnail->getClientOriginalName();
        $path = $thumbnail->storeAs('thumbnails', $filename, 'public'); 
        $curriculum->thumbnail = $path; 
    }
    

    // その他のデータ更新
    $curriculum->title = $request->input('title');
    $curriculum->grade_id = $request->input('grade_id');
    $curriculum->video_url = $request->input('video_url');
    $curriculum->description = $request->input('description');
    $curriculum->alway_delivery_flg = $request->has('alway_delivery_flg') ? true : false;
    

if ($curriculum->save()) {
    \Log::info('Curriculum updated successfully.');
    return redirect()->route('curriculum.edit', $curriculum->id)->with('success', 'Curriculum updated successfully');
} else {
    \Log::error('Failed to update curriculum.');
    return redirect()->back()->withErrors(['message' => 'Failed to update curriculum.'])->withInput();
}
}


}