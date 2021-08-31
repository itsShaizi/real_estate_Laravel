<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    
    public function search(Request $request)
    {
        $search_term = $request->search_term??'';
        $tags = Tag::select('content','id');
        if(!empty($search_term)){
           $tags->where('content','like','%'.$search_term.'%');
        }else{
            $tags->limit(20); 
        }
        $tags= $tags->get()->toArray();
        return response()->json($tags);
    }
}
