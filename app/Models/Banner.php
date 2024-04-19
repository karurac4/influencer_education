<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Banner extends Model
{
    use HasFactory;

    public function imgUpdate($request,$loopNum){
        for($i=1;$i<=$loopNum;$i++){
            if($request->has('img'.$i)==1){
                $imgId = $request->input($i);
                $imgName = 'test'.$imgId.'.jpg';
                $imgPath = '/img/'.$imgName;
                
                $del = \Storage::disk('public')->delete($imgPath);
                $data =  ['id' => $imgId];
                $update = DB::table('banners')->where($data)->update([
                    'image' => $request->file('img'.$i)->storeAs('/img',$imgName,'public'),
                    'updated_at' => now()
                ]); 
                DB::commit();
            }else{
            };
        }
        return;
    }

    public function imgCreate($request,$loopNum){
        $CreateNum = $loopNum+1;
        $Createdd = $CreateNum+10;
        for($i=$CreateNum;$i<=$Createdd;$i++){
            if($request->has('image'.$i)==1){
                $nextId = DB::table('banners')->max('id') + 1;
                $imgName = 'test'.$nextId.'.jpg';
                $imgPath = '/img/'.$imgName;
                
                $update = DB::table('banners')->insert([
                    'image' => $request->file('image'.$i)->storeAs('/img',$imgName,'public'),
                    'created_at' => now(),
                    'updated_at' => now()
                ]); 
                DB::commit();
            }else{
            };
        }
        return;
    }

    public function imgDelete($id){
        $delete = DB::table('banners')
            ->where('id',$id)->delete(); 

    }
}   