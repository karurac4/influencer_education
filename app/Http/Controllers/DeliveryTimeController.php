<?php

namespace App\Http\Controllers;

use App\Models\DeliveryTime;
use Illuminate\Http\Request;

class DeliveryTimeController extends Controller
{
    // public function show(Curriculum $curriculum)
    // {
    //     return view('admin.delivery_times_management', compact('curriculum'));
    // }

    public function edit($id)
    {
        $deliveryTime = DeliveryTime::find($id);
    
        if (!$deliveryTime) {
            \Log::info("DeliveryTime with ID $id not found.");
            abort(404); // 404エラーを返すか、適切な処理を行う
        }
    
        $curriculum = $deliveryTime->curriculum;
    
        \Log::info($deliveryTime); // ログに$deliveryTimeの内容を出力
    
        return view('admin.delivery_times_management.edit', compact('deliveryTime', 'curriculum'));
    }
            // public function update(Request $request, DeliveryTime $deliveryTime)
    // {
    //     $request->validate([
    //         'delivery_from' => 'required|date',
    //         'delivery_to' => 'required|date|after_or_equal:delivery_from',
    //     ]);

    //     $deliveryTime->update($request->all());

    //     return redirect()->route('curriculums.index')
    //         ->with('success', 'Delivery time updated successfully');
    // }
}
