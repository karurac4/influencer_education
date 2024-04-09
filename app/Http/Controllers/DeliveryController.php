<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Curriculum_progress;
use App\Models\Curriculum;
use App\Models\Delivery_time;
use Carbon\Carbon;


class DeliveryController extends Controller
{
       // delivery 表示
       public function delivery($id) {
        $model = new Curriculum_progress();
        $Curriculum_progresses = $model->getCurriculum_progress();
        $record = Curriculum_progress::find($id);
        $flg = $record ? $record->flg : null;
        $curriculums = new Curriculum();
        $Curriculums = $curriculums->getCurriculum();
        $isWithinDeliveryPeriod = true;

        foreach ($Curriculums as $curriculum) {
            if ($curriculum->alway_delivery_flg == 0) {
                $deliveryTime = Delivery_time::where('curriculums_id', $curriculum->id)->first();
                $now = Carbon::now();
                $isWithinDeliveryPeriod = $now->between($deliveryTime->delivery_from, $deliveryTime->delivery_to);
                $curriculum->isWithinDeliveryPeriod = $isWithinDeliveryPeriod;
            } else {
                $curriculum->isWithinDeliveryPeriod = true;
            }
        }

        return view('delivery', ['Curriculum_progresses' => $Curriculum_progresses, 'flg' => $flg, 'record' => $record, 'Curriculums' => $Curriculums],compact('isWithinDeliveryPeriod'));
    }

    // フラグ
    public function updateFlag(Request $request){
            $record = Curriculum_progress::find($request->input('id'));
            $record->clear_flg = 1;
            $record->save();

            return redirect()->back();
    }


}
