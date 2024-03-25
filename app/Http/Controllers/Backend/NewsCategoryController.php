<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsCategory;


class NewsCategoryController extends Controller
{
    public function NewsCategoryList()
    {
        $newsCategory = NewsCategory::latest()->get();
        return view('backend.news_category.news_category_list', compact('newsCategory'));
    }

    public function NewsCategoryAdd()
    {
        return view('backend.news_category.news_category_add');
    }

    public function NewsCategoryStore(Request $request)
    {
        NewsCategory::insert([
            'news_categories_name' => $request->news_category_name,
            
           ]);
    
   
        $notification = array(
            'message' => 'Thêm danh mục tin thành công!',
            'alert-type' => 'success'
        );
        return redirect()->route('news.category.list')->with($notification);
    }

    public function NewsCategoryEdit($id)
    {
        $newsCategory= NewsCategory::findOrFail($id);
        return view('backend.news_category.news_category_edit', compact('newsCategory'));
    }

    public function NewsCategoryUpdate(Request $request)
    {
        $news_category_id = $request->id;
        NewsCategory::findOrFail($news_category_id)->update([
            'news_categories_name' => $request->news_category_name,
            'status' => $request->status,
            
           ]);

           $notification = array(
            'message' => 'Sửa mục tin tức thành công!',
            'alert-type' => 'success'
        );
        return redirect()->route('news.category.list')->with($notification);
    }

    public function NewsCategoryDelete($id)
    {
 

        NewsCategory::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Xóa thông tin mục tin tức thành công!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification); 
    }
}