<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Blog\StoreRequest;
use App\Http\Requests\Blog\UpdateRequest;
use App\Models\Tag;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function index(){
        
        return view('backend.blog.index', []);
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
            DB::commit();

            return redirect()->route('bk-blogs')->with('success',__('global.message.saved'));
        }catch(Exception $ex){
            DB::rollBack();
            return redirect()->back()->with('error', $ex->getMessage())->withInput();
        }
        
    }
    
    public function edit($id)
    {
       
        $blog = Blog::findOrFail($id);
        
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
            $blog->cover_image()->delete();
            $this->__uploadBlogPostCoverPhoto($request,$blog);
            $this->__mapTags($request,$blog);
            DB::commit();
            
            return redirect()->route('bk-blogs')->with('success',__('global.message.updated'));
        }catch(Exception $ex){
            DB::rollBack();
            return redirect()->back()->with('error', $ex->getMessage())->withInput();
        }
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
}
