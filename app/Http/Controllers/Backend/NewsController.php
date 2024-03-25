<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Support\Facades\Auth;


use DOMDocument;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Carbon\Carbon;
class NewsController extends Controller
{
    public function NewsList()
    {
        $news = News::latest()->get();
        return view('backend.news.news_list', compact('news'));
    }

    public function NewsAdd()
    {
        $newsCategory = NewsCategory::latest()->get();
        return view('backend.news.news_add', compact('newsCategory'));
    }

    public function NewsStore(Request $request)
    {
        $description = $request->description;

        $dom = new DOMDocument();
        $dom->loadHTML($description, 9);
        $images = $dom->getElementsByTagName('img');

        foreach ($images as $key => $img){
            $data = base64_decode(explode(',', explode(';',$img->getAttribute('src'))[1][1]));
            $image_name = '/upload_news/' . time(). $key . 'png';
            file_put_contents(public_path().$image_name, $data);
            
            $img->removeAttribute('src');
            $img->setAttribute('src', $$img);
            
        }

        if ($request->file('thumbnail')){
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.$request->file('thumbnail')->getClientOriginalExtension();
            $img = $manager->read($request->file('thumbnail'));
            $img = $img->resize(370, 246);

            $img->toJpeg(80)->save(base_path('public/upload/news_thumbnail_images/'.$name_gen));
            $save_url = 'upload/news_thumbnail_images/'.$name_gen;

            $currentDateTime = Carbon::now()->timezone('Asia/Ho_Chi_Minh');


            News::insert([
                'news_title' => $request->news_title,
                'author_name' => Auth::user()->name,
                'id_news_category'=> $request->id_news_category,
                'description'=> $request->description,
                'thumbnail' => $save_url,
                'content' => $request->content,
                'status' => $request->status,
                'created_at' => $currentDateTime            
               ]);
            
        }

        

           $notification = array(
            'message' => 'Thêm tin tức thành công!',
            'alert-type' => 'success'
        );
        return redirect()->route('news.list')->with($notification);

        
    }

    public function NewsEdit($id)
    {
        $news= News::findOrFail($id);
        $newsCategory = NewsCategory::orderBy("news_categories_name", 'ASC')->get();
        return view('backend.news.news_edit', compact('news','newsCategory'));
    }

    public function NewsDetail($id)
    {
       
        $news = News::findOrFail($id);
        return view('backend.news.news_detail', compact('news'));

    }

    public function NewsDelete($id)
    {
        News::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Xóa tin tức thành công!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification); 
    }
}