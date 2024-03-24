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
// 送信されたデータをログに出力
Log::info('Received data:', $request->all());

// curriculums_id の値をログに出力
Log::info('Curriculums ID:', ['value' => $request->curriculums_id]);

        try {
            $request->validate([
                'curriculums_id.*' => 'required|integer',
                'delivery_from_date.*' => 'nullable|date_format:Ymd',
                'delivery_from_time.*' => 'nullable|date_format:H:i',
                'delivery_to_date.*' => 'nullable|date_format:Ymd',
                'delivery_to_time.*' => 'nullable|date_format:H:i',
            ]);
        
            // 送信されたデータをログに出力
            Log::info('Received data:', $request->all());
        
            // DBトランザクションを開始
            DB::beginTransaction();
        
            // curriculums_idに該当する古いデータを削除する
        DeliveryTime::where('curriculums_id', $request->curriculums_id[0])->delete(); // 配列の最初の要素を取得

        
           // フォームから受け取った配信日時の数だけループ処理を行う
        for ($i = 0; $i < count($request->delivery_from_date); $i++) {
            $delivery_time = new DeliveryTime();
            $delivery_time->curriculums_id = $request->curriculums_id[0]; 
            $delivery_time->delivery_from = \DateTime::createFromFormat('Ymd H:i:s', $request->delivery_from_date[$i] . ' ' . $request->delivery_from_time[$i] . ':00')->format('Y-m-d H:i:s');
            $delivery_time->delivery_to = \DateTime::createFromFormat('Ymd H:i:s', $request->delivery_to_date[$i] . ' ' . $request->delivery_to_time[$i] . ':00')->format('Y-m-d H:i:s');
            $delivery_time->save();
        
                Log::info('DeliveryTime created:', [
                    'curriculums_id' => $delivery_time->curriculums_id,
                    'delivery_from' => $delivery_time->delivery_from,
                    'delivery_to' => $delivery_time->delivery_to,
                ]);
            }
        
            DB::commit();
        
            return response()->json(['message' => '配信日時が正常に追加されました']);
        
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return response()->json(['error' => '配信日時の追加に失敗しました'], 500);
        }
        
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

}


