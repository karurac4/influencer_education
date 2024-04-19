<?php

namespace App\Http\Controllers\user;

use App\Models\Curriculum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\DB;

class CurriculumController extends Controller
{
    public function index(Request $request){
        DB::beginTransaction();
        try{
            $classes = DB::table('classes')->get();
            $curriculums = DB::table('curriculums')->get();
          
        }catch(ValidationException $e){
          DB::rollback();
          return back();
        }
        return view('user.timetable',compact('classes','curriculums'));
    }

    public function search(Request $request){
        $grade = $_POST['grade'];
        $date_from = $_POST['date_from'];
        $date_to = $_POST['date_to'];
        $curriculum = new Curriculum();

        DB::beginTransaction();
        try{
          $curriculumData = $curriculum->curriculum($grade,$date_from,$date_to);
          $timetable = $curriculum->timetable($curriculumData);
          $result = [$curriculumData,$timetable];
        
          return $result;

        }catch(ValidationException $e){
          DB::rollback();
          return back();
        }
    }
  
    public function classBtn(Request $request){
      $id = Auth::user()->id;
      $curriculum = new Curriculum();

       DB::beginTransaction();
       try{
         $clearData = $curriculum->clearData($id);
         return $clearData;
       }catch(ValidationException $e){
         DB::rollback();
         return back();
       }
   }
}