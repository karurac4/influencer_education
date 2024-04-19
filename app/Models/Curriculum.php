<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Curriculum extends Model
{
    use HasFactory;

    public function curriculum($grade,$date_from,$date_to){
        $delivery_times = DB::table('delivery_times')
        ->where('delivery_from','<=',$date_from)
        ->where('delivery_to','>=',$date_to)
        ->get(); 
   
            if($delivery_times->isEmpty()==1){
                echo '';
            }else{
                $curriculumData = DB::table('curriculums')
                    ->where('classes_id','=',$grade)
                    ->Where(function ($query)use($delivery_times){
                    foreach ($delivery_times as $delivery_time){
                            $query->orWhere('id','=',$delivery_time->curriculums_id);
                        };
                    })
                    ->get(); 
            };   

        return $curriculumData;
    }

    public function timetable($curriculumData){
        $id = $curriculumData;
        $timetable = [];
        $alwaysOpen = ['常時公開'];
        
        for($i=0;$i<count($id);$i++ ){
          $flag = $curriculumData[$i]->alway_delivery_flg;
  
          if($flag==1){
            array_push($timetable,$alwaysOpen);
          }elseif($flag==0){
            $delivery_time = DB::table('delivery_times')
            ->where('curriculums_id','=',$curriculumData[$i]->id)
            ->get();

            $fromArray = [];
            for($j=0;$j<count($delivery_time);$j++ ){
              $from = date('n月d日 H:i',strtotime($delivery_time[$j]->delivery_from));
              $to = date('H:i',strtotime($delivery_time[$j]->delivery_to));
              $from_to = [$from.'～'.$to];
              
              array_push($fromArray,$from_to);
            }
            array_push($timetable,$fromArray);
          }
        };
        return $timetable;
    }

    public function clearData($id){
     // echo $id;
      $clearData = DB::table('classes_clear_checks')
        ->where('users_id','=',$id)
        ->get();
      $gradeLength = DB::table('classes')
        ->get();

      $crearArray = array();
      for($i=0;$i<count($clearData);$i++){
        $crearArray[$clearData[$i]->classes_id] = $clearData[$i]->clear_flg;
      };
      $result = [$crearArray,count($gradeLength),$gradeLength];
      return $result;

    }

}