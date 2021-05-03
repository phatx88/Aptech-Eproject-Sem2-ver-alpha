<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

use App\Models\Post;
use App\Models\Tag;
use App\Models\PostTag;
use App\Models\CategoryBlog;
use DB;
use App\Models\PostComment;
use Illuminate\Support\Facades\Auth;
use File;

class User_BlogController extends Controller
{
    public function index(){
        $post = Post::where('hidden', 1)->paginate(5);
        return view('pages.blog',[
            'post' => $post
        ]);
    }

    public function blog_details($slug){
        $post_details = Post::where('slug', $slug)->first();
        $post_tag= PostTag::where('postId', $post_details->id)->get();
        $tag_list = Tag::all();
        $comments = PostComment::all();
        return view('pages.single_blog',[
            'post_details' => $post_details,
            'tag_list' => $tag_list,
            'post_tag' => $post_tag,
            'comments'=> $comments
        ]);
    }
}
