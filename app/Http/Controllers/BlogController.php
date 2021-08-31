<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Blog\StoreRequest;
use Exception;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function index(){
        
        return view('backend.blog.index', []);
    }

    public function create()
    {
        return view('backend.blog.create', []);
    }

    public function store(StoreRequest $request)
    {
        try{
            $blog = Blog::make($request->validated());
            $blog->user_id = Auth::user()->id;
            $blog->save();
            $this->__uploadBlogPostCoverPhoto($request,$blog);

            return redirect()->route('bk-blogs');
        }catch(Exception $ex){
            dd($ex->getMessage());
            return redirect()->back()->with('message', $ex->getMessage())->withInput();
        }
        
    }
    
    public function edit($id)
    {
        # code...
    }

    /**
     * Store the blog post cover photo
     *
     * @param Request $request
     * @param User $user
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
}
