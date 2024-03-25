<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CarCategory;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CarCategoryController extends Controller
{
    public function CarCategoryList()
    {
        $carcategory = CarCategory::latest()->get();
        return view('backend.car_category.car_category_list', compact('carcategory'));
    }

    public function CarCategoryStore(Request $request)
    {
        if ($request->file('car_category_img')){
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.$request->file('car_category_img')->getClientOriginalExtension();
            $img = $manager->read($request->file('car_category_img'));
            $img = $img->resize(370, 246);

            $img->toJpeg(80)->save(base_path('public/upload/car_category_images/'.$name_gen));
            $save_url = 'upload/car_category_images/'.$name_gen;


            CarCategory::insert([
                'car_category_name' => $request->car_category_name,
                'car_fare_under_30' => $request->car_fare_under_30,
                'car_fare_up_30' => $request->car_fare_up_30,
                'car_category_img' => $save_url,
               ]);
            
        }

       
            $notification = array(
                'message' => 'Thêm loại xe thành công!',
                'alert-type' => 'success'
            );
            return redirect()->route('car.category.list')->with($notification);
    }

    public function CarCategoryAdd()
    {
        return view('backend.car_category.car_category_add');
    }

    public function CarCategoryEdit($id)
    {
        $carCategory = CarCategory::findOrFail($id);
        return view('backend.car_category.car_category_edit', compact('carCategory'));
    }

    public function CarCategoryUpdate(Request $request)
    {
     
        $carCategory_id = $request->id;
        $old_image = $request->old_image;

        if ($request->file('car_category_img')){
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.$request->file('car_category_img')->getClientOriginalExtension();
            $img = $manager->read($request->file('car_category_img'));
            $img = $img->resize(370, 246);     

            $img->toJpeg(80)->save(base_path('public/upload/car_category_images/'.$name_gen));
            $save_url = 'upload/car_category_images/'.$name_gen;
            
            if (file_exists($old_image)) {
                unlink($old_image);
            }

            

            CarCategory::findOrFail($carCategory_id)->update([
                'car_category_name' => $request->car_category_name,
                'car_fare_under_30' => $request->car_fare_under,
                'car_fare_up_30' => $request->car_fare_up,
                'status' => $request->status,
                'car_category_img' => $save_url,
               ]);

               $notification = array(
                'message' => 'Sửa thông tin loại xe thành công!',
                'alert-type' => 'success'
            );
            return redirect()->route('car.category.list')->with($notification);
            
        }

        else{

            CarCategory::findOrFail($carCategory_id)->update([
                'car_category_name' => $request->car_category_name,
                'car_fare_under_30' => $request->car_fare_under,
                'car_fare_up_30' => $request->car_fare_up,
                'status' => $request->status,
               ]);
               
            $notification = array(
                'message' => 'Sửa thông tin loại xe thành công!',
                'alert-type' => 'success'
            );
            return redirect()->route('car.category.list')->with($notification);
        }
    
            
        
    }

    public function CarCategoryDelete($id)
    {
        $carCategory = CarCategory::findOrFail($id);
        $img = $carCategory->car_category_img;
        unlink($img);

        CarCategory::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Xóa thông tin loại xe thành công!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification); 
    }
}