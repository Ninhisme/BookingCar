<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\CarDetail;
use App\Models\CarCategory;
use Illuminate\Http\Request;

class CarDetailController extends Controller
{
    public function CarDetailList()
    {
        $carDetail = CarDetail::latest()->get();
        return view('backend.car_detail.car_detail_list', compact('carDetail'));
    }

    public function CarDetailAdd()
    {   
        $carCategory = CarCategory::latest()->get();
        return view('backend.car_detail.car_detail_add', compact('carCategory'));
        
    }

    public function CarDetailStore(Request $request)
    {
        CarDetail::insert([
            'car_name' => $request->car_name	,
            'car_category_id' => $request->car_category_id,
            'storage' => $request->storage,
            'seat' => $request->seat,
            'price' => $request->price,
            'status' => $request->status
     
           ]);
        

   
        $notification = array(
            'message' => 'Thêm xe thành công!',
            'alert-type' => 'success'
        );
        return redirect()->route('car.detail.list')->with($notification);
    }

    public function CarDetailEdit($id)
    {
        $carDetail= CarDetail::findOrFail($id);
        $carCategory = CarCategory::orderBy("car_category_name", 'ASC')->get();
        return view('backend.car_detail.car_detail_edit', compact('carDetail','carCategory'));
    }

    public function CarDetailUpdate(Request $request)
     {
        $carDetail_id = $request->id;
        CarDetail::findOrFail($carDetail_id)->update([
            'car_name' => $request->car_name,
            'car_category_id' => $request->car_category_id,
            'storage' => $request->storage,
            'seat' => $request->seat,
            'price' => $request->price,
            'status' => $request->status,
            
           ]);

           $notification = array(
            'message' => 'Sửa thông tin xe thành công!',
            'alert-type' => 'success'
        );
        return redirect()->route('news.list')->with($notification);
    }

    public function CarDetailDelete($id)
    {
        

        CarDetail::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Xóa xe thành công!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification); 
    }

    
}