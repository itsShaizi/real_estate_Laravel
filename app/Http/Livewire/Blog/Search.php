<?php

namespace App\Http\Livewire\Blog;

use App\Models\Blog;
use Livewire\Component;

class Search extends Component
{
    public  $search_term = '';

    public function render()
    {
        if(empty($this->search_term)){
            $blogs = Blog::paginate(20);
        }else{
            $blogs = Blog::where('title','like',"%{$this->search_term}%")->paginate(20);
        }
        return view('livewire.blog.search',compact('blogs'));
    }
}
