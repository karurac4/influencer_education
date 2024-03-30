<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\DeliveryTime;
use App\Models\Curriculum; 
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


class DeliveryTimeController extends Controller
{


    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'curriculums_id' => 'required|exists:curriculums,id',
            'delivery_from' => 'required|array',
            'delivery_from.*' => 'required|date',
            'delivery_to' => 'required|array',
            'delivery_to.*' => 'required|date|after_or_equal:delivery_from.*',
        ]);

        $curriculumId = $request->input('curriculums_id');
        $deliveryFrom = $request->input('delivery_from');
        $deliveryTo = $request->input('delivery_to');

        // 一旦古いデータを削除
        DeliveryTime::where('curriculums_id', $curriculumId)->delete();

        // 新しいデータを保存
        foreach ($deliveryFrom as $key => $value) {
            DeliveryTime::create([
                'curriculums_id' => $curriculumId,
                'delivery_from' => $value,
                'delivery_to' => $deliveryTo[$key],
            ]);
        }

        $curriculum = Curriculum::findOrFail($curriculumId);
        return redirect()->route('delivery_times.edit', ['curriculum' => $curriculum->id])
            ->with('success', '配信日時を登録しました。');
    }

    

    public function getDeliveryTimes()
    {
        $deliveryTimes = DeliveryTime::all();
        return response()->json($deliveryTimes);
    }  

    public function index()
    {
    $deliveryTimes = $this->getDeliveryTimes(); 
    
    return view('admin.delivery_times_management')->with('deliveryTimes', $deliveryTimes); 
    }



    public function edit(Curriculum $curriculum)
    {
        // 対象のカリキュラムに紐づく配信日時データを取得
        $deliveryTimes = $curriculum->deliveryTimes;
    
        // 配信日時編集ビューを表示
        return view('admin.delivery_times_management', compact('curriculum', 'deliveryTimes'));
    }
}
