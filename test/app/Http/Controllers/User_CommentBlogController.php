<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Validator;
use App\Models\Post;
use App\Models\Tag;
use App\Models\PostTag;
use App\Models\CategoryBlog;
use App\Models\PostComment;
use DB;
use Illuminate\Support\Facades\Auth;
use File;

class User_CommentBlogController extends Controller
{
    public function comment_blog(Request $request){

        $output = '';

        $data = $request->all();
        $comment = new PostComment();
        $comment->postId = $data['blog_id'];
        $comment->user_id = $data['user_id'];
        $comment->content = $data['description'];
        $comment->star = $data['star'];
        $comment->save();
        return redirect()->back();
    }

}
