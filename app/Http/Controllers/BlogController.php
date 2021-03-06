<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Blog\StoreRequest;
use App\Http\Requests\Blog\UpdateRequest;
use App\Models\BlogCategory;
use App\Models\Tag;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function index(){

        return view('backend.blog.index', []);
    }
    public function domainBlogIndex(){


        $categories = BlogCategory::where('show_on_top' , 1)->get();

        $blogs = Blog::with('author')->paginate(6);

        return view('blog.category_header', compact(['blogs' , 'categories']));



    }

    public function create()
    {
        $blog = Blog::make();
        return view('backend.blog.create', compact('blog'));
    }

    public function store(StoreRequest $request)
    {
        try{
            DB::beginTransaction();
            $blog = Blog::make($request->validated());
            $blog->user_id = Auth::user()->id;
            $blog->save();
            $this->__uploadBlogPostCoverPhoto($request,$blog);
            $this->__mapTags($request,$blog);
            $this->__mapCategory($request,$blog);
            DB::commit();

            return redirect()->route('bk-blogs')->with('success',__('global.message.saved'));
        }catch(Exception $ex){
            DB::rollBack();
            return redirect()->back()->with('error', $ex->getMessage())->withInput();
        }

    }

    public function edit($slug)
    {

        $blog = Blog::where('slug', '=', $slug)->firstOrFail();
        return view('backend.blog.create', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Blog $blog)
    {
        try{
            DB::beginTransaction();
            $blog->fill($request->validated());
            $blog->save();
            $this->__uploadBlogPostCoverPhoto($request,$blog);
            $this->__mapTags($request,$blog);
            $this->__mapCategory($request,$blog);
            DB::commit();

            return redirect()->route('bk-blogs')->with('success',__('global.message.updated'));
        }catch(Exception $ex){
            DB::rollBack();
            return redirect()->back()->with('error', $ex->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('bk-blogs')->with('success',__('global.message.deleted'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    //public function show(Blog $blog)
    public function show($slug)
    {
        $blog = Blog::where('slug', '=', $slug)->firstOrFail();
        return view('backend.blog.view', compact('blog'));
    }

    public function blogShow($slug)
    {
        $blog = Blog::with(['author','comments'])->where('slug', '=', $slug)->firstOrFail();
        $categories = BlogCategory::orderByDesc('id')->paginate(15);
        return view('blog.view', compact('blog','categories'));
    }

    public function categorySearch(Request $request)
    {
        $search_term = $request->search_term??'';
        $category = BlogCategory::select('name','id');
        if(!empty($search_term)){
           $category->where('name','like','%'.$search_term.'%');
        }else{
            $category->limit(20);
        }
        $category= $category->get()->toArray();
        return response()->json($category);
    }

    /**
     * Store the blog post cover photo
     *
     * @param Request $request
     * @param Blog $blog
     * @return void
     */
    private function __uploadBlogPostCoverPhoto($request, $blog): void
    {
        if ($request->filled('blog_cover_photo')) {
            // Ensure that the Temp Image exists
            if (Storage::disk('tmp')->exists($request->blog_cover_photo)) {
                if(!empty($blog->cover_image)){
                    if(Storage::disk('blogs')->exists($blog->id . '/thumb/' .$blog->cover_image->title)){
                        Storage::disk('blogs')->delete($blog->id . '/thumb/' .$blog->cover_image->title);
                    }
                    if(Storage::disk('blogs')->exists($blog->id . '/original/' .$blog->cover_image->title)){
                        Storage::disk('blogs')->delete($blog->id . '/original/' .$blog->cover_image->title);
                    }
                    $blog->cover_image()->delete();
                }
                // Create the new Images and Persist to Database
                (new \App\Actions\CreateImageAction)->handle(
                    $blog,
                    Storage::disk('tmp')->get($request->blog_cover_photo)
                );

                // Remove the Temp image from disk
                Storage::disk('tmp')->delete($request->blog_cover_photo);
            }
        }
    }

    /**
     * Store the blog post tags
     *
     * @param Request $request
     * @param Blog $blog
     * @return void
     */
    private function __mapTags($request,$blog): void
    {
        $tag_ids = [];
        if ($request->filled('tags')) {
            foreach($request->tags as $tag){
                if(is_numeric($tag)){
                    $tag_ids[] = $tag;
                }else{
                    //possible duplicate
                   $tag_info = Tag::where(['content' => $tag])->first();
                   if(empty($tag_info)){
                       $tag_info =  Tag::create(['content' => $tag]);
                   }
                   $tag_ids[] = $tag_info->id;
                }
            }
        }
        if(!empty($tag_ids)){
            $blog->tags()->sync($tag_ids);
        }
    }

    /**
     * Store the blog post tags
     *
     * @param Request $request
     * @param Blog $blog
     * @return void
     */
    private function __mapCategory($request,$blog): void
    {
        $category = $request->filled('category')?$request->input('category'):0;
        if (!empty($category)) {
            if(is_numeric($category)){
                $blog->category_id = $category;
            }else{
                //possible duplicate
                $category_info = BlogCategory::where(['name' => $category])->first();
                $categoryCount = BlogCategory::where('show_on_top' , 1)->get()->count();
                if(empty($tag_info)){

                    $category_info =  BlogCategory::create([
                        'name' =>  $category,
                        'show_on_top' => ($categoryCount > 5) ? 0 : 1,

                    ]);
                }
                $blog->category_id = $category_info->id;
            }
            $blog->save();
        }else{
            throw new Exception('Category is required');
        }
    }
}
