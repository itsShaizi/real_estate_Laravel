<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    public function categories(){
        $categories = BlogCategory::orderByDesc('id')->paginate(15);
        return response()->json($categories);
    }
    public function categoryWiseBlogs($slug = null,$id = null)
    {
        $blogs = Blog::with('author');
        $category = null;
        if(!empty($id)){
            $category = BlogCategory::where(['id' => $id])->first();
            $blogs->where(['category_id' => $category->id]);
        }
        $blogs = $blogs->paginate(6);
        return view('blog.index', compact('blogs','category'));
    }
}
