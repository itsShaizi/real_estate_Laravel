<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(){
        
        return view('backend.blog.index', []);
    }

    public function create()
    {
        # code...
    }
    public function edit($id)
    {
        # code...
    }
}
