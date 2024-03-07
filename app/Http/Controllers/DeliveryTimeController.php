<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\DeliveryTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class DeliveryTimeController extends Controller
{



    public function store(Request $request)
{
    try {
        $request->validate([
            'curriculums_id' => 'required|integer',
            'delivery_from_date.*' => 'required|date_format:Ymd',
            'delivery_from_time.*' => 'required|date_format:H:i',
            'delivery_to_date.*' => 'required|date_format:Ymd',
            'delivery_to_time.*' => 'required|date_format:H:i',
        ]);

        DB::beginTransaction();

        // curriculums_idに該当する古いデータを削除する
        DeliveryTime::where('curriculums_id', $request->curriculums_id)->delete();


        for ($i = 0; $i < count($request->delivery_from_date); $i++) {
            $delivery_time = new DeliveryTime();
            $delivery_time->curriculums_id = $request->curriculums_id;
            $delivery_time->delivery_from = \DateTime::createFromFormat('Ymd H:i:s', $request->delivery_from_date[$i] . ' ' . $request->delivery_from_time[$i] . ':00')->format('Y-m-d H:i:s');
            $delivery_time->delivery_to = \DateTime::createFromFormat('Ymd H:i:s', $request->delivery_to_date[$i] . ' ' . $request->delivery_to_time[$i] . ':00')->format('Y-m-d H:i:s');
            $delivery_time->save();
        }

        DB::commit();

        return redirect()->route('admin.delivery_time.index')->with('success', '配信日時が正常に追加されました');
    } catch (\Exception $e) {
        Log::error($e->getMessage());
        return redirect()->back()->with('error', '配信日時の追加に失敗しました');
    }
}


    
                                                            
}
