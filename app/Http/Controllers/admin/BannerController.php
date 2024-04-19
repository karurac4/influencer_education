<?php

namespace App\Http\Controllers\admin;

use App\Models\Banner;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BannerController extends Controller
{
    public function index(){
        $banners = Banner::all();
        return view('admin.banner',compact('banners'));
    }

    public function list(){
        $banners = Banner::all();
        return $banners;
    }

    public function update(Request $request){
        
        DB::beginTransaction();
        try{
            $banner = new Banner();  
            $loopNum = $request->input('loop');
            $imgUpdate = $banner->imgUpdate($request,$loopNum);
            $imgCreate = $banner->imgCreate($request,$loopNum);
            
        }catch(ValidationException $e){
            DB::rollback();
            return back();
        }

        
        return redirect()->route('admin.banner')->with('flash_message', 'バナー画像を登録・更新しました');
    }


    public function delete(Request $request){
        $id = $_POST['id'];
        $imgPath = $_POST['imgPath'];

        //return $imgPath;
        DB::beginTransaction();
        try{ 
            $banner = new Banner(); 
            $del = \Storage::disk('public')->delete($imgPath);
            $imgDelete = $banner->imgDelete($id);
            DB::commit();
            
        }catch(ValidationException $e){
            DB::rollback();
            return back();
        }

        return redirect()->route('admin.banner')->with('flash_message', 'バナー画像を削除しました');
    }

}